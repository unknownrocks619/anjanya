<?php
namespace App\Plugins\Product\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Plugins\Product\Http\Models\StoreProduct;
use App\Classes\Plugins\Hook;
use App\Plugins\Product\Http\Models\ProductCategory;
use App\Plugins\Product\Http\Models\StoreProductAdditional;
use App\Plugins\Product\Http\Models\StoreProductVideo;
use Illuminate\Http\Request;

class ProductController extends Controller {

    protected $plugin_name = 'Product';

    public function __construct()
    {
        app('hooks')->registerHooks('seo.edit', new Hook('bundle.seo.tab', function () {
            return  [
                'name' => __('admin/posts/edit.seo'),
                'view'  => 'backend.seo.add',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'seo']
            ];
        }));

        app('hooks')->registerHooks('image.image-edit', new Hook('bundle.image.tab', function () {
            return  [
                'name' => __('admin/posts/edit.media'),
                'view'  => 'backend.media.list',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'content']
            ];
        }));
        app('hooks')->registerHooks('components-component-edit', new Hook('bundle.component.tab', function () {
            return  [
                'name' => __('admin/posts/edit.component'),
                'view'  => 'themes.components.choices',
                'data'  => ['modelVar' => 'model']
            ];
        }));
    }

    public function index() {
        $request = Request::capture();

        $products = StoreProduct::with(['productCategories'])->get();
        return $this->admin_theme('product.list',['products' => $products]);
    }

    public function create() {
        $request = Request::capture();

        if ($request->post() && $request->ajax()) {
            $request->validate([
                'name' => 'required|string',
                'sku'  => 'required',
                'stock' => 'required',
                'intro_description' => 'required',
                'short_description' => 'required',
                'status'    => 'required'
            ]);

            $product = new StoreProduct();
            $product->fill([
                'name'  => $request->post('name'),
                'stock' => $request->post('stock'),
                'intro_description' => $request->post('intro_description'),
                'short_description' => $request->post('short_description'),
                'full_description'  => $request->post('full_description'),
                'product_type' => $request->post('product_type'),
                'price_range'   => $request->post('price_range'),
                'base_price'    => $request->post("base_price"),
                'youtube_link'  => $request->post('youtube_link'),
                'facebook_link' => $request->post('facebook_link'),
                'instagram_link' => $request->post('instagram_link'),
                'twitter_link'  => $request->post('twitter_link'),
                'status'    => $request->post('status'),
                'slug'      => $product->getSlug(str($request->post('name'))->slug()->value()),
                'sku'       => $request->post('sku')
            ]);

            // check if sku already exists.
            if (StoreProduct::where('sku',$request->post('sku'))->exists()) {
                return $this->generateValidationError('sku'.'Sku Code Already Exists.');
            }
            
            if ( ! $product->save() ) {
                return $this->json(false,'Unable to save product detail. Please try again.');
            }

            // check for categories to insert.
            if ($request->post('categories') ) {

                foreach ($request->post('categories') as $category) {
                    $productCategories = new ProductCategory();
                    $productCategories->fill([
                        'id_cat'    => $category,
                        'id_pro'    => $product->getKey()
                    ]);
                    $productCategories->save();
                }

            }

            return $this->json(true,'New Product saved successfully.Redirecting you..','redirect',['location' => route('admin.products.edit',['product' => $product])]);
        }

        return $this->admin_theme('product.add');
    }

    public function edit(StoreProduct $product, string $current_tab = 'general') {
        $request = Request::capture();

        if ($request->post() && $request->ajax()) {

            $request->validate([
                'name' => 'required|string',
                'sku'  => 'required',
                'stock' => 'required',
                'intro_description' => 'required',
                'short_description' => 'required',
                'status'    => 'required'
            ]);

            $product->fill([
                'name'  => $request->post('name'),
                'stock' => $request->post('stock'),
                'intro_description' => $request->post('intro_description'),
                'short_description' => $request->post('short_description'),
                'full_description'  => $request->post('full_description'),
                'product_type' => $request->post('product_type'),
                'price_range'   => $request->post('price_range'),
                'base_price'    => $request->post("base_price"),
                'youtube_link'  => $request->post('youtube_link'),
                'facebook_link' => $request->post('facebook_link'),
                'instagram_link' => $request->post('instagram_link'),
                'twitter_link'  => $request->post('twitter_link'),
                'status'    => $request->post('status'),
                'slug'      => $product->getSlug(str($request->post('name'),$product)->slug()->value()),
                'sku'       => $request->post('sku')
            ]);

            // check if sku already exists.
            if (StoreProduct::where('sku',$request->post('sku'))->where('id','!=' ,$product->getKey())->exists()) {
                return $this->generateValidationError('sku'.'Sku Code Already Exists.');
            }
            
            if ( ! $product->save() ) {
                return $this->json(false,'Unable to save product detail. Please try again.');
            }

            // check for categories to insert.
            if ($request->post('categories') ) {

                $toInclude = [];
                foreach ($request->post('categories') as $category) {

                    $productCategory = ProductCategory::where('id_pro', $product->getKey())->where('id_cat',$category)->first();
                    // check if already exists.
                    if ( $productCategory ) {
                        $toInclude[] = $productCategory->getKey();
                        continue;
                    }

                    $productCategories = new ProductCategory();
                    $productCategories->fill([
                        'id_cat'    => $category,
                        'id_pro'    => $product->getKey()
                    ]);
                    $productCategories->save();

                    $toInclude[] = $productCategories->getKey();
                }

                ProductCategory::whereNotIn('id',$toInclude)->where('id_pro',$product->getKey())->delete();

            } else {
                ProductCategory::where('id_pro',$product->getKey())->delete();
            }

            return $this->json(true,'Product saved successfully.Redirecting you..','redirect',['location' => route('admin.products.edit',['product' => $product,'general'])]);
        }

        $product->load(['getSeo', 'getImage' => fn ($query) => $query->with('image')]);
        $tabs = [
            'general' => $product,
            'additional_description' => $product,
            'associated_files'  => $product,
            'videos'        => $product
        ];
        $tabs = array_merge($tabs,app('hooks')->catchHooks('bundle.image.tab', []), app('hooks')
            ->catchHooks('bundle.seo.tab', []), app('hooks')->catchHooks('bundle.component.tab',[]));
            
        return $this->admin_theme('product.edit', ['product' => $product,'tabs' => $tabs,'current_tab' => $current_tab]);

    }


    public function additionalContent(Request $request, StoreProduct $product){
        $request->validate([
            'title' => 'required'
        ]);

        $additionalContent = new StoreProductAdditional();
        $additionalContent->fill([
            'title' => $request->post('title'),
            'full_description'  => $request->post('description'),
            'id_pro'    => $product->getKey()
        ]);
        
        if ( ! $additionalContent->save() ) {
            return $this->save(false,'Failed');
        }

        return $this->json(true,'Success.','redirect',['location' => route('admin.products.edit',['product' => $product,'current_tab' => 'additional_description'])]);

    }

    public function updateAdditionalContent(Request $request, StoreProduct $product, StoreProductAdditional $additionalProduct) {
        if ($request->post() && $request->ajax() ) {
            $request->validate([
                'title' => 'required'
            ]);
    
            $additionalProduct->fill([
                'title' => $request->post('title'),
                'full_description'  => $request->post('description'),
            ]);
    
            if ( ! $additionalProduct->save() ) {
                return $this->json(false,'Failed');
            }
    
            return $this->json(true,'Success');
    
        }

        return $this->admin_theme('product.edit-additional-content',['product' => $product,'additionalContent' => $additionalProduct]);
    }

    public function deleteAdditionalContent(Request $request, StoreProduct $product, StoreProductAdditional $additionalProduct)  {
        if (! $additionalProduct->delete() ) {
            return $this->json(false,'Failed');
        }

        return $this->json(true,'Success','redirect',['location' => route('admin.products.edit',['product' => $product,'current_tab' => 'additional_description'])]);
    }

    /**
     * Product Video
     */



    public function productVideo(Request $request, StoreProduct $product){
        $request->validate([
            'title' => 'required'
        ]);

        $additionalContent = new StoreProductVideo();
        $additionalContent->fill([
            'title' => $request->post('title'),
            'full_description'  => $request->post('description'),
            'id_pro'    => $product->getKey(),
            'video_link'    => $request->post('video')
        ]);
        
        if ( ! $additionalContent->save() ) {
            return $this->save(false,'Failed');
        }

        return $this->json(true,'Success.','redirect',['location' => route('admin.products.edit',['product' => $product,'current_tab' => 'videos'])]);

    }

    public function updateProductVideo(Request $request, StoreProduct $product, StoreProductVideo $video) {
        if ($request->post() && $request->ajax() ) {
            $request->validate([
                'title' => 'required',
                'video' => 'required|url'
            ]);
    
            $video->fill([
                'title' => $request->post('title'),
                'description'  => $request->post('description'),
                'video_link'    => $request->post('video')
            ]);
    
            if ( ! $video->save() ) {
                return $this->json(false,'Failed');
            }
    
            return $this->json(true,'Success');
    
        }

        return $this->admin_theme('product.edit-video-content',['product' => $product,'video' => $video]);
    }

    public function deleteProductVideo(Request $request, StoreProduct $product, StoreProductVideo $video)  {
        if (! $video->delete() ) {
            return $this->json(false,'Failed');
        }

        return $this->json(true,'Success','redirect',['location' => route('admin.products.edit',['product' => $product,'current_tab' => 'videos'])]);
    }

    public function delete(StoreProduct $product) {
        if ( ! $product->delete() ) {
            return $this->json(false,'Failed');
        }
        return $this->json(true,'Success','reload');
    }
}