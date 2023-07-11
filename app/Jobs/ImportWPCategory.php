<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ImportWPCategory implements ShouldQueue
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
        $wpCategoriesSQLQUERY = "
            SELECT * FROM `wp_terms`
            RIGHT JOIN
            wp_term_taxonomy on wp_terms.term_id = wp_term_taxonomy.term_id
            WHERE wp_term_taxonomy.taxonomy = 'book_category';
        ";

        $wpQuery = <<<SQL
        $wpCategoriesSQLQUERY
        SQL;
        $wpCategories = DB::connection('wpmysql')->select($wpCategoriesSQLQUERY);

        $categoryArray = [];
        foreach ($wpCategories as $category) {
            $innerArray = [
                'category_name' => $category->name,
                'slug'      => $category->slug,
                'category_type' => 'books',
                'active'    => true,
                'sort_by'   => Category::getSortBy()
            ];

            $categoryArray[] = $innerArray;
        }

        Category::insert($categoryArray);
        dump('All Book category has been imported.');
    }
}
