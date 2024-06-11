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
use App\Models\GalleryAlbums;
use App\Models\Menu as ModelsMenu;
use App\Models\Page;
use App\Plugins\Events\Http\Models\Event;
use App\Plugins\Maintanance\Http\Models\MaintenanaceMode;
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

        if (! $this->cached_menu) {
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

        if ( ! $this->active_menu) {
            abort(404);
        }

        $defaultSEO = Meta::metaInfo($this->active_menu);

        $page = null;
        $bundles = null;
        $isLanding = false;
        $isFooter = true;


        if (method_exists($this,$this->active_menu->menu_type) ) {
            return $this->{$this->active_menu->menu_type}();
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

    public function contact() {
        return $this->frontend_theme(
            'master',
            'home.contact',
            [
                'menu' => $this->active_menu,
            ]
        );
    }

    public function category() {

        $defaultSEO = Meta::metaInfo($this->active_menu);

        $page = null;
        $bundles = null;
        $isLanding = false;
        $isFooter = true;

        $categories = $this->active_menu->categories()->get();
        
        if (!$categories->count()) {
            $categories = Category::with('getImage')->get();
        }
        $pageSeo = $defaultSEO;
        return $this->frontend_theme('master-nav', 'category.category-list', ['categories' => $categories, 'pageSeo' => $pageSeo, 'menu' => $this->active_menu]);

    }
    /**
     * For menu type page, Display page
     * @return \Illuminate\Contracts\View\View
     */
    public function page(){

        $defaultSEO = Meta::metaInfo($this->active_menu);

        $page = null;
        $bundles = null;
        $isLanding = false;
        $isFooter = true;


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

        return $this->frontend_theme('master-nav', 'page.list', ['page' => $page, 'pageSeo' => $pageSeo, 'menu' => $this->active_menu,'seo' => $pageSeo]);

    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function gallery() {

        $defaultSEO = Meta::metaInfo($this->active_menu);

        $galleryAlbums = GalleryAlbums::where('active',1)->with(['items' => function($query) {
            $query->with(['getImage' => function($subQuery){
                $subQuery->with('image');
            }])
            ->where('sort_by','asc');
        }])
        ->where('album_type','!=','glitters')
        ->orderBy('sort_by','asc')->get();

        return $this->frontend_theme('master-nav','gallery.list',
                                        ['menu' => $this->active_menu,'galleryAlbums' => $galleryAlbums,'pageSeo' => $defaultSEO]);
    }


    /**
     * Display Page Content
     * @param $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function pageDetail(string $slug)
    {
        $slug = htmlspecialchars($slug);
        $page = Page::where('active', true)->where('slug' , $slug)->with(['getImage','getSeo'])->firstOrFail();
        $pageSeo = Meta::metaInfo($page);
        return $this->frontend_theme('master-nav', 'page.detail', ['page' => $page, 'pageSeo' => $pageSeo]);
    }

    /**
     * Not In Used for this theme.
     */
//    public function book_bundle()
//    {
//        $bookBundle = BookBundle::where('active', true)->with(['getImage'])->get();
//        return $bookBundle;
//    }

    /**
     * For menu type events, Display event list page.
     * @return \Illuminate\Contracts\View\View
     */
    public function events() {
        $events = \App\Plugins\Events\Http\Models\Event::where('active',true)->orderBy('event_start_date','desc')->with(['getImage' => function($query){
            $query->with('image');
        }])->paginate(15);

        return $this->frontend_theme('master-nav','events.list',[
            'menu' => $this->active_menu,
            'events'    =>  $events
        ]);
    }

    /**
     * Submit contact form.
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Support\Facades\Response
     */
    public function submit_contact_us(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'email'     => 'required|email',
            'subject'   => 'required',
            'phone'     => 'required',
            'message'   => 'required|min:10'
        ]);

        $component = ComponentBuilder::where('id', decrypt($request->post('form_id')))->first();

        if (!$component) {
            return $this->json(false, 'Unauthorized Attempt. Please reload your page and try again.');
        }

        $message = "";

        if ( $request->post('page_name') ) {
            $message .= "<b>Page Source : </b>" . $request->post('page_name');
            $message .= "<br />";
        }

        if ($request->post('post_name') ) {
            $message .= "<b>Course Source</b> : ". $request->post('post_name');
            $message .= "<br />";
        }

        $message .= "Full Name : ". $request->post('full_name');
        $message .= " <br />";
        $message .= "Email: " . $request->post('email');
        $message .= "<br />";
        $message .= "Phone Number  : ". $request->post('phone');
        $message .= "<br />";
        $message .= "Message : <br />";
        $message .= $request->post('message');
        $params  = [
            'email'     => $request->post('email'),
            'subject'   => $request->post('subject'),
            'message'   => $message,
            'phone'     => $request->post('phone'),
            'full_name' => $request->post('full_name')
        ];
        $componentValue = $component->values;

        if (ContactUsMail::dispatchSync($params)) {
            return $this->json(false, $componentValue['error_message']);
        }

        return $this->json(true, $componentValue['success_message']);
    }

}
