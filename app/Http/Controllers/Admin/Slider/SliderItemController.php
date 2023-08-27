<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Classes\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Models\SliderAlbum;
use App\Models\SliderItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class SliderItemController extends Controller
{
    //
    public function index(SliderAlbum $album)
    {
        $sliders = $album->sliders()->orderBy('sort_by','asc')->get();
        return $this->admin_theme('sliders.items.list', ['sliders' => $sliders, 'album' => $album]);
    }

    public function store(Request $request, SliderAlbum $album)
    {
        $request->validate([
            'file' => 'required|mimes:png,jpg,gif,jpeg'
        ]);

        $sliderItems = new SliderItem;
        $sliderItems->fill([
            'slider_type' => 'image',
            'active' => false,
            'slider_album_id' => $album->getKey(),
        ]);
        $sliderItems->sort_by = $sliderItems->getSortOrder();

        $uploadedImage = [];
        try {
            DB::transaction(function () use ($sliderItems, $request, &$uploadedImage) {
                $sliderItems->save();
                $uploadedImage = Image::uploadImage([$request->file('file')], $sliderItems);

                if (!is_array($uploadedImage)) {
                    throw new Exception('unknown error, Unable to upload file.');
                }
            });
        } catch (Throwable|Exception $th) {
            //throw $th;
            return $this->json(false, "Upload Failed", '', ['error' => $th->getMessage()]);
        }

        return $this->json(true, 'File Uploaded', 'image_slider', ['view' => $this->admin_theme('sliders.items.tabs.preview',
                ['previewSliderItem' => $sliderItems, 'previewImage' => $uploadedImage[0]['image']])->render()]
        );
    }

    public function edit($album , SliderItem $slider)
    {
        $fileRelation = $slider->getImage()->first();
        $previewFile = $fileRelation->image;
        return $this->json(true, 'Image Loaded', 'image_slider',
                            ['view' => $this->admin_theme('sliders.items.tabs.preview',
                                                                [
                                                                    'previewSliderItem' => $slider,
                                                                    'previewImage' => $previewFile
                                                                ]
                                                        )->render()
                            ]);
    }


    public function update(Request $request, $album, SliderItem $slider)
    {
        $slider->fill([
            'heading_one'   => $request->post('heading_one'),
            'heading_two'   => $request->post('heading_two'),
            'subtitle'      => $request->post('subtitle'),
            'description'   => $request->post('description')
        ]);

        try {
            $slider->save();
        } catch (Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to save image detail.', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'Image Detail updated.');
    }

    public function sortSliderItems(Request $request) {
        foreach ($request->post() as $itemKey => $itemValue) {
            $sliderItem = SliderItem::find($itemKey);
            $sliderItem->sort_by = $itemValue;
            $sliderItem->save();
        }

        return $this->json(true,'Reorder Success.');
    }

    public function delete($album, SliderItem $slider) {

        if (! $slider->delete() ) {
            return $this->json(false,'Unable to remove Slider.');
        }

        return $this->json(true,'Slider Image Deleted.','reload');

    }
}
