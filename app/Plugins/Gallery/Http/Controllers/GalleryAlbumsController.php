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
            'slug_name'     => $album::getSlug($request->post('album_name')),
            'sort_by'   => $album::getSortOrder()
        ]);

        if ($album->save()) {
            return $this->json(true,'New Gallery Album created.','redirect',['url' => route()]);
        }
    }

    public function edit(Request $request, GalleryAlbums $albums) {

    }
}
