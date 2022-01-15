@extends('layouts.app')

@section('content')

    @if($posts->isNotEmpty())
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="mb-0">Service List</h4>
                      </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-hover">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col" class="col-md-3">Name</th>
                                <th scope="col" class="col-md-3">Service Type</th>
                                <th scope="col" class="col-md-3 ">Actions</th>
                              </tr>
                            </thead>
                        <tbody>
                        <tr class="row">@foreach($posts as $post)</tr>
                
                         <td>{{$post->s_name}}</td>
                         <td>{{$post->s_type}}</td>
                        
                       <td>
                        <div class="dropdown show">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Actions
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <a class="dropdown-item" href="show/{{$post->s_id}}">View</a>
                              <a class="dropdown-item" href="edit/{{$post->s_id}}">Edit</a>
                              <a class="dropdown-item" href="#">Delete</a>
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
    <div>
        <h2>No posts found</h2>
    </div>
@endif

@endsection