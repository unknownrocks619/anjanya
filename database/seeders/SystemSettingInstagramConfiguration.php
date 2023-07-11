<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemSettingInstagramConfiguration extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }

    public function social_instagram_footer_images()
    {
        if (!Setting::where('name', 'social_instagram_footer_images')->exists()) {

            Setting::create([
                'name' => 'social_instagram_footer_images',
                'value' => 'gallery',
            ]);
        }

        if (!Setting::where('name', 'home_page_setting')->exists()) {
            Setting::create([
                'name'  => 'home_page_setting',
                'value' => 'default',
                'additional_text'   => ['sidebar' => true, 'blocks' => []]
            ]);
        }

        if (!Setting::where('name', 'category_page_setting')->exists()) {
            Setting::create([
                'name'  => 'category_page_setting',
                'value' => 'default',
                'additional_text'   => ['sidebar' => true, 'blocks' => []]
            ]);
        }

        if (!Setting::where('name', 'about_us_setting')->exists()) {
            Setting::create([
                'name'  => 'about_us_setting',
                'value' => 'default',
                'additional_text'   => ['sidebar' => true, 'blocks' => []]
            ]);
        }

        if (!Setting::where('name', 'maintenance_mode')->exists()) {

            Setting::create([
                'name' => 'maintenance_mode',
                'value' => '0',
            ]);
        }
    }
}
