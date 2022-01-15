@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        
           <div class="card shadow-sm" style="width:20rem;">
               <div class="card-body">
                   <h4 class="card-title">Registered Providers</h4>
                   <h4 class="card-text">{{$t_provider}}</h4>
                   <hr>
                   <h4 class="card-title">Registered Services</h4>
                   <h4>{{$t_service}}</h4>
               </div>
           </div>
        <div class="card ml-5 shadow-sm" style="width:20rem;">
            <div class="card-body">
                <h4 class="card-title">Pending Providers</h4>
                   <h4 class="card-text">{{$pt_provider}}</h4>
                   <hr>
                   <h4 class="card-title">Pending Services</h4>
                   <h4>{{$pt_service}}</h4>
            </div>
        </div>
        
       
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Service Rating by Tourists
                </div>
                <div class="card-body shadow border-3">
                    <table class="table table-dark" style="text-align:center;">
                        <thead>
                          <tr>
                            <th scope="col">Provider Name</th>
                            <th scope="col">Service Name</th>
                            <th scope="col">Tourist Average Rating</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($rating as $data)
                            <tr>
                                <td>{{$data->name}}</td>
                                <td>{{$data->s_name}}</td>
                                @if ($data->averageRating==0)
                                    <td style="text-align:center;">No rating yet</td>
                                @else
                                <td style="text-align:center;">{{round($data->averageRating)}}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-center">
                        {!! $rating->links() !!}
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

