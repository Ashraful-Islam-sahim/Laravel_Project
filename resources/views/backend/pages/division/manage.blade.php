@extends('backend.layout.template')
@section('body')
<div class="br-pagetitle">
      <!-- <i class="icon ion-ios-gear-outline tx-24" style="font-size:2rem"></i> -->
        <div>
           <h4 class="">Dashboard</h4>
          <p class="mg-b-0">All divisions Manage</p>
        </div>
    </div>
<div class="br-pagebody ">
    <div class="br-section">
        <h6 class="br-section-label">Manage division</h6>
        <!-- <p class="br-section-text">Using the most basic table markup.</p> -->

        <div class="bd rounded table-responsive text-center">
            <table class="table table-hover table-bordered table-striped mb-0" cellspacing="0">
                <thead class="thead-colored thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Division Name</th>
                        <th>Priority</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- start read database data and information --}}
                    @php $i=1; @endphp
                    @foreach ($divisions as $division)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$division->name}}</td>
                        <td>{{$division->priority}}</td>
                        <td class="my-btn">
                            {{-- edit button --}}
                            <a class="btn btn-success btn-sm text-white" href="{{route('division.edit', $division->id)}}"><i class="fa-solid fa-pen-to-square text-white"></i>Edit</a>
                            {{-- delete button with modal --}}
                            <a class="btn btn-danger btn-sm text-white" href="#" data-toggle="modal" data-target="#deletedivision{{$division->id}}"><i class="fa fa-solid fa-trash"></i>Delete</a>
                            
                    <!-- Modal -->
                    <div class="modal fade" id="deletedivision{{$division->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content text-left">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete this Comment?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <ul>
                            <li><a href="{{route('division.destroy', $division->id)}}" class="btn btn-danger text-white">Delete</a></li>
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