@extends('backend.layout.template')
@section('body')
<div class="br-pagetitle">
      <!-- <i class="icon ion-ios-gear-outline tx-24" style="font-size:2rem"></i> -->
        <div>
           <h4 class="">Dashboard</h4>
          <p class="mg-b-0">All Brands Manage</p>
        </div>
    </div>
<div class="br-pagebody ">
    <div class="br-section">
        <h6 class="br-section-label">Manage Brand</h6>
        <!-- <p class="br-section-text">Using the most basic table markup.</p> -->

        <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table table-hover mb-0 ">
                <thead class="thead-colored thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Is Featured</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- start read database data and information --}}
                    
                    @php $i=1; @endphp
                    @foreach ($brands as $brand)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>
                            @if (!is_null($brand->image))
                                <img src="{{asset('Backend/img/brand')}}/{{$brand->image}}" alt="" width="100px">
                            @else
                                No Image Uploaded
                            @endif
                        </td>
                        <td>{{$brand->name}}</td>
                        <td>{{$brand->slug}}</td>
                        <td>{{$brand->description}}</td>
                        <td>
                            @if ($brand->is_featured==1)
                            <span class="badge badge-success">Yes Featured</span>
                            @else
                            <span class="badge badge-warning">Not Featured</span>
                            @endif
                        </td>
                        <td>
                            @if ($brand->status==1)
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-warning">InActive</span>
                            @endif
                        </td>
                        <td class="my-btn">
                            {{-- edit button --}}
                            <a href="{{route('brand.edit', $brand->id)}}"><i class="fa-solid fa-pen-to-square trash"></i>Edit</a>
                            {{-- delete button with modal --}}
                            <a class="trash" href="#" data-toggle="modal" data-target="#deletebrand{{$brand->id}}"><i class="fa fa-solid fa-trash"></i>Delete</a>
                    <!-- Modal -->
                    <div class="modal fade" id="deletebrand{{$brand->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <li><a href="{{route('brand.destroy', $brand->id)}}" class="btn btn-danger text-white">Delete</a></li>
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