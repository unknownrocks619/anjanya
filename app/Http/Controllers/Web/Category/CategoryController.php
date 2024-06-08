<?php

namespace App\Http\Controllers\Web\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index()
    {
        $categories = Category::where('active', true)->get();
        return $this->frontend_theme('master', 'category.list', ['categories' => $categories]);
    }

    public function show($slug)
    {
        $slug = htmlspecialchars($slug);
        $category = Category::where('active', true)->where('slug', $slug)->firstOrFail();
        $posts = Post::whereJsonContains('categories', $category->getKey())->paginate(30);

        return $this->frontend_theme('master', 'category.category-post', ['category' => $category, 'posts' => $posts]);
    }
}
