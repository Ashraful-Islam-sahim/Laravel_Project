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
                        <th>Title</th>
                        <th>Image</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Regular Price</th>
                        <th>Offer Price</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- start read database data and information --}}
                    @php $i=1; @endphp
                    @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$product->title}}</td>
                        <td>
                            @if (!is_null($product->image))
                                <img src="{{ asset('Backend/img/product/' . $product->image) }}" alt="" width="100px">
                            @else
                                No Image Uploaded
                            @endif
                        </td>
                        <td>{{ optional($product->brand)->name }}</td>
                        <td>{{ optional($product->category)->name }}</td>
                        <td>{{$product->quantity}} PCs</td>
                        <td>{{$product->regular_price}} BDT</td>
                        <td>@if (!is_null($product->offer_price))
                            {{$product->offer_price}} BDT
                            @else
                            <span>Not Available</span>
                            @endif
                        </td>
                        <td>
                            @if ($product->featured_item==1)
                            <span class="badge badge-success">Featured</span>
                            @else
                            <span class="badge badge-warning">Normal</span>
                            @endif
                        </td>
                        <td>
                            @if ($product->status==1)
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-warning">InActive</span>
                            @endif
                        </td>
                        <td class="my-btn">
                            {{-- edit button --}}
                            <a href="{{route('product.edit', $product->id)}}"><i class="fa-solid fa-pen-to-square trash"></i>Edit</a>
                            {{-- delete button with modal --}}
                            <a class="trash" href="#" data-toggle="modal" data-target="#deleteproduct{{$product->id}}"><i class="fa fa-solid fa-trash"></i>Delete</a>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteproduct{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <li><a href="{{route('product.destroy', $product->id)}}" class="btn btn-danger text-white">Delete</a></li>
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