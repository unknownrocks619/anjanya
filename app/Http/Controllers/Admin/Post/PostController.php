<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Classes\Plugins\Hook;

class PostController extends Controller
{
    //

    public function __construct()
    {
        app('hooks')->registerHooks('components-component-edit', new Hook('bundle.component.tab', function () {
            return  [
                'name' => __('admin/posts/edit.component'),
                'view'  => 'themes.components.choices',
                'data'  => ['modelVar' => 'model']
            ];
        }));
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
    }

    public function index()
    {
        if (request()->method() === 'POST') {
            request()->validate([
                'title' => 'required'
            ]);

            $post = new Post();
            $post->fill([
                'title' => request()->post('title'),
                'slug'  => $post::getSlug(request()->post('title'), $post),
                'sort_by'  => $post::getSortBy(),
                'status'    => 'draft',
                'type'      => 'blog',
                'categories'    => []
            ]);

            if (!$post->save()) {
                return $this->json(false, 'Unable to create post.');
            }

            return $this->json(true, 'New Post Created.', 'redirect', ['location' => route('admin.posts.edit', ['post' => $post])]);
        }
        $posts = Post::get();
        return $this->admin_theme('post.index', ['posts' => $posts]);
    }

    public function edit(Request $request, Post $post, $current_tab = 'general')
    {
        if ($request->method() === 'POST') {
            $request->validate([
                'title' => 'required',
                'slug'  => 'required',
                'status'    => 'required',
                'post_type' => 'required'
            ]);

            $post->title = $request->post('title');
            $post->slug = Post::getSlug($request->post('slug'), $post);
            $post->intro_description = $request->post('intro_text');
            $post->short_description = $request->post('short_description');
            $post->full_description = $request->post('full_description');
            $post->type = $request->post('post_type');
            $post->status = $request->post('status');
            $post->categories = $request->post('categories') ? array_map('intval', $request->post('categories')) : [];

            if(env('APP_THEMES') == 'siddhamahayog') {
                $post->glitter_background = $request->post('glitter_background');
            }


            try {
                $post->save();
            } catch (\Throwable $th) {
                //throw $th;
                return $this->json(false, 'Unable to update Post');
            }

            $jsCallBack = '';

            if ($post->isDirty('type')) {
                $jsCallBack = 'reload';
            }

            return $this->json(true, 'Post Updated.', $jsCallBack);
        }

        $tabs = [
            'general'  => $post,
        ];
        $tabs = array_merge($tabs, app('hooks')->catchHooks('bundle.seo.tab', []));
        $tabs = array_merge($tabs, app('hooks')->catchHooks('bundle.image.tab', []));
        $tabs = array_merge($tabs, app('hooks')->catchHooks('bundle.component.tab', []));

        return $this->admin_theme('post.edit', ['current_tab' => $current_tab, 'post' => $post, 'tabs' => $tabs]);
    }

    public function delete(Post $post)
    {

        try {
            $post->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to remove post');
        }

        return $this->json(true, 'Post Deleted.', 'reload');
    }
}
