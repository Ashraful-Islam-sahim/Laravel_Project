<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use Illuminate\Support\Str;
use Image;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('title', 'asc')->get();
        return view('backend.pages.product.manage', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate form fields
    $request->validate([
        'title' => 'required|max:255',
        // Add more validation rules for other fields if needed
    ], [
        'title.required' => 'Please insert the product title.',
        // Customize error messages for other fields as needed
    ]);

    // Create a new Product instance
    $product = new Product();
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->short_desc = $request->short_desc;
        $product->desc = $request->desc;
        $product->tags = $request->tags;
        $product->quantity = $request->quantity;
        $product->regular_price = $request->regular_price;
        $product->offer_price = $request->offer_price;
        $product->sku_code = $request->sku_code;
        $product->product_type = $request->product_type;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->featured_item = $request->featured_item;
        $product->status = $request->status;

    // Upload image if provided
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imgName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('Backend/img/product/'), $imgName);
        $product->image = $imgName;
    }

    // Save the product to the database
    $product->save();

    // Redirect to the manage products page
    return redirect()->route('product.manage');
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
        $product = Product::find($id);
        if(!is_null($product)){
            return view('backend.pages.product.edit', compact('product'));
        }
        else{
            return redirect()->route('product.manage');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you're validating the image
        ], [
            'title.required' => 'Please insert the product title.',
            'image.image' => 'Please upload a valid image file.',
            'image.mimes' => 'Supported image formats are jpeg,png,jpg,gif.',
            'image.max' => 'Maximum file size allowed is 2MB.',
        ]);
        
        // Find the Product by ID
        $product = Product::findOrFail($id);
        
        // Update Product data
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->short_desc = $request->short_desc;
        $product->desc = $request->desc;
        $product->tags = $request->tags;
        $product->quantity = $request->quantity;
        $product->regular_price = $request->regular_price;
        $product->offer_price = $request->offer_price;
        $product->sku_code = $request->sku_code;
        $product->product_type = $request->product_type;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->featured_item = $request->featured_item;
        $product->status = $request->status;
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the previous image if exists
            if (File::exists(public_path('Backend/img/product/' . $product->image))) {
                File::delete(public_path('Backend/img/product/' . $product->image));
            }
        
            // Upload and save new image
            $image = $request->file('image');
            $img = rand() . '.' . $image->getClientOriginalExtension();
            $location = public_path('Backend/img/product/' . $img);
            \Intervention\Image\Facades\Image::make($image)->save($location);
            $product->image = $img;
        }
        
        // Save changes to the database
        $product->save();
        
        return redirect()->route('product.manage')->with('success', 'Product updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!is_null($product)) {
            // Delete the previous image if exists
            if (File::exists(public_path('Backend/img/product/' . $product->image))) {
                File::delete(public_path('Backend/img/product/' . $product->image));
            }
            
            $product->delete();
            return redirect()->route('product.manage')->with('success', 'Product deleted successfully.');
        }else{
             return redirect()->route('product.manage')->with('success', 'Product updated successfully.'); 
        }
    }
}
