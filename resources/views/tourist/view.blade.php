@extends('layouts.app')

@section('content')


<style>
  .carousel-item {
height: 300px;
overflow: hidden;
width: 100%;
}
.carousel-item img {
width: 100%;
}

#cardInfo{
       background-color: #81D4FA;
}

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div id="carouselExampleIndicators" class="carousel slide carousel-dark" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner shadow bg-dark">
                    @foreach (json_decode($service->name) as $picture)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                      <img class="d-block w-100" style="flex-shrink:0;" src="{{ asset('uploads/serviceImages/'.$picture) }}"/>
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>

        <div class="row justify-content-center mt-5">
          <div class="col-md-8">
            <div class="card shadow" id="cardInfo">
              <div class="card-header bg-dark text-light">
                Service Details
              </div>
              <div class="card-body"> 
               <div class="form-group row">
                 <div class="col-md-6">
                     <h4>{{$service->s_name}}</h4>
                 </div>
             </div>
             <div class="form-group row">
              <div class="col-md-6">
                  <p>{{$service->s_category}}</p>
              </div>
          </div>
             <div class="form-group row">
               <div class="col-md-6">
                   <p>RM {{$service->s_price}} per person</p>
               </div>
           </div>
           
            <div class="form-group row">
              <div class="col-md-6">
                  <p>{{$service->s_address}} </p>
              </div>
             </div>
       </div>
      <div class="card" id="cardInfo">
        <div class="card-header bg-dark text-light">
          Service Description
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-md-8">
              <p>{{$service->s_overview}}</p>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <form action="{{url('tourist/bookForm/'.$service->s_id)}}" method="GET">
                <button type="submit" class="btn btn-primary">Book Now</button>
              </form>
            </div>
         </div>
        </div>
      </div>
      <div class="card" id="cardInfo">
        <div class="card-header bg-dark text-light">
          Rate the service
        </div>
        <div class="card-body">
          <div class="form-group row">
            <form action="{{ route('rating') }}" method="POST">
              {{ csrf_field() }}
              <label for="">Rate the service</label>
              <p>Maximum rating is 5 and minimum rating is 1</p>
              <input id="input-1" name="rate" type="number" class="form-control" data-min="0" data-max="5" data-step="1" value="{{ round($service->userAverageRating) }}" data-size="xs">
              <input type="hidden" name="id" required="" value="{{ $service->s_id }}">
              <button class="btn btn-success mt-3">Submit Review</button>
           </form>
          </div>
        </div>
      </div>
        </div>
      </div>
       
            </div>
           </div>
   </div>

          
         
   </div>
</div>

@endsection

