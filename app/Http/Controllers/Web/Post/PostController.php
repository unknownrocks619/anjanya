<?php

namespace App\Http\Controllers\Web\Post;

use App\Classes\Cache\FrontendCache;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function load($slug, $post_slug)
    {
        $slug = htmlspecialchars($slug);
        $post_slug = htmlspecialchars($post_slug);

        $categoryCache = new FrontendCache(new Category());
        $postCache = new FrontendCache(new Post());
        $category = $categoryCache->getCache($slug);
        $post = $postCache->getCache($post_slug);

        // if post not found in cache, search in db, then cache it.
        if (!$post) {
            $post = Post::where('status', 'active')->where('slug', $post_slug)->firstOrFail();
            $postCache->setCache($post->slug, $post);
        }

        // For Uncategorised
        if (!$category && $slug != 'uncategorized') {
            $category  = Category::where('active', true)->with(['getImage', 'getComponents', 'getSeo'])->where('slug', $slug)->first();

            if ( ! $category ) {
                // get first category attached to it.
                $category = $post->getCategories()->first();

            }
            $categoryCache->setCache($category->slug, $category);
        }

        return $this->frontend_theme('master', 'post.single', ['post' => $post, 'category' => $category]);
    }

    public function post_type($post_type)
    {
        $posts = Post::where('status', 'active')->where('type', htmlspecialchars($post_type))
            ->orderBy("created_at", 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(30);
        return $this->frontend_theme('contact', 'post.type', ['posts' => $posts, 'postType' => htmlspecialchars($post_type)]);
    }
}
