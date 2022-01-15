@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .checked {
  color: orange;
}

    #pictureCard {
       background-color: #81D4FA;
}
</style>
@if(isset($details))
<div class="container-fluid">
    <div class="row justify-content-start ml-5">
        @foreach ($details as $data)
        <div class="card shadow text-light m-5" style="width:20rem;" id="pictureCard">
            <?php foreach (json_decode($data->name)as $picture) { ?>
               <?php } ?>
               <img id="picture" class="card-img-top" src="{{ asset('uploads/serviceImages/'.$picture) }}"/>
            <div class="card-body text-dark">
                <h5 class="card-title">{{$data->s_name}}</h5>
                <p class="card-text">RM {{$data->s_price}} per person</p>
                
                @if ($data->averageRating==0)
                <p class="card-text">No rating yet</p>
                @else
                
                @for ($i = 0; $i < $data->averageRating; $i++)
                <span class="fa fa-star checked "></span>
                @endfor

                @endif
                <div class="container justify-content-center">
                    <div class="col mt-2">
                        <a href="bookForm/{{$data->s_id}}" class="btn btn-primary">Book Service</a>
                        <a href="view/{{$data->s_id}}" class="btn btn-primary">View</a>
                    </div>
                </div>
                
                
            </div>
        </div>
        @endforeach      
</div>
@elseif(isset($failed))
<div class="container">
    <h3>No services found</h3>
</div>
@else
<div class="container-fluid">
    <div class="row justify-content-start ml-5">
        @foreach ($service as $data)
        <div class="card shadow text-light m-5" style="width:20rem;" id="pictureCard">
            <?php foreach (json_decode($data->name)as $picture) { ?>
               <?php } ?>
               <img id="picture" class="card-img-top" src="{{ asset('uploads/serviceImages/'.$picture) }}"/>
            <div class="card-body text-dark">
                <h5 class="card-title">{{$data->s_name}}</h5>
                <p class="card-text">RM {{$data->s_price}} per person</p>
                <p class="card-text">Category: {{$data->s_category}}</p>
                <p class="card-text">{{round($data->averageRating, 1)}}<span class="fa fa-star checked"></span></p>
                <div class="container justify-content-center">
                    <div class="col mt-2">
                        <a href="bookForm/{{$data->s_id}}" class="btn btn-primary">Book Service</a>
                        <a href="view/{{$data->s_id}}" class="btn btn-primary">View</a>
                    </div>
                </div>
                
                
            </div>
        </div>
        @endforeach
            
</div>
@endif
@endsection