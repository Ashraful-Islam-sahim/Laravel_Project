<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Brand;
use Illuminate\Support\Str;
use Image;
use File;
use Illuminate\Validation\Rules\File as RulesFile;
use Illuminate\Validation\Rules\ImageFile as RulesImageFile;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        return view('backend.pages.brand.manage', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation form name
        $request->validate([
            'name'=>'required|max:255',
        ],
        [
            'name.required'=>'Please Insert the Brand name',
        ]
    );
    // database store
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->description = $request->description;
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;

    // image validation
    if($request->hasFile('image')) {
        $image = $request->file('image');
        $img = rand().'.'.$image->getClientOriginalExtension();
        // public folder backend location image save path
        $location = public_path('Backend/img/brand/'.$img);
        \Intervention\Image\Facades\Image::make($image)->save($location);
        $brand->image = $img;
    }
    
    // Database data save
    $brand->save();
    
    return redirect()->route('brand.manage');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        if(!is_null($brand)){
            return view('backend.pages.brand.edit', compact('brand'));
        }
        else{
            return redirect()->route('brand.manage');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you're validating the image
        ],
        [
            'name.required' => 'Please insert the Brand name.',
            'image.image' => 'Please upload a valid image file.',
            'image.mimes' => 'Supported image formats are jpeg,png,jpg,gif.',
            'image.max' => 'Maximum file size allowed is 2MB.',
        ]);
    
        // Find the Brand by ID
        $brand = Brand::findOrFail($id);
    
        // Update Brand data
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->description = $request->description;
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if (RulesImageFile::exists(public_path('Backend/img/brand/' . $brand->image))) {
                RulesImageFile::delete(public_path('Backend/img/brand/' . $brand->image));
            }
    
            // Upload and save new image
            $image = $request->file('image');
            $img = rand() . '.' . $image->getClientOriginalExtension();
            $location = public_path('Backend/img/brand/' . $img);
            \Intervention\Image\Facades\Image::make($image)->save($location);
            $brand->image = $img;
        }
    
        // Save changes to the database
        $brand->save();
    
        return redirect()->route('brand.manage')->with('success', 'Brand updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        if (!is_null($brand)) {
            // Delete the previous image if exists
            if (File::exists(public_path('Backend/img/brand/' . $brand->image))) {
                File::delete(public_path('Backend/img/brand/' . $brand->image));
            }
            
            $brand->delete();
            return redirect()->route('brand.manage')->with('success', 'Brand deleted successfully.');
        }else{
             return redirect()->route('brand.manage')->with('success', 'Brand updated successfully.'); 
        }
    }
}
