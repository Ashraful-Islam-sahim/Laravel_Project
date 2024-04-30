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
            \Intervention\Image\Facades\Image::make($image)->save($location);
            $slider->image = $img;
        }

        // Save to database
        $slider->save();
            return redirect()->route('slider.manage')->with('success', 'Slider added successfully!');
        // try {
        //     $slider->save();
        //     return redirect()->route('slider.manage')->with('success', 'Slider added successfully!');
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'Failed to add slider. Error: ' . $e->getMessage())->withInput();
        // }
    }

    // Other methods...
}
