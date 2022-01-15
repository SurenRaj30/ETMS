@extends('layouts.app')

@section('content')

<div class="container">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @elseif(session()->has('failed'))
    <div class="alert alert-danger">
        {{ session()->get('failed') }}
    </div>
@endif
</div>

<div class="container">
    <div class="row justify-content-center">
        
           <div class="card shadow-sm" style="width:20rem;">
               <div class="card-body">
                   <h3>Registered services</h3>
                   <h3>{{$reg_service}}</h3>
               </div>
           </div>
           <div class="card ml-5 shadow-sm" style="width:20rem;">
            <div class="card-body">
                <h3>Pending Service</h3>
                <h3>{{$p_service}}</h3>
            </div>
        </div>
        <div class="card ml-5 shadow-sm" style="width:20rem;">
            <div class="card-body">
                <h3>Service Bookings</h3>
                <h3>{{$booking}}</h3>
            </div>
        </div>
        
       
    </div>
    
    {{-- <div class="row justify-content-start">
        <table class="table table-dark mt-5 charts-css bar reverse" style="width:50%; margin-left:132px;">
            <thead>
              <tr>
                <th scope="col">Service Name</th>
                <th scope="col">Average Rating</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($serviceRate as $data)
                <tr>
                    <th scope="row">{{$data->s_name}}</th>
                    @if ($data->averageRating==0)
                        <td>0</td>
                    @else
                    <td>{{round($data->averageRating)}}</td>
                    @endif
                    
                </tr>
                @endforeach
              
            </tbody>
          </table>
    </div>

    
    <div id="myPlot" style="width:100%;max-width:700px"></div> --}}
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    User Ratings
                </div>
                <div class="card-body shadow border-3">
                    <table class="table table-dark" style="text-align:center;">
                        <thead>
                          <tr>
                            <th scope="col">Service Name</th>
                            <th scope="col">User Average Rating</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($serviceRate as $data)
                            <tr>
                                <td>{{$data->s_name}}</td>
                                @if ($data->averageRating==0)
                                    <td style="text-align:center;">0</td>
                                @else
                                <td style="text-align:center;">{{round($data->averageRating)}}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    Pending Service
                </div>
                <table class="table table-dark" style="text-align:center;">
                    <thead>
                      <tr>
                        <th scope="col">Service Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($pl_service as $data)
                        <tr>
                            <td>{{$data->ts_name}}</td>
                            @if ($data->status==0)
                                <td style="text-align:center;">Pending</td>
                            @else
                            <td style="text-align:center;">Rejected</td>
                            @endif
                            <td><button class="btn btn-primary">Actions</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>



@endsection

