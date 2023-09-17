<?php

namespace App\Plugins\Testimonials\Http\Controllers;

use App\Classes\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Plugins\Testimonials\Http\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    protected $plugin_name='Testimonials';

    public function index() {
        $testimonials = Testimonial::get();
        return $this->admin_theme('testimonials.list',['testimonials' => $testimonials]);
    }

    public function create()
    {
        return $this->admin_theme('testimonials.create');
    }

    public function store(Request $request) {
        $request->validate([
            'full_name' => 'required',
            'testimonial'   => 'required',
            'rating'        => 'required'
        ]);

        $testimonials = new Testimonial();
        $testimonials->fill([
            'full_name' => $request->post('full_name'),
            'rating'    => $request->post('rating'),
            'sort_by'   => $testimonials::getSortOrder(),
            'comment'   => $request->post('testimonial'),
            'source'    => $request->post('source'),
            'gender'    => $request->post('gender'),
            'profession'    => $request->post('profession'),
        ]);


        // check if image was uploaded.
        if ($request->file('image') ) {
            // get image
            $image = Image::uploadOnly($request->file('image'));
            $testimonials->images = $image[0]->filepath;
        }

        if (! $testimonials->save()) {
            return back();
        }
        return redirect()->route('admin.testimonials.list');

    }

    public function edit(Testimonial $testimonial) {
        return $this->admin_theme('testimonials.edit',['testimonial' => $testimonial]);
    }

    public function update(Request $request, Testimonial $testimonial) {
        $request->validate([
            'full_name' => 'required',
            'testimonial'   => 'required',
            'rating'        => 'required'
        ]);
        $testimonial->fill([
            'full_name' => $request->post('full_name'),
            'rating'    => $request->post('rating'),
            'comment'   => $request->post('testimonial'),
            'source'    => $request->post('source'),
            'gender'    => $request->post('gender'),
            'profession'    => $request->post('profession'),
        ]);


        // check if image was uploaded.
        if ($request->file('image') ) {
            // get image
            $image = Image::uploadOnly($request->file('image'));
            $testimonial->images = $image[0]->filepath;
        }

        if ($request->post('gender')) {
            $testimonial->gender = $request->post('gender');
        }

        if ($request->post('profession')) {
            $testimonial->profession = $request->post('profession');
        }

        if (! $testimonial->save()) {
            return back();
        }

        return redirect()->route('admin.testimonials.list');
    }

    public function delete(Testimonial $testimonial) {
        $testimonial->delete();
        return $this->json(true,'Testimonial Deleted.','reload');
    }
}
