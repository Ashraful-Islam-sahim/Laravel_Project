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
                <form action="{{route('division.update', $division->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <label class="col-sm-4 form-control-label">Division Name<span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" class="form-control" value="{{$division->name}}" name="name" placeholder="Enter firstname">
                        </div>
                    </div><!-- row -->

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Priority<span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input rows="2" class="form-control" value="{{$division->priority}}" name="priority">
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