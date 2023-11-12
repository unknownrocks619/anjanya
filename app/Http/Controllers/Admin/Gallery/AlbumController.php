<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbums;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    //
    public function index() {
        $albums = GalleryAlbums::withCount('items')->get();
        return $this->admin_theme('gallery.album.index',['albums' => $albums]);
    }

    public function store(Request $request) {
        $request->validate([
            'album_name'    => 'required',
        ]);
        $album = new GalleryAlbums();
        $album->fill([
            'album_name'    => $request->post('album_name'),
            'description'   => $request->post('description'),
            'active'        => true,
            'slug'     => $album::getSlug($request->post('album_name')),
            'sort_by'   => $album::getSortOrder()
        ]);

        if ( ! $album->save()) {
            return $this->json(false,'Unable to create gallery albums.');
        }
        return $this->json(true,'New Gallery Album Created.','redirect',['location' => route('admin.gallery-items.list',['album' => $album])]);
    }

    public function edit(Request $request, GalleryAlbums $albums) {

    }
}
