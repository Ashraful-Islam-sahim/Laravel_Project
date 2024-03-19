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
                        <th>Category/Subcategory</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- start read database data and information --}}
                    @php $i=1; @endphp
                    @foreach ($categories as $category)
                        @if ($category->is_parent== 0)
                                                    
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>
                            @if (!is_null($category->image))
                                <img src="{{asset('Backend/img/category')}}/{{$category->image}}" alt="" width="100px">
                            @else
                                No Image Uploaded
                            @endif
                        </td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>{{$category->description}}</td>
                        <td>
                            @if ($category->is_parent==0)
                            <span class="badge badge-success">Primary Category</span>
                            @else
                            <span class="badge badge-warning">{{$category->parent->name}}</span>
                            @endif
                        </td>
                        <td>
                            @if ($category->status==1)
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-warning">InActive</span>
                            @endif
                        </td>
                        <td class="my-btn">
                            {{-- edit button --}}
                            <a href="{{route('category.edit', $category->id)}}"><i class="fa-solid fa-pen-to-square trash"></i>Edit</a>
                            {{-- delete button with modal --}}
                            <a class="trash" href="#" data-toggle="modal" data-target="#deletecategory{{$category->id}}"><i class="fa fa-solid fa-trash"></i>Delete</a>
                    <!-- Modal -->
                    <div class="modal fade" id="deletecategory{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <li><a href="{{route('category.destroy', $category->id)}}" class="btn btn-danger text-white">Delete</a></li>
                            <li><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></li>
                            </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                        </td>
                    </tr>

                    {{-- subcategory table --}}
                    @foreach(App\Models\Backend\Category::orderBy('name', 'asc')->where('is_parent', $category->id)->get() as $subcat)
                    @php
                        $j = $i+1;
                    @endphp
                    <tr>
                        <th scope="row">{{$j}}</th>
                        <td>
                            @if (!is_null($subcat->image))
                                <img src="{{asset('Backend/img/category')}}/{{$subcat->image}}" alt="" width="100px">
                            @else
                                No Image Uploaded
                            @endif
                        </td>
                        <td>{{$subcat->name}}</td>
                        <td>{{$subcat->slug}}</td>
                        <td>{{$subcat->description}}</td>
                        <td>
                            <span class="badge badge-warning">{{$subcat->parent->name}}</span>
                        </td>
                        <td>
                            @if ($subcat->status==1)
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-warning">InActive</span>
                            @endif
                        </td>
                        <td class="my-btn">
                            {{-- edit button --}}
                            <a href="{{route('category.edit', $subcat->id)}}"><i class="fa-solid fa-pen-to-square trash"></i>Edit</a>
                            {{-- delete button with modal --}}
                            <a class="trash" href="#" data-toggle="modal" data-target="#deletecategory{{$subcat->id}}"><i class="fa fa-solid fa-trash"></i>Delete</a>
                    <!-- Modal -->
                    <div class="modal fade" id="deletecategory{{$subcat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <li><a href="{{route('category.destroy', $subcat->id)}}" class="btn btn-danger text-white">Delete</a></li>
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
                    @php $i++; @endphp
                    @endif
                    @endforeach
                </tbody>
                
            </table>
        </div>
        <!-- bd -->

    </div>
</div>
    @endsection