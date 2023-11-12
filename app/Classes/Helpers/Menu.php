<?php

namespace App\Classes\Helpers;

use App\Models\Menu as ModelsMenu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class Menu
{

    static $menu_columns = [
        'id',
        'menu_name',
        'slug',
        'parent_id',
        'description',
        'menu_type',
        'menu_position',
        'updated_at'
    ];

    static $menu_types = [
        'home' => '/',
        'homepage'  => '/',
        'contact'   => '/contact',
        'login'         => '/login',
        'register'      => '/register',
    ];
    public static function all()
    {

        $cache_menus = ModelsMenu::select(self::$menu_columns)
            ->where('active', true)
            ->where(function ($query) {
                $query->where('parent_id', null)
                    ->orWhere('parent_id', '0');
            })
            ->with(['webComponents.getComponents', 'getImage.image', 'getSeo', 'children'])
            ->get();

        return $cache_menus;
        $cache_menus = Cache::get('frontend_menus');

        if (!$cache_menus) {

            $cache_menus = ModelsMenu::select(self::$menu_columns)
                ->where('active', true)
                ->where(function ($query) {
                    $query->where('parent_id', null)
                        ->orWhere('parent_id', '0');
                })
                ->with(['getComponents', 'getImage', 'getSeo', 'children'])
                ->get();

            Cache::put('frontend_menus', $cache_menus);
        }
        return $cache_menus;
    }

    public static function parentMenu()
    {
        $menus = self::all();
        return $menus->where('parent_id', 0);
    }

    public static function getLink(ModelsMenu $menu): string
    {
        if (array_key_exists($menu->menu_type, self::$menu_types)) {
            return self::$menu_types[$menu->menu_type];
        }

        if ($menu->menu_type == 'page' && $menu->pages()->count() == 1) {
            $connector = $menu->pages()->first();
            if ($connector) {
                $page = $connector->eloquentClass()->first();
//                dump($page->getKey());
                return route('frontend.pages.page',['slug' => $page?->slug]);
            }

        }

        return route('frontend.pages.menu', ['slug' => $menu->slug]);
    }

    public static function isActiveMenu(ModelsMenu $menu)
    {

        if (request()->route()->getName() == 'frontend.users.register' && $menu->menu_type == 'register') {
            return true;
        }

        $activeRoutes = ['frontend.' . $menu->slug];
        if ((request()->route()->getName() != 'frontend.users.register') && (in_array($menu->slug, request()->route()->parameters()) || empty(request()->route()->parameters()) && $menu->menu_type == 'homepage')) {
            return true;
        }
        // check if child is displayed.
        if ($menu->children->count()) {
            foreach ($menu->children as $child_menu) {
                if (self::isActiveMenu($child_menu)) {
                    return true;
                }
                continue;
            }
        }

        return false;
    }
    public static function getBy(array|string $column_name, mixed $value = null)
    {
        $menus = self::all();
        if (is_array($column_name)) {
            return  $menus->where($column_name);
        }
        return $menus->where($column_name, $value);
    }

}
