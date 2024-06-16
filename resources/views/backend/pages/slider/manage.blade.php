@extends('backend.layout.template')
@section('body')
<div class="br-pagetitle">
      <!-- <i class="icon ion-ios-gear-outline tx-24" style="font-size:2rem"></i> -->
        <div>
           <h4 class="">Dashboard</h4>
          <p class="mg-b-0">All sliders Manage</p>
        </div>
    </div>
<div class="br-pagebody ">
    <div class="br-section">
        <h6 class="br-section-label">Manage slider</h6>
        <!-- <p class="br-section-text">Using the most basic table markup.</p> -->

        <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table table-hover mb-0 ">
                <thead class="thead-colored thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Sub-Title</th>
                        <th>Description</th>
                        <th>Button-Txt</th>
                        <th>Button-URL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- start read database data and information --}}
                    
                    @php $i=1; @endphp
                    @foreach ($sliders as $slider)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>
                            @if (!is_null($slider->image))
                                <img src="{{asset('Backend/img/slider')}}/{{$slider->image}}" alt="" width="100px">
                            @else
                                No Image Uploaded
                            @endif
                        </td>
                        <td>{{$slider->title}}</td>
                        <td>{{$slider->subtitle}}</td>
                        <td>{{$slider->description}}</td>
                        <td>{{$slider->button_txt}}</td>
                        <td>{{$slider->button_url}}</td>
                        
                     
                        <td class="my-btn">
                            {{-- edit button --}}
                            <a class="btn btn-success" href="{{route('slider.edit', $slider->id)}}"><i class="fa-solid fa-pen-to-square "></i></a>
                            {{-- delete button with modal --}}
                            <a class=" btn btn-danger" href="#" data-toggle="modal" data-target="#deleteslider{{$slider->id}}"><i class="fa fa-solid fa-trash"></i></a>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteslider{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete this Comment?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <ul>
                            <li><a href="{{route('slider.destroy', $slider->id)}}" class="btn btn-danger text-white">Delete</a></li>
                            <li><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></li>
                            </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                        </td>
                    </tr>
                    {{-- end increate i value and end foreach loop --}}
                    @php $i++; @endphp
                    @endforeach
                </tbody>
                
            </table>
        </div>
        <!-- bd -->

    </div>
</div>
    @endsection