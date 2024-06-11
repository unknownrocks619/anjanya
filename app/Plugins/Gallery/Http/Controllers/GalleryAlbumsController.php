<?php

namespace App\Plugins\Gallery\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbums;
use Illuminate\Http\Request;

class GalleryAlbumsController extends Controller
{
    public function index() {
        $albums = GalleryAlbums::withCount('items')->get();
        return $this->admin_theme('gallery.album.index',['albums' => $albums]);
    }

    public function store(Request $request) {
        $request->validate([
            'album_name'    => 'required',
            'description'   => 'required'
        ]);
        $album = new GalleryAlbums();
        $album->fill([
            'album_name'    => $request->post('album_name'),
            'description'   => $request->post('description'),
            'active'        => true,
            'slug'     => $album::getSlug($request->post('album_name')),
            'sort_by'   => $album::getSortOrder(),
            // 'slug_name' => str($request->post('album_name'))->slug()->value()
        ]);

        if ($album->save()) {
            return $this->json(true,'New Gallery Album created.','redirect',['url' => route('admin.slider.album.edit',['album' => $album])]);
        }
    }

    public function edit(Request $request, GalleryAlbums $albums) {

    }
}
