<?php

namespace App\Http\Controllers\Web\Menu;

use App\Classes\Cache\FrontendCache;
use App\Classes\Helpers\Menu;
use App\Classes\Helpers\Meta;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Book\BookController;
use App\Jobs\ContactUsMail;
use App\Models\BookBundle;
use App\Models\Category;
use App\Models\ComponentBuilder;
use App\Models\Menu as ModelsMenu;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MenuController extends Controller
{
    //

    protected $cached_menu;
    protected $active_menu;
    public function __construct()
    {
        $this->cached_menu =  Menu::all();
    }

    public function load($slug = '/')
    {
        $slug = htmlspecialchars($slug);
        if (!$this->cached_menu) {
            abort(404);
        }

        if ($slug == '/') {

            $this->active_menu = ModelsMenu::where('menu_type', 'homepage')
                ->latest()
                ->where('active', true)
                ->with(['webComponents.getComponents', 'getImage', 'getSeo', 'children'])
                ->first();

            $defaultSEO = Meta::metaInfo($this->active_menu);
            return $this->frontend_theme('master', 'home.index', ['menu' => $this->active_menu, 'seo' => $defaultSEO]);
        } else {
            $this->active_menu = $this->cached_menu->where('slug', $slug)
                ->first();
            if (!$this->active_menu) {
                $this->active_menu = ModelsMenu::where('slug', $slug)->where('active', true)->first();
            }
        }

        if (!$this->active_menu) {
            abort(404);
        }

        $defaultSEO = Meta::metaInfo($this->active_menu);

        $page = null;
        $bundles = null;
        $isLanding = false;
        $isFooter = true;

        if ($this->active_menu->menu_type == 'page') {

            $page = $this->active_menu->pages()->latest()->first();
            if (!$page) {
                abort(404);
            }
            $page = $page->eloquentClass()->first();

            if (!$page->active) {
                abort(404);
            }
            $page->load('webComponents.getComponents','getImage.image','getSeo');
            $pageSeo = Meta::metaInfo($page);
            if ($pageSeo) {
                $defaultSEO = $pageSeo;
            }

            return $this->frontend_theme('master', 'page.list', ['page' => $page, 'pageSeo' => $pageSeo, 'menu' => $this->active_menu]);
        }

        if ($this->active_menu->menu_type == 'category') {
            $categories = $this->active_menu->categories()->get();

            if (!$categories->count()) {
                $categories = Category::with('getImage')->get();
            }
            $pageSeo = $defaultSEO;
            return $this->frontend_theme('master', 'category.category-list', ['categories' => $categories, 'pageSeo' => $pageSeo, 'menu' => $this->active_menu]);
        }

        if ($this->active_menu->menu_type == 'book_bundle') {
            $bundles = $this->book_bundle();
            $isFooter = false;
        }
        return $this->frontend_theme(
            'master',
            'home.index',
            [
                'menu' => $this->active_menu,
                'bundles' => $bundles,
                'page' => $page,
                'seo' => $defaultSEO,
                'isLanding' => $isLanding,
                'isFooter'  => $isFooter
            ]
        );
        // }
    }

    public function page($slug)
    {
        $slug = htmlspecialchars($slug);
        $page = Page::where('active', true)->with(['getImage'])->get();

        $pageSeo = Meta::metaInfo($page);
        return $this->frontend_theme('master', 'page.detail', ['page' => $page, 'pageSeo' => $pageSeo]);
    }

    public function book_bundle()
    {
        $bookBundle = BookBundle::where('active', true)->with(['getImage'])->get();
        return $bookBundle;
    }

    public function submit_contact_us(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'email'     => 'required|email',
            'subject'   => 'required',
            'message'   => 'required|min:10'
        ]);

        $component = ComponentBuilder::where('id', decrypt($request->post('form_id')))->first();

        if (!$component) {
            return $this->json(false, 'Unauthorized Attempt. Please reload your page and try again.');
        }


        $params  = [
            'email'     => $request->post('email'),
            'subject'   => $request->post('subject'),
            'message'   => $request->post('message'),
            'full_name' => $request->post('full_name')
        ];
        $componentValue = $component->values;
        if (ContactUsMail::dispatchSync($params)) {
            return $this->json(false, $componentValue['error_message']);
        }

        return $this->json(true, $componentValue['success_message']);
    }
}
