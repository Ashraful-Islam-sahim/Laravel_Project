@extends('backend.layout.template')
@section('body')
<div class="br-pagetitle">
    <i class="icon ion-ios-gear-outline tx-24" style="font-size:2rem"></i> 
    <div>
        <h4 class="">Dashboard</h4>
          <p class="mg-b-0">All Categoris Create</p>
    </div>
</div>
<div class="br-pagebody ">
    <div class="br-section-wrapper">
        <div class="col-xl-12">
            <div class="form-layout form-layout-4">
                <h6 class="br-section-label">Add Categories</h6>

                <!-- <p class="br-section-text">A basic form where labels are aligned in left.</p> -->
                <form action="{{route('category.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <label class="col-sm-4 form-control-label">Category Name: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" name="name" value="{{$category->name}}"placeholder="Enter firstname">
                        </div>
                    </div><!-- row -->

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Category Description: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <textarea rows="2" class="form-control" name="description" placeholder="Description">{{$category->description}}</textarea>
                        </div>
                    </div>
                    {{-- is parent form --}}
                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Is Parent<span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select class="form-control" name="is_parent" aria-label="Default select example">
                                <option value="0">Select Product Category</option>
                                @foreach (App\Models\Backend\Category::orderBy('name', 'asc')->where('is_parent', 0)->get() as $parentcat)
                                    <option value="{{$parentcat->id}}" @if ($parentcat->is_parent == 0 && $category->id == $parentcat->id)
                                        @selected(true)
                                    @endif>{{$parentcat->name}}</option>
                                @foreach (App\Models\Backend\Category::orderBy('name', 'asc')->where('is_parent', $parentcat->id)->get() as $childcat)    
                                <option value="{{$childcat->id}}" @if ($category->id == $childcat->id)
                                    @selected(true)
                                @endif>{{$childcat->name}}</option>
                                @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                   

                    {{-- product status form --}}
                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Product Status: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select class="form-control" name="status" aria-label="Default select example">
                                <option selected>Select Product Status</option>
                                <option value="0" @if ($category->status==0)
                                    @selected(true)
                                @endif>Inactive</option>
                                <option value="1" @if ($category->status==1)
                                    @selected(true)
                                @endif>Active</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Uplode Image: <span class="tx-danger">*</span></label>
                        @if (!is_null($category->image))
                                <img src="{{asset('Backend/img/category')}}/{{$category->image}}" alt="" width="100px">
                            @else
                                No Image Uploaded
                            @endif
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input class="form-control fileuplode" name="image" type="file" id="formFile">
                        </div>
                    </div>

                    <div class="form-layout-footer mg-t-30">
                        <button class="btn btn-info" type="submit">Submit</button>
                        {{-- <a href="{{route('brand.manage')}}"><button class="btn btn-secondary">Cancel</button></a> --}}
                    </div>
                </form><!-- form-layout-footer -->
            </div>
        </div>
    </div>
</div><!-- form-layout -->


@endsection