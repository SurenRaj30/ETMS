@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-start">
    <div class="col-md-4">
        <button type="submit" class="btn btn-primary mt-3">Back</button>
    </div>
  </div>
  <div class="row justify-content-center mt-5 shadow p-3">
    <div class="col-md-12">
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
            @foreach ($posts as $data)
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
                          @if ($data->status==0)
                          <a class="dropdown-item" href="{{url('/provider/accept/'.$data->id)}}">Accept</a>
                          <a class="dropdown-item" href="{{url('/provider/reject/'.$data->id)}}">Reject</a>
                          @elseif($data->status==1)
                          <a class="dropdown-item" href="javascript:void(0)">Accept</a>
                          <a class="dropdown-item" href="javascript:void(0)">Reject</a>
                          @endif
                          <a class="dropdown-item" href="{{url('/provider/delete/'.$data->id)}}">Delete Booking</a>
                        </div>
                      </div>
                  </td>
              </tr>
             
            @endforeach
          
        </tbody>
      </table>
    
    
    </div>
  </div>



</div>

@endsection