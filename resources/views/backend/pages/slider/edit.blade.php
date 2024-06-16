@extends('backend.layout.template')
@section('body')
<div class="br-pagetitle">
    <i class="icon ion-ios-gear-outline tx-24" style="font-size:2rem"></i> 
    <div>
        <h4 class="">Dashboard</h4>
          <p class="mg-b-0">All Slider Create</p>
    </div>
</div>
<div class="br-pagebody ">
    <div class="br-section-wrapper">
        <div class="col-xl-12">
            <div class="form-layout form-layout-4">
                <h6 class="br-section-label">Add Slider</h6>

                <!-- <p class="br-section-text">A basic form where labels are aligned in left.</p> -->
                <form action="{{route('slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-4 form-control-label">Title<span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" value="{{$slider->title}}" class="form-control" name="title">
                        </div>
                    </div><!-- row -->
                    
                    <div class="row mb-3">
                        <label class="col-sm-4 form-control-label">SubTitle<span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" value="{{$slider->subtitle}}" class="form-control" name="subtitle">
                        </div>
                    </div><!-- row -->

                    <div class="row mb-3">
                        <label class="col-sm-4 form-control-label">Button Text<span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" value="{{$slider->button_txt}}" class="form-control" name="button_txt">
                        </div>
                    </div><!-- row -->

                    <div class="row mb-3">
                        <label class="col-sm-4 form-control-label">Button URL<span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <input type="text" value="{{$slider->button_url}}" class="form-control" name="button_url">
                        </div>
                    </div><!-- row -->

                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Slider Description: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <textarea rows="2" class="form-control" name="description" placeholder="Description">{{$slider->description}}</textarea>
                        </div>
                    </div>
                    
                    <div class="row mg-t-20">
                        <label class="col-sm-4 form-control-label">Upload Image/sliderLogo: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            @if (!is_null($slider->image))
                                <img src="{{asset('Backend/img/slider')}}/{{$slider->image}}" alt="" width="100px">
                            @else
                                No Image Uploaded
                            @endif
                            <input class="form-control fileupload" name="image" type="file" id="formFile">
                        </div>
                    </div>

                    <div class="form-layout-footer mg-t-30">
                        <button class="btn btn-info" type="submit">Submit</button>
                        {{-- <a href="{{route('slider.manage')}}"><button class="btn btn-secondary">Cancel</button></a> --}}
                    </div>
                </form><!-- form-layout-footer -->
            </div>
        </div>
    </div>
</div><!-- form-layout -->
@endsection
