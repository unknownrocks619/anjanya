<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index()
    {

        $categories = Category::get();
        return $this->admin_theme('category.index', ['categories' => $categories]);
    }

    public function create(Request $request)
    {
        if ($request->post()) {
            return $this->store($request);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_type'  => 'required|in:' . implode(',', array_keys(Category::CATEGORY_TYPES))
        ]);

        $category = new Category;
        $category->fill([
            'category_name' => $request->post('category_name'),
            'slug'  => $category::getSlug($request->post('category_name')),
            'full_description'  => $request->post('description'),
            'active'            => false,
            'category_type'     => $request->post('category_type'),
            'sort_by'           => $category::getSortBy()
        ]);

        try {
            $category->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to save category.', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'New Category Created', 'redirect', ['location' => route('admin.categories.edit', ['category' => $category])]);
    }

    public function edit(Request $request, Category $category, $current_tab = 'general')
    {
        if ($request->post()) {

            return $this->update($request, $category);
        }
        $category->load(['getImage', 'getSeo', 'getComponents']);
        $tabs = [
            'general'   => $category,
            'image'     => $category->getImage,
            'seo'       => $category->getSeo,
            'components'    => $category->getComponents
        ];

        return $this->admin_theme('category.edit', ['tabs' => $tabs, 'current_tab' => $current_tab, 'category' => $category]);
    }

    public function update(Request $request, Category $category)
    {

        $request->validate([
            'category_name' => 'required',
            'category_type' => 'required|in:' . implode(',', array_keys(Category::CATEGORY_TYPES)),
            'category_slug' => 'required'
        ]);

        $category->category_name = $request->post('category_name');
        $category->slug = $request->post('category_slug');

        if ($category->isDirty('slug')) {
            $category->slug = Category::getSlug($request->post('category_slug'), $category);
        }
        $category->full_description = $request->post('description');
        $category->active = $request->has('active') ? true : false;
        $category->category_type = $request->post('category_type');

        try {
            $category->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update category.', '', ['errors' => $th->getMessage()]);
        }
        return $this->json(true, 'Category Information updated.', 'redirect', ['location' => route('admin.categories.edit', ['category' => $category, 'current_tab' => 'general'])]);
    }

    public function delete(Category $category)
    {
        try {
            $category->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to remove Category.');
        }

        return $this->json(true, 'Category Deleted.', 'redirect', ['location' => route('admin.categories.list')]);
    }
}
