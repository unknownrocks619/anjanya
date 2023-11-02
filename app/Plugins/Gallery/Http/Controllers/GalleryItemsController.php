<?php

namespace App\Plugins\Gallery\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Plugins\Gallery\Http\Models\GalleryAlbums;
use App\Plugins\Gallery\Http\Models\GalleryItems;

class GalleryItemsController extends Controller
{

    public function index(GalleryAlbums $album) {
        $items = $album->items()->get();
        return $this->admin_theme('backend.gallery.items.list',['items' => $items, 'album' => $album]);
    }

    public function storeImage(Request $request, GalleryAlbums $albums) {

    }
}
