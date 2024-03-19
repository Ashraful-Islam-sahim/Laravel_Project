<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Category;
use Illuminate\Support\Str;
use Image;
use File;

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
        \Image::make($image)->save($location);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
