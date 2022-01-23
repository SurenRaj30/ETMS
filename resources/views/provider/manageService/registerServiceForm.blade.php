@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
@if(session()->has('failed'))
<div class="container">
    <div class="alert alert-danger">
        {{session()->get('failed')}}
      </div>
</div>
@endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" id="card-info">
                    <div class="card-header bg-dark text-light">
                        Service Details
                    </div>
                    <div class="card-body">
                        <form action="{{route('registerServiceForm')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Service Category') }}</label>
                                <div class="col-md-6">
                                    <select name="s_category" class="form-select form-control" aria-label=".form-select-lg example">
                                        <option selected>Select service category</option>
                                        <option  value="Fishing">Fishing</option>
                                        <option  value="Boating">Boating</option>
                                        <option  value="Diving">Diving</option>
                                        <option  value="Beach">Beach Side Activity</option>
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
                                    value="{{ old('serviceName') }}" 
                                    required autocomplete="serviceName" 
                                    autofocus aria-required="true">
    
                                @if($errors->has('s_name'))
                                    <span class="text-danger">{{ $errors->first('s_name') }}</span>
                                @endif
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Maximum Tourist Per Day') }}</label>
                                <div class="col-md-6">
                                    <input 
                                    id="maxTourist" 
                                    type="number"
                                    min="1" 
                                    class="form-control"
                                    name="maxTourist" 
                                    value="{{ old('maxTourist') }}" 
                                    required autocomplete="maxTourist" 
                                    autofocus aria-required="true">
    
                                    @if($errors->has('maxTourist'))
                                    <span class="text-danger">{{ $errors->first('maxTourist') }}</span>
                                @endif
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                                <div class="col-md-6">
                                    <input 
                                    id="price" 
                                    type="number"
                                    min="1"
                                    class="form-control" 
                                    name="s_price" 
                                    placeholder="Price per person"
                                    value="{{ old('price') }}" 
                                    required autocomplete="price" 
                                    autofocus aria-required="true">
    
                                    @if($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Deposit Amount') }}</label>
                                <div class="col-md-6">
                                    <input 
                                    id="price" 
                                    type="number"
                                    min="1"
                                    class="form-control" 
                                    name="depositPrice" 
                                    placeholder="Deposit amount "
                                    value="{{ old('depositPrice') }}" 
                                    required autocomplete="price" 
                                    autofocus aria-required="true">
    
                                    @if($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Service Address') }}</label>
                                <div class="col-md-6">
                                    <textarea name="s_address" cols="20" rows="10" class="form-control"></textarea>
    
                                    @if($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                                </div>
                            </div>
                    </div>
                </div>

            <div class="card mt-3" id="card-info">
                    <div class="card-header bg-dark text-light">
                        Upload photos
                    </div>
               
                <div class="card-body" id="imageCard">
                    <div class="user-image mb-3 text-center">
                        <div class="imgPreview"> </div>
                    </div>            
        
                    <div class="custom-file control-group increment">
                        <input type="file" name="imageFile[]" class="custom-file-input" id="images" multiple="multiple">
                        <label class="custom-file-label" for="images">Choose single or multiple image</label>
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
                              <input type="time" name="start_time" class="form-control" value="12:00">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Set service end time') }}</label>
                        <div class="col-md-6">
                              <input type="time" name="end_time" class="form-control" value="13:00">
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
                               <textarea class="form-control" name="s_overview"></textarea>

                               @if($errors->has('overview'))
                               <span class="text-danger">{{ $errors->first('overview') }}</span>
                           @endif
                            </div>

                          
                    </div>
                    <button class="btn btn-primary btn-block">Submit</button>
                </div>
            </div>
            </div>
            </form>
            </div>
        </div>
    </div>


    <!-- jQuery -->
  
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
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
<script>
    $('select').multipleSelect()

    function myFunction() {
  confirm("Are you sure ?");
}
</script>

@endsection