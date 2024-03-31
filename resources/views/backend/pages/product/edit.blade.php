@extends('backend.layout.template')
@section('body')
<div class="br-pagetitle">
    <i class="icon ion-ios-gear-outline tx-24" style=""></i> 
    <div>
        <h4 class="">Dashboard</h4>
          <p class="mg-b-0">All Brands Create</p>
    </div>
</div>
<div class="br-pagebody ">
    <div class="br-section-wrapper">
        <div class="col-xl-12">
            <div class="form-layout form-layout-4">
                <h6 class="br-section-label">Add Brand</h6>

                <!-- <p class="br-section-text">A basic form where labels are aligned in left.</p> -->
                <form action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- first row --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Title</label>
                                <input type="text" name="title" class="form-control" required="required" value="{{$product->title}}">
                            </div>
                            <div class="form-group">
                                <label>Regular Price</label>
                                <input type="text" name="regular_price" class="form-control" required="required" value="{{$product->regular_price}}">
                            </div>
                            <div class="form-group">
                                <label>Offer Price</label>
                                <input type="text" name="offer_price" class="form-control" required="required" value="{{$product->offer_price}}">
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity" class="form-control" required="required" value="{{$product->quantity}}">
                            </div>
                            <div class="form-group">
                                <label>Sku Code</label>
                                <input type="text" name="sku_code" class="form-control" required="required" value="{{$product->sku_code}}">
                            </div>
                        </div>
                        {{-- second row --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tags</label>
                                <input type="text" name="tags" class="form-control" required="required" value="{{$product->tags}}">
                            </div>
                            <div class="form-group">
                                <label>Featured Product</label>
                                <select name="featured_item" class="form-control">
                                    <option>Please Select the Featured Status</option>
                                    <option value="0" @if ($product->featured_item == 0)
                                        @selected(true)
                                    @endif>Norlam</option>
                                    <option value="1" @if ($product->featured_item == 1)
                                        @selected(true)
                                    @endif>Featured</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Product Brand</label>
                                <select name="brand_id" class="form-control">
                                    <option value="{{$product->brand_id}}">
                                        @if ($product->brand)
                                            {{$product->brand->name}}
                                            @else
                                            No Brand
                                        @endif
                                    </option>
                                    @foreach (App\Models\Backend\Brand::orderBy('name', 'asc')-> get() as $parentcat)
                                    <option value="{{$parentcat->id}}">{{$parentcat->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Product Category/Subcategory</label>
                                <select class="form-control" name="category_id">
                                    <option value="{{$product->category_id}}">
                                        @if ($product->category)
                                            {{$product->category->name}}
                                        @else
                                            No Category
                                        @endif
                                    </option>
                                    @foreach (App\Models\Backend\Category::orderBy('name', 'asc')->where('is_parent', 0)->get() as $parentcat)
                                        <option value="{{$parentcat->id}}">{{$parentcat->name}}</option>
                                    @foreach (App\Models\Backend\Category::orderBy('name', 'asc')->where('is_parent', $parentcat->id)->get() as $childcat)    
                                    <option value="{{$childcat->id}}">{{$childcat->name}}</option>
                                    @endforeach
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Product type/Condition</label>
                                <select name="product_type" class="form-control">
                                    <option>Please Select the product type/condition</option>
                                    <option value="0" @if ($product->product_type == 0)
                                        @selected(true)
                                    @endif>New</option>
                                    <option value="1" @if ($product->product_type == 1)
                                        @selected(true)
                                    @endif>Pre_Owned</option>
                                </select>
                            </div>
                            
                        </div>
                        {{-- third row --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea name="desc" class="form-control">{{$product->desc}}</textarea>
                            </div>

                            <div class="form-group">
                                <label> Short Description</label>
                                <textarea name="short_desc" class="form-control">{{$product->short_desc}}</textarea>
                            </div>

                         <div class="form-group">
                                <label>Prodcut Status</label>
                                <select name="status" class="form-control">
                                    <option>Please Select the Featured Status</option>
                                    <option value="0" @if ($product->status == 0)
                                        @selected(true)
                                    @endif>Inactive</option>
                                    <option value="1" @if ($product->status == 1)
                                        @selected(true)
                                    @endif>Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label></label>
                                @if (!is_null($product->image))
                                <img class="img-thumbnail" src="{{asset('Backend/img/product')}}/{{$product->image}}" alt="" width="100px">
                            @else
                                No Image Uploaded
                            @endif
                                <input type="file" name="image" class="form-control-file">
                            </div> 
                        </div>                       
                    </div>
                    <div class="form-layout-footer mg-t-30">
                        <button class="btn btn-info btn-block" type="submit">Save Change</button>
                        {{-- <a href="{{route('brand.manage')}}"><button class="btn btn-secondary">Cancel</button></a> --}}
                    </div>
                    
                </form><!-- form-layout-footer -->
            </div>
        </div>
    </div>
</div><!-- form-layout -->


@endsection