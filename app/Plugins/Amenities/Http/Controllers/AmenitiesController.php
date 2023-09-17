<?php

namespace App\Plugins\Amenities\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Plugins\Amenities\Http\Models\Amenities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PharIo\Version\Exception;

class AmenitiesController extends Controller
{
    protected $plugin_name ='Amenities';
    public function index() {
        $amenities = Amenities::get();
        return $this->admin_theme('amenities.list',['amenities' => $amenities]);
    }

    public function store(Request $request) {
        $request->validate([
            'amenities_name'    => 'required',
            'amenity_type'      => 'required|in:icon,image',
            'amenity_icon'      => 'required_if:amenity_type,icon'
        ]);

        $amenities = new Amenities();
        $amenities->fill([
            'amenities' => $request->post('amenities_name'),
            'slug'  => str($request->post('amenities_name'))->slug('-'),
            'amenities_type'    => $request->post('amenity_type'),
            'icon_name'     => $request->post('amenity_icon'),
            'active'        => true
        ]);

        try {
            $amenities->save();
        } catch (Exception $e) {
            return $this->json(false,'Unable to save.','',['error' => $e->getMessage()]);
        }

        return $this->json(true,'Amenity Saved.','reload');
    }

    public function edit(Amenities $amenity) {
        return $this->admin_theme('amenities.edit',['amenity' => $amenity]);
    }
    public function update(Request $request, Amenities $amenity) {
        $request->validate([
            'amenities_name'    => 'required',
            'amenity_type'      => 'required|in:icon,image',
            'amenity_icon'      => 'required_if:amenity_type,icon'
        ]);

        $amenity->amenities = $request->post('amenities_name');
        $amenity->amenities_type = $request->post('amenity_type');
        $amenity->icon_name = $request->post('amenity_icon');
        $amenity->active = $request->post('active') ?  true : false;
        try {
            $amenity->save();
        } catch (\Exception $e) {
            return $this->json(false,'Unable to update.','',['error' => $e->getMessage()]);
        }
        return $this->json(true,'Updated.');
    }

    public function deleteAmenity(Amenities $amenities) {
        try {
            DB::transaction(function() use ($amenities) {
                $amenities->amenitiesLink()->delete();
                $amenities->delete();
            });
        } catch (\Exception $e) {
            return $this->json(false,'Unable to delete.','',['error' => $e->getMessage()]);
        }

        return $this->json(true,'Amenities Deleted.','reload');
    }
}
