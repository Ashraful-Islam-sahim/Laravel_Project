<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Slider;
use Illuminate\Support\Str;
use Image;
use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::orderBy('id', 'asc')->get();
        return view('backend.pages.slider.manage', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Please insert the slider title.',
        ]);

        // Store data
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->subtitle = $request->subtitle;
        $slider->button_txt = $request->button_txt;
        $slider->button_url = $request->button_url;

        // Image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img = rand() . '.' . $image->getClientOriginalExtension();
            $location = public_path('Backend/img/slider/' . $img);
            Image::make($image)->save($location);
            $slider->image = $img;
        }

        // Save to database
        $slider->save();

        return redirect()->route('slider.manage')->with('success', 'Slider added successfully!');
    }

    public function edit(string $id)
    {
        $slider = Slider::find($id);
        if (!is_null($slider)) {
            return view('backend.pages.slider.edit', compact('slider'));
        } else {
            return redirect()->route('slider.manage');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'title' => 'required|max:255',
        ], [
            'title.required' => 'Please insert the slider title.',
        ]);

        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->button_txt = $request->button_txt;
        $slider->button_url = $request->button_url;
        $slider->description = $request->description;
        
        if ($request->hasFile('image')) {
            // Delete the old image
            if (File::exists(public_path('Backend/img/slider/' . $slider->image))) {
                File::delete(public_path('Backend/img/slider/' . $slider->image));
            }
            // Handle the file upload
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('Backend/img/slider/' . $filename);
            Image::make($image)->save($location);
            $slider->image = $filename;
        }

        $slider->save();

        return redirect()->route('slider.manage')->with('success', 'Slider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::find($id);
        if (!is_null($slider)) {
            // Delete the previous image if exists
            if (File::exists(public_path('Backend/img/slider/' . $slider->image))) {
                File::delete(public_path('Backend/img/slider/' . $slider->image));
            }

            $slider->delete();
            return redirect()->route('slider.manage')->with('success', 'Slider deleted successfully.');
        } else {
            return redirect()->route('slider.manage')->with('error', 'Slider not found.');
        }
    }
}
