<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Slider\AlbumSliderRequest;
use App\Models\SliderAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderAlbumController extends Controller
{
    //
    public function index()
    {
        $albums = SliderAlbum::withCount('sliders')->get();
        return $this->admin_theme('sliders.album.index', ['albums' => $albums]);
    }

    public function store(AlbumSliderRequest $request)
    {
        $sliderAlbum = new SliderAlbum();
        $sliderAlbum->fill($request->validated());

        if (!$sliderAlbum->save()) {
            return $this->json(false, 'Unable to create new album.');
        }

        return $this->json(true, 'New Album Created.', 'redirect', ['location' => route('admin.slider.items.list', ['album' => $sliderAlbum])]);
    }

    public function edit(SliderAlbum $album)
    {
        return $this->admin_theme('sliders.album.modal.edit', ['album' => $album])->render();
    }
    public function update(AlbumSliderRequest $request, SliderAlbum $album)
    {
        $album->fill($request->validated());
        if (!$album->save()) {
            return $this->json(false, 'Update Failed.');
        }

        return $this->json(true, 'Album Updated.','reload');
    }

    public function delete(SliderAlbum $album)
    {
        try {
            DB::transaction(function () use ($album) {
                $album->sliders()->delete();
                $album->delete();
            });
        } catch (\Throwable | \Exception $th) {
            //throw $th;
            return $this->json(false, 'Unable to remove album.', null, ['error' => $th->getMessage()]);
        }
        return $this->json(true, 'Album Deleted.', 'redirect', ['location' => '']);
    }
}
