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
@if ($route == 'regServiceShow')
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
                            <input type="text" class="form-control" value="{{$service->s_category}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Service Name') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$service->s_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Max Tourist') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$service->maxTourist}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" value="{{$service->s_price}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                        <div class="col-md-6">
                            <textarea name="s_address" cols="30" rows="10">{{$service->s_address}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Overview') }}</label>
                        <div class="col-md-6">
                        <textarea name="overview" cols="30" rows="10" class="form-control" name="s_overview">{{$service->s_overview}}</textarea>
                        </div>
                    </div>
                </div>

                {{-- <div class="card">
                    <div class="card-header bg-dark text-light">
                        Service Schedule
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input type="text">
                            </div>
                        </div>
                    </div>
                </div> --}}
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
                            </div>
                        </div>
                        
                        
                    </div>
                </div>


@elseif($route == 'editService')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    Service Details
                </div>
                <div class="card-body">
                    <form action="{{url('provider/update/'.$service->s_id)}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Service Type') }}</label>
                            <div class="col-md-6">
                                <select name="s_type" class="form-select form-control" aria-label=".form-select-lg example">
                                    <option selected>{{$service->s_type}}</option>
                                    <option  value="Homestay/Accomodation">Homestay</option>
                                    <option  value="Tourism Service">Tourism Service</option>
                                  </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Service Name') }}</label>
                            <div class="col-md-6">
                                <input 
                                id="serviceName" 
                                type="text" 
                                class="form-control"
                                name="s_name" 
                                value="{{$service->s_name}}" 
                                required autocomplete="serviceName" 
                                autofocus aria-required="true">

                            @if($errors->has('s_name'))
                                <span class="text-danger">{{ $errors->first('s_name') }}</span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Max Tourist') }}</label>
                            <div class="col-md-6">
                                <input 
                                id="maxTourist" 
                                type="number"
                                min="1" 
                                class="form-control"
                                name="maxTourist" 
                                value="{{$service->maxTourist}}" 
                                required autocomplete="maxTourist" 
                                autofocus aria-required="true">

                                @if($errors->has('maxTourist'))
                                <span class="text-danger">{{ $errors->first('maxTourist') }}</span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Price Description') }}</label>
                            <div class="col-md-6">
                                <input 
                                id="price" 
                                type="price" 
                                class="form-control" 
                                name="s_price" 
                                value="{{$service->price}}" 
                                required autocomplete="price" 
                                autofocus aria-required="true">

                                @if($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                            </div>
                        </div>
                </div>
            </div>

            
        <div class="card">
                <div class="card-header bg-dark text-light">
                    Upload Photos
                </div>
           
            <div class="card-body" id="imageCard">
                <div class="user-image mb-3 text-center">
                    <div class="imgPreview"> </div>
                </div>            
    
                <div class="custom-file">
                    <input type="file" name="imageFile[]" class="custom-file-input" id="images">
                    <label class="custom-file-label" for="images">Choose image</label>
                </div>

            </div>
            
        </div>
        <div class="card">
            <div class="card-header bg-dark text-light">
                Overview
            </div>
            <div class="card-body">
                <label for="name" class>{{ __('Overview') }}</label>
                <div class="form-group">
                        <div>
                           <textarea class="form-control" name="s_overview">{{$service->s_overview}}</textarea>

                           @if($errors->has('overview'))
                           <span class="text-danger">{{ $errors->first('overview') }}</span>
                       @endif
                        </div>

                       <button class="btn btn-primary btn-lg mt-3">Submit</button>
                </div>

            </div>
        </div>
        </div>
        </form>
        </div>
    </div>
</div>

<script src="{{asset('ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace('s_overview');
</script>

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
               
@endif

@endsection