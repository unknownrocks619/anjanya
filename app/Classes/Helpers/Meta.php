<?php

namespace App\Classes\Helpers;

class Meta
{

    static $templateString = null;

    public function __construct()
    {
        self::$templateString = $this->template();
    }

    /**
     * Fetch this from either home page
     * or from setting it self.
     */
    public static function defaultMeta()
    {
        self::$templateString = view('themes.frontend.meta')->render();

        $menus = Menu::getBy('slug', 'homepage');
        if (!$menus->count()) {
            // try fetching from setting, which is not availabel at the moment.
            $title = "Best Online Learning Platform For Students &amp; Teachers | Upschool";
            $description = "Our mission is to build a system of education where all children can participate in meaningful and impactful educational opportunities and learn things that are inspirational and magical to them. Contact us today!";
            $date = date("Y-m-d H:i:s");
            self::$templateString = str_replace(
                [
                    '__META_DESCRIPTION__',
                    '__META_OG:DESCRIPTION__',
                    '___META_OG:TITLE__',
                    '__META_TITLE__',
                    '__META_ARTICLE_MODIFIED_DATE__'
                ],
                [
                    $description,
                    $description,
                    $title,
                    $title,
                    $date
                ],
                self::$templateString
            );
        }
    }

    public static function metaInfo($model)
    {
        self::$templateString = view('themes.frontend.meta')->render();

        $seoContent = $model?->getSeo()->first();
        $seoImage = $model?->getImage()->where('type', 'seo')->first();

        $image = SystemSetting::logo();

        if ($seoImage) {
            $seoImage = $seoImage->image?->filepath;
            if ($seoImage) {
                $image = Image::getImageAsSize($seoImage, 'm');
            }
        }

        if ($seoContent) {
            $title = strip_tags($seoContent->seo?->title ?? $model->title);
            $description = strip_tags($seoContent->seo?->description ?? $model->intro_text);
            $keyword = strip_tags($seoContent->seo?->keyword);

            self::$templateString = str_replace(
                [
                    '__META_DESCRIPTION__',
                    '__META_OG:DESCRIPTION__',
                    '___META_OG:TITLE__',
                    '__META_TITLE__',
                    '__META_ARTICLE_MODIFIED_DATE__',
                    '__CONONICAL_URL__',
                    '__SEO_IMAGE__',
                    '__URL__'
                ],
                [
                    $description,
                    $description,
                    $title,
                    $title,
                    $model->updated_at,
                    url()->current(),
                    $image,
                    url()->current()
                ],
                self::$templateString
            );
        } else {
            self::defaultMeta();
        }

        return self::$templateString;
    }

    public  function template()
    {
        return view('themes.frontend.meta')->render();
    }
}
