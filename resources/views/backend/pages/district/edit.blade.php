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
                <form action="{{route('district.update', $district->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf                   
                    <div class="form-group">
                        <label>District Name</label>
                        <input type="text" name="name" class="form-control" required="required" value="{{$district->name}}">
                    </div>

                    <div class="form-group">
                        <label>Select Your Division</label>
                        <select name="division_id" class="form-control">
                            <option value="{{$district->division_id}}">
                                @if ($district->division)
                                    {{$district->division->name}}
                                    @else
                                    No Division
                                @endif
                            </option>
                            @foreach (App\Models\Backend\Division::orderBy('name', 'asc')-> get() as $division)
                            <option value="{{$division->id}}">{{$division->name}}</option>
                            @endforeach
                        </select>
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