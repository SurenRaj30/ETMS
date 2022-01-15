@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Booking ID</th>
          <th scope="col">Service Name</th>
          <th scope="col">No of Tourist</th>
          <th scope="col">Status</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($list as $data)
          <tr>
              <td>{{$data->id}}</td>
              <td>{{$data->s_name}}</td>
              <td>{{$data->no_tourist}}</td>
              @if ($data->status==0)
              <td>Pending</td>
              @else
                  <td>Accepted</td>
              @endif
              <td>
                  <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Actions
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{url('/tourist/delete/'.$data->id)}}">Delete Booking</a>
                      </div>
                    </div>
                </td>
            </tr>
           
          @endforeach
        
      </tbody>
    </table>
  
  
  </div>
  
@endsection
