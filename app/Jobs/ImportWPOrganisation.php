<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Organisation;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ImportWPOrganisation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
        $this->handle();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $wpCharityOrganisation = "
            SELECT * FROM wp_posts WHERE
            post_type = 'charity'
        ";
        $wpQuery = <<<SQL
        $wpCharityOrganisation
        SQL;
        $wpPosts = DB::connection('wpmysql')->select($wpQuery);

        foreach ($wpPosts as $organisationSlug) {
            $organisation = Organisation::where('slug', $organisationSlug->post_name)->first();

            if (!$organisation) {
                $organisation = new Organisation;

                $insertArray = [
                    'organisation_name' => $organisationSlug->post_title,
                    'slug'              => $organisationSlug->post_name,
                    'short_description' => $organisationSlug->post_excerpt,
                    'full_description'  => $organisationSlug->post_content,
                    'type'         =>       'charity',
                ];
                $organisation->fill($insertArray);
                $organisation->save();
            }

            echo 'Process Project for . ' . $organisationSlug->ID . PHP_EOL;
            $projectSQLQuery = "SELECT meta_country.meta_value AS country,
            meta_genre.meta_value AS genre, wp_postmeta.*,
                wp_posts.post_date ,
                    wp_posts.post_content,
                    wp_posts.post_title,
                    wp_posts.post_excerpt,
                    wp_posts.post_status ,
                    wp_posts.post_name,
                    wp_posts.post_type,
                    meta_town.meta_value as town_city
            FROM wp_postmeta
            RIGHT JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID

            LEFT JOIN wp_postmeta meta_genre ON (wp_postmeta.post_id = meta_genre.post_id AND meta_genre.meta_key = 'genre')
            LEFT JOIN wp_postmeta meta_country ON (wp_postmeta.post_id = meta_country.post_id AND ( meta_country.meta_key = 'location' or meta_country.meta_key = 'country'))
            LEFT JOIN wp_postmeta meta_town ON (wp_postmeta.post_id = meta_town.post_id AND  meta_town.meta_key = 'town_city')

            WHERE wp_postmeta.meta_key = 'charity_name'
              AND wp_posts.post_type = 'charity-projects'
              AND wp_posts.post_status = 'publish'
              AND wp_posts.post_parent = 0
              AND wp_postmeta.meta_value = ?
            GROUP BY wp_postmeta.meta_id,
                    wp_postmeta.post_id,
                    wp_posts.ID,
                    meta_country.meta_value,
                    meta_genre.meta_value,
                    wp_postmeta.meta_key,
                    wp_postmeta.meta_value,
                    wp_posts.post_date ,
                    wp_posts.post_content,
                    wp_posts.post_title,
                    wp_posts.post_excerpt,
                    wp_posts.post_status ,
                    wp_posts.post_name,
                    wp_posts.post_type,
                    meta_town.meta_value";
            $projectSQL = <<<SQL
            $projectSQLQuery
            SQL;

            $projects = DB::connection('wpmysql')->select($projectSQL, [$organisation->organisation_name]);
            if (!count($projects)) {
                echo 'Project Not Found For: ' . $organisation->organisation_name . PHP_EOL;
                continue;
            }

            foreach ($projects as $project) {
                echo "Processing Project: " . $project->post_title . PHP_EOL;
                $innerArray = [
                    'organisation_id'   => $organisation->getKey(),
                    'title' => $project->post_title,
                    'slug'  => $project->post_name,
                    'intro_text'    => $project->post_excerpt,
                    'short_description' => $project->post_excerpt,
                    'full_description'  => $project->post_content,
                    'project_country'   => $project->country,
                    'project_genre'     => [$project->genre],
                    'project_type'      => 'project',
                    'active'            => true,
                    'donation'          => true,
                    'max_donation_amount'   => 50000,
                    'min_donation_amount'   => 35,
                    'project_state'     => $project->town_city,
                ];
                $newProject = new Project();
                $newProject->fill($innerArray);
                $newProject->sort_by = $newProject->sortColumnValue($organisation);

                $newProject->save();
                echo PHP_EOL;
            }
        }
    }
}
