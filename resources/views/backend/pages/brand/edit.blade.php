@extends('backend.layout.template')
@section('body')
<div class="br-pagetitle">
    <i class="icon ion-ios-gear-outline tx-24" style="font-size:2rem"></i> 
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
                <form action="{{route('brand.update', $brand->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <label class="col-sm-4 form-control-label">Brand Name: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" name="name" value="{{$brand->name}}" placeholder="Enter firstname">
                        </div>
                    </div><!-- row -->

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Brand Discription: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <textarea rows="2" class="form-control" name="description" placeholder="Description">{{$brand->description}}</textarea>
                        </div>
                    </div>
                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Product Featured<span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <select class="form-control" name="is_featured" aria-label="Default select example">
                                <option selected>Select Product Featured</option>
                                <option value="1" @if ($brand->is_featured==1)
                                    @selected(true)
                                @endif>Yes Featured</option>
                                <option value="0" @if ($brand->is_featured==0)
                                    @selected(true)
                                @endif>No Featured</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Product Status: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <select class="form-control" name="status" aria-label="Default select example">
                                <option selected>Select Product Status</option>
                                <option value="0" @if ($brand->status==0)
                                    @selected(true)
                                @endif>Inactive</option>
                                <option value="1" @if ($brand->status==1)
                                    @selected(true)
                                @endif>Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Uplode Image/BrandLogo: <span class="tx-danger">*</span></label>
                        @if (!is_null($brand->image))
                                <img src="{{asset('Backend/img/brand')}}/{{$brand->image}}" alt="" width="100px">
                            @else
                                No Image Uploaded
                            @endif
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input class="form-control fileuplode" name="image" type="file" id="formFile">
                        </div>
                    </div>

                    <div class="form-layout-footer mg-t-30">
                        <button class="btn btn-info" type="submit">Save Change</button>
                        {{-- <a href="{{route('brand.manage')}}"><button class="btn btn-secondary">Cancel</button></a> --}}
                    </div>
                </form><!-- form-layout-footer -->
            </div>
        </div>
    </div>
</div><!-- form-layout -->


@endsection