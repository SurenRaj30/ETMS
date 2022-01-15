@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        Register New Tourist
                    </div>
                    <div class="card-body">
                        <form action="{{route('createTourist')}}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tourist Name') }}</label>
                                <div class="col-md-6">
                                    <input id="touristName" type="text" class="form-control @error('touristName') is-invalid @enderror" name="rt_name" value="{{ old('touristName') }}" required autocomplete="touristName" autofocus aria-required="true">
    
                                    @error('touristName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact') }}</label>
                                <div class="col-md-6">
                                    <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="rt_contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus aria-required="true">
    
                                    @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Tour Schedule') }}</label>
                                <div class="col-md-3">
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="start_date" value="{{ old('date') }}" required autocomplete="date" autofocus aria-required="true">
    
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="col-md-3">
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="end_date" value="{{ old('date') }}" required autocomplete="date" autofocus aria-required="true">
    
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right ml-3">{{ __('Chosen Package') }}</label>
                                <select name="c_package" class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                @foreach ($services as $data)
                                <option>{{$data->s_name}}</option>
                                @endforeach
                            </select>
    
                                    @error('package')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
    

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection