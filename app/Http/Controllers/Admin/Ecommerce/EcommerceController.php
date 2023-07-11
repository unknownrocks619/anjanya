<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EcommerceController extends Controller
{

    public function __construct()
    {
        app('hooks')->registerHooks('components.component-edit', new Hook('product.component.tab', function () {
            return  [
                'name' => __('admin/products/edit.component'),
                'view'  => 'themes.components.choices',
                'data'  => ['modelVar' => 'model']
            ];
        }));

        app('hooks')->registerHooks('seo.edit', new Hook('product.seo.tab', function () {
            return  [
                'name' => __('admin/products/edit.seo'),
                'view'  => 'backend.seo.add',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'seo']
            ];
        }));

        app('hooks')->registerHooks('image.image-edit', new Hook('product.image.tab', function () {
            return  [
                'name' => __('admin/products/edit.media'),
                'view'  => 'backend.media.list',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'content']
            ];
        }));
    }
    //
    public function index()
    {
        $products = Product::with(['getImage', 'getSeo'])->where('status', '!=', '_begin')->get();
        return $this->admin_theme('products.index', ['products' => $products]);
    }

    public function bundleIndex()
    {
    }

    public function edit(Request $request, Product $product, $current_tab = 'general', Book $book = null)
    {

        if ($book && $book->is_converted) {
            return redirect()->route('admin.ecom.edit', ['product' => $product, 'current_tab' => 'general']);
        }


        if ($request->post()) {
            return $this->updateProduct($request, $product, $book);
        }

        $product->load(['getImage', 'getSeo']);
        $tabs = [
            'general'   => $product,
        ];
        $tabs = array_merge($tabs, app('hooks')->catchHooks('product.image.tab', []));
        $tabs = array_merge($tabs, app('hooks')->catchHooks('product.seo.tab', []));
        $tabs = array_merge($tabs, app('hooks')->catchHooks('product.component.tab', []));

        return $this->admin_theme('products.edit', ['tabs' => $tabs, 'current_tab' => $current_tab, 'book' => $book, 'product' => $product]);
    }

    public function convert_to_product(Book $book)
    {

        if ($book->status != 'active') {
            return $this->json(false, 'Book is not active. please make book active before converting to product.');
        }

        $product = new Product;
        $product->fill([
            'product_name' => $book->book_title,
            'slug'  => $book->slug,
            'intro_text'    => $book->intro_text,
            'short_description' => $book->short_description,
            'full_description'  => $book->full_description,
            'status'            => '_begin',
            'option_project_id' => $book->default_project,
            'categories'        => $book->categories,
            'book_id'           => $book->getKey(),
            'author_id'         => $book->user_id,
            'sku'               => strtoupper(\Illuminate\Support\Str::random(6)),
            'stock'             => 0,
            'product_type'      => 'both',
            'product_lising'    => 'single',
            'item_price'        => 0,
            'tax'               => '0',
            'total_pricing'     => 0,
            'is_shipping_available' => false,
        ]);
        $product->save();
        return $this->json(true, '', 'redirect', ['location' => route('admin.ecom.edit', ['product' => $product, 'current_tab' => 'general', 'book' => $book])]);
    }

    public function delete_product(Product $product)
    {
        $product->delete();

        return $this->json(true, 'Product Deleted', 'reload');
    }

    public function updateProduct(Request $request, Product $product, Book $book = null)
    {

        $request->validate([
            'product_name' => 'required',
            'slug'          => "required",
            'author'     => 'required',
            'project'   => 'required',
            'categories'    => 'required|array',
            'product_type'  => 'required',
            // 'product_listing'   => 'required'
        ]);

        $product->product_name = $request->post('product_name');
        $product->slug = $request->post('slug');
        $product->intro_text = $request->post('intro_text');
        $product->short_description = $request->post('short_description');
        $product->full_description  = $request->post('full_description');
        $product->categories = $request->post('categories');
        $product->product_type = $request->post('product_type');
        $product->product_listing = $request->has('product_listing') ? $request->post('product_listing') : 'single';
        $product->status = $request->post('status');
        $product->option_project_id = $request->post('project');
        $product->author_id = $request->post('author');
        $product->is_shipping_available = $request->has('shipping_option') ? true : false;
        if ($book) {

            $product->sort_by = $product::getSortBy();
        }

        $successMessage = 'Product information updated.';
        $failMessage = 'Unable to update product information.';

        if ($book) {
            $successMessage = 'User book has been converted to product.';
            $failMessage = 'Unable to convert book into product.';
        }

        try {
            DB::transaction(function () use ($product, $book) {
                $product->save();

                if ($book) {
                    $book->is_converted = true;
                    $book->save();
                }
            });
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, $failMessage, '', ['error' => $th->getMessage()]);
        }

        return $this->json(true, $successMessage, 'reload');
    }
}
