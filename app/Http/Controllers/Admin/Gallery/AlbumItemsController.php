<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Classes\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Models\GalleryAlbums;
use App\Models\GalleryItems;
use App\Models\SliderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumItemsController extends Controller
{
    /**
     * List all gallery items based on album id
     * @param GalleryAlbums $album
     * @return \Illuminate\Contracts\View\View
     */
    public function index(GalleryAlbums $album) {
        $galleryItems = $album->items ?? [];
        return $this->admin_theme('gallery.items.list',['album' => $album,'items' => $galleryItems]);
    }

    /**
     * Upload image to album
     *
     * @param Request $request
     * @param GalleryAlbums $album
     * @return \Illuminate\Http\Response|\Illuminate\Support\Facades\Response
     */
    public function uploadPhotos(Request $request, GalleryAlbums $album): \Illuminate\Http\Response|\Illuminate\Support\Facades\Response {
        $request->validate([
            'file' => 'required|mimes:png,jpg,gif,jpeg'
        ]);

        $galleryItems = new GalleryItems();
        $galleryItems->fill([
            'active' => true,
            'gallery_albums_id' => $album->getKey(),
        ]);
        $galleryItems->sort_by = $galleryItems->getSortOrder();

        $uploadedImage = [];

        try {
            DB::transaction(function () use ($galleryItems, $request, &$uploadedImage) {
                $galleryItems->save();
                $uploadedImage = Image::uploadImage([$request->file('file')], $galleryItems);

                if (!is_array($uploadedImage)) {
                    throw new \Exception('unknown error, Unable to upload file.');
                }
            });

        } catch (\Throwable|\Exception $th) {
            //throw $th;
            return $this->json(false, "Upload Failed", '', ['error' => $th->getMessage()]);
        }

        return $this->json(true, 'File Uploaded', 'image_slider', ['view' => $this->admin_theme('gallery.items.tabs.edit-item',
                ['previewSliderItem' => $galleryItems, 'previewImage' => $uploadedImage[0]['image']])->render()]
        );
    }

    /**
     * Render Blade file for gallery image edit
     * @param GalleryAlbums $album
     * @param GalleryItems $item
     * @return \Illuminate\Http\Response|\Illuminate\Support\Facades\Response
     */
    public function editGalleryItem(GalleryAlbums $album, GalleryItems $item) : \Illuminate\Http\Response|\Illuminate\Support\Facades\Response {
        $fileRelation = $item->getImage()->first();
        $previewFile = $fileRelation->image;
        return $this->json(true, 'Image Loaded', 'image_slider',
            ['view' => $this->admin_theme('gallery.items.tabs.edit-item',
                [
                    'previewSliderItem' => $item,
                    'previewImage' => $previewFile
                ]
            )->render()
            ]);
    }

    /**
     * Update gallery items info.
     *
     * @param GalleryAlbums $album
     * @param GalleryItems $item
     * @return \Illuminate\Http\Response|\Illuminate\Support\Facades\Response
     */
    public function updateGalleryItem(Request $request, GalleryAlbums $album, GalleryItems $item) : \Illuminate\Http\Response|\Illuminate\Support\Facades\Response {
        $item->fill([
            'heading_one'   => $request->post('heading_one'),
            'heading_two'   => $request->post('heading_two'),
            'subtitle'      => $request->post('subtitle'),
            'description'   => $request->post('description')
        ]);

        if ($request->post('featured_background') ) {
            $item->featured_background = true;
        }
        if ($request->post('featured_button') ) {
            $item->featured_button = true;
        }
        try {
            $item->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to save image detail.', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'Image Detail updated.');
    }

    /**
     * Remove Gallery Item from album
     *
     * @param GalleryAlbums $album
     * @param GalleryItems $item
     * @return \Illuminate\Http\Response|\Illuminate\Support\Facades\Response
     */
    public function deleteGalleryItem(GalleryAlbums $album, GalleryItems $item) : \Illuminate\Http\Response|\Illuminate\Support\Facades\Response {
        if (! $item->delete() ) {
            return $this->json(false,'Unable to remove image.');
        }

        return $this->json(true,'Image Deleted.','reload');

    }

    /**
     * Re-order Gallery Items
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Support\Facades\Response
     */
    public function sortGalleryItems(Request $request): \Illuminate\Http\Response|\Illuminate\Support\Facades\Response {
        foreach ($request->post() as $itemKey => $itemValue) {
            $sliderItem = GalleryItems::find($itemKey);
            $sliderItem->sort_by = $itemValue;
            $sliderItem->save();
        }

        return $this->json(true,'Reorder Success.');
    }

}
