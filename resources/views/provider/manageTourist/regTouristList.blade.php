@extends('layouts.app')

@section('content')

@if (count($RegTourists)>0)
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header border-0">
                    <h4 class="mb-0">Tourist List</h4>
                  </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-hover">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col" class="col-md-3">Name</th>
                            <th scope="col" class="col-md-3">Contact</th>
                            <th scope="col" class="col-md-3">Service Name</th>
                            <th scope="col" class="col-md-3 ">Actions</th>
                          </tr>
                        </thead>
                    <tbody>
                    <tr class="row">@foreach($RegTourists as $data)</tr>
                     <td>{{$data->rt_name}}</td>
                     <td>{{$data->rt_contact}}</td>
                     <td>{{$s_name}}</td>
                   <td>
                    <div class="dropdown show">
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Action links
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="showTourist/{{$data->rt_id}}">View</a>
                          <a class="dropdown-item" href="edit/{{$data->rt_id}}">Edit</a>
                          <a class="dropdown-item" href="deleteTourist/{{$data->rt_id}}">Delete</a> 
                        </div>
                      </div>
                   </td>
                </tbody>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</div> 
@else
<div class="container">
    <div class="card">
        <div class="card-header">
            Tourist List
        </div>
        <div class="card-body">
            No data yet
        </div>
    </div>
</div>
@endif

@endsection