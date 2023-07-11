<?php

namespace App\Jobs;

use App\Models\Organisation;
use App\Models\Project;
use App\Models\ProjectTransactions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ImportWPLibrary implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $defaultOrg = null;
    public function __construct()
    {
        //
        $org = Organisation::where('slug', 'upschool')->first();

        if (!$org) {
            $org = new Organisation();
            $org->fill([
                'organisation_name' => 'Upshcool',
                'slug'              => 'upschool',
                'active'            => true,
                'type'              => 'charity'
            ]);

            $org->save();
        }

        $this->defaultOrg = $org;

        $this->handle();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $sqlquery = "SELECT post.*,
                        school.meta_value as school_name,
                        lib_city.meta_value as city,
                        lib_state.meta_value as lib_state,
                        lib_max_budget.meta_value as max_budget,
                        lib_budget_collected.meta_value as budget_collected

                    FROM `wp_posts` post

                    LEFT JOIN wp_postmeta school
                    on post.ID = school.post_id
                    AND school.meta_key = 'school_name:'

                    LEFT JOIN wp_postmeta lib_city
                    on post.ID = lib_city.post_id
                    AND lib_city.meta_key = 'school_city'

                    LEFT JOIN wp_postmeta lib_state
                    on post.ID = lib_state.post_id
                    AND lib_state.meta_key = 'school_state'

                    LEFT JOIN wp_postmeta lib_max_budget
                    on post.ID = lib_max_budget.post_id
                    AND lib_max_budget.meta_key = 'funding_target'

                    LEFT JOIN wp_postmeta lib_budget_collected
                    on post.ID = lib_budget_collected.post_id
                    AND lib_budget_collected.meta_key = 'funding_raised'

                    WHERE post_type='project'
                    AND post_status='publish'
                    AND post_parent=0";

        $sql = <<<SQL
            $sqlquery
        SQL;

        $libraries = DB::connection('wpmysql')->select($sql);

        foreach ($libraries as $library) {

            // check if library already imported.
            $laravelProject = Project::where('slug', $library->post_name)->first();

            if ($laravelProject) {
                echo 'Skipping Libarary, Already exists. ' . PHP_EOL;
                continue;
            }

            $max_budget = ($library->max_budget) ?  floatval(str_replace(',', '', $library->max_budget)) : 50000;
            $project = new Project();
            $project->fill([
                'title' => $library->post_title,
                'slug'  => $library->post_name,
                'project_type'  => 'library',
                'max_donation_amount'   => $max_budget,
                'min_donation_amount'   => 25,
                'project_state'         => $library->lib_state,
                'project_street_address'    => $library->city,
                'intro_text'            => $library->post_excerpt,
                'short_description'     => $library->post_excerpt,
                'full_description'      => $library->post_content,
                'organisation_id'   => $this->defaultOrg->getKey(),
                'sort_by'               => 0
            ]);

            $project->save();

            // check if this have collected budget insert here.
            if ((float) $library->budget_collected) {
                $projectTransaction = new ProjectTransactions();
                $projectTransaction->fill([
                    'source'    => 'wp_import',
                    'transaction_amount'    => (float) $library->budget_collected,
                    'project_id'    => $project->getKey(),
                    'organisation_id'   => $this->defaultOrg->getKey()
                ]);

                $projectTransaction->save();
            }

            echo 'Library `' . $library->post_title . '` imported';
        }
    }
}
