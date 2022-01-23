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
  
</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    Service Details
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Service Category') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$service->ts_category}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Service Name') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$service->ts_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" value="{{$service->ts_price}}" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                        <div class="col-md-6">
                            <textarea name="s_address" cols="30" rows="5" readonly>{{$service->ts_address}}</textarea>
                        </div>
                    </div>
                   
                </div>

                <div class="card mt-3" id="card-info">
                    <div class="card-header bg-dark text-light">
                        Service Duration
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Set service start time') }}</label>
                            <div class="col-md-6">
                                  <input type="time" name="start_time" class="form-control" value="{{$service->start_time}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Set service end time') }}</label>
                            <div class="col-md-6">
                                  <input type="time" name="end_time" class="form-control" value="{{$service->end_time}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3" id="card-info">
                    <div class="card-header bg-dark text-light">
                        Service Description
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                                <div>
                                   <textarea class="form-control" name="s_overview" readonly>{{$service->ts_overview}}</textarea>
    
                                   @if($errors->has('overview'))
                                   <span class="text-danger">{{ $errors->first('overview') }}</span>
                               @endif
                                </div>
                        </div>
                    </div>
                </div>
                {{-- Gallery --}}

                <div class="card">
                    <div class="card-header bg-dark text-light">
                        Service Gallery
                    </div>
                    
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div id="carouselExampleIndicators" class="carousel slide carousel-dark" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
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
                                  <a href="/admin/approveService/{{$service->ts_id}}"><button class="btn btn-primary mt-2">Approve</button></a>
                                  <a href="/admin/rejectService/{{$service->ts_id}}"><button  class="btn btn-danger mt-2">Reject</button></a>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>

<!-- jQuery -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(function() {
    // Multiple images preview with JavaScript
    var multiImgPreview = function(input, imgPreviewPlaceholder) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#images').on('change', function() {
        multiImgPreview(this, 'div.imgPreview');
    });
    });    
</script>
               

@endsection