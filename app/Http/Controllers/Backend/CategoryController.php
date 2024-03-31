<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Category;
use Illuminate\Support\Str;
use Image;
use File;
use Illuminate\Validation\Rules\File as RulesFile;
use Illuminate\Validation\Rules\ImageFile as RulesImageFile;
use phpDocumentor\Reflection\Types\Nullable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('backend.pages.category.manage', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.category.create');
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
            'name.required'=>'Please Insert the category name',
        ]
    );
    // database store
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->is_parent = $request->is_parent;
        $category->status = $request->status;

    // image validation
    if($request->hasFile('image')) {
        $image = $request->file('image');
        $img = rand().'.'.$image->getClientOriginalExtension();
        // public folder backend location image save path
        $location = public_path('Backend/img/category/'.$img);
        \Intervention\Image\Facades\Image::make($image)->save($location);
        $category->image = $img;
    }
    
    // Database data save
    $category->save();
    
    return redirect()->route('category.manage');
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
        $category = Category::find($id);
        if(!is_null($category)){
            return view('backend.pages.category.edit', compact('category'));
        }
        else{
            return redirect()->route('category.manage');
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
        $category = Category::findOrFail($id);
    
        // Update Brand data
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->is_parent = $request->is_parent;
        $category->status = $request->status;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if (File::exists(public_path('Backend/img/category/' . $category->image))) {
                File::delete(public_path('Backend/img/category/' . $category->image));
            }
    
            // Upload and save new image
            $image = $request->file('image');
            $img = rand() . '.' . $image->getClientOriginalExtension();
            $location = public_path('Backend/img/brand/' . $img);
            \Intervention\Image\Facades\Image::make($image)->save($location);
            $category->image = $img;
        }
    
        // Save changes to the database
        $category->save();
    
        return redirect()->route('category.manage')->with('success', 'category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!is_null($category)) {
            // Delete the previous image if exists
            if (File::exists(public_path('Backend/img/category/' . $category->image))) {
                File::delete(public_path('Backend/img/category/' . $category->image));
            }
            
            $category->delete();
            return redirect()->route('category.manage')->with('success', 'category deleted successfully.');
        }else{
             return redirect()->route('category.manage')->with('success', 'category updated successfully.'); 
        }
    }
}
