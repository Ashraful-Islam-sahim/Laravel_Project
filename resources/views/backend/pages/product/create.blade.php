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
                <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- first row --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Title</label>
                                <input type="text" name="title" class="form-control" required="required">
                                                  <div class="form-group">
                                <label>Regular Price</label>
                                <input type="text" name="regular_price" class="form-control" required="required">
                            </div>      </div>
                            <div class="form-group">
                                <label>Regular Price</label>
                                <input type="text" name="regular_price" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label>Offer Price</label>
                                <input type="text" name="offer_price" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label>Sku Code</label>
                                <input type="text" name="sku_code" class="form-control" required="required">
                            </div>
                        </div>
                        {{-- second row --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tags</label>
                                <input type="text" name="tags" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label>Featured Product</label>
                                <select name="featured_item" class="form-control">
                                    <option>Please Select the Featured Status</option>
                                    <option value="0">Norlam</option>
                                    <option value="1">Featured</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Product Brand</label>
                                <select name="brand_id" class="form-control">
                                    <option>Please Select the Product Brand</option>
                                    @foreach (App\Models\Backend\Brand::orderBy('name', 'asc')-> get() as $parentcat)
                                    <option value="{{$parentcat->id}}">{{$parentcat->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Product Category/Subcategory</label>
                                <select class="form-control" name="category_id">
                                    <option value="0">Select Product Featured</option>
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
                                    <option value="0">New</option>
                                    <option value="1">Pre_Owned</option>
                                </select>
                            </div>
                            
                        </div>
                        {{-- third row --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea rows="2" class="form-control" name="desc" placeholder="Description"></textarea>
                            </div>

                            <div class="form-group">
                                <label> Short Description</label>
                                <textarea rows="2" class="form-control" name="short_desc" placeholder="Short description"></textarea>
                            </div>

                         <div class="form-group">
                                <label>Prodcut Status</label>
                                <select name="status" class="form-control">
                                    <option>Please Select the Featured Status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product Logo/Image</label>
                                <input type="file" name="image" class="form-control-file">
                            </div> 
                        </div>                       
                    </div>
                    <div class="form-layout-footer mg-t-30">
                        <button class="btn btn-info btn-block" type="submit">Submit</button>
                        {{-- <a href="{{route('brand.manage')}}"><button class="btn btn-secondary">Cancel</button></a> --}}
                    </div>
                    
                </form><!-- form-layout-footer -->
            </div>
        </div>
    </div>
</div><!-- form-layout -->


@endsection