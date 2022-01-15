@extends('layouts.app')

@section('content')

@if ($route == 'showTourist')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    Registered Tourist oops
                </div>
                <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tourist Name') }}</label>
                            <div class="col-md-6">
                                <input readonly id="touristName" type="text" class="form-control @error('touristName') is-invalid @enderror" name="rt_name" value="{{ $list->rt_name }}" required autocomplete="touristName" autofocus aria-required="true">

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
                                <input readonly id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="rt_contact" value="{{ $list->rt_contact }}" required autocomplete="contact" autofocus aria-required="true">

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
                                <input readonly id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="start_date" value="{{ $list->start_date }}" required autocomplete="date" autofocus aria-required="true">

                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="col-md-3">
                                <input readonly id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="end_date" value="{{  $list->end_date }}" required autocomplete="date" autofocus aria-required="true">

                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Chosen Package') }}</label>
                            <div class="col-md-6">
                                <input readonly id="package" type="text" class="form-control @error('package') is-invalid @enderror" name="c_package" value="{{  $list->c_package }}" required autocomplete="package" autofocus aria-required="true">

                                @error('package')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">  
                           <a href={{url('provider/edit/'.$list->rt_id)}}>Edit Tourist</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@elseif($route == 'editTourist')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    Registered Tourist List
                </div>
                <div class="card-body">
                    <form action="{{url('provider/update/'.$list->rt_id)}}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tourist Name') }}</label>
                            <div class="col-md-6">
                                <input id="touristName" type="text" class="form-control @error('touristName') is-invalid @enderror" name="rt_name" value="{{ $list->rt_name }}" required autocomplete="touristName" autofocus aria-required="true">

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
                                <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="rt_contact" value="{{ $list->rt_contact }}" required autocomplete="contact" autofocus aria-required="true">

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
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="start_date" value="{{ $list->start_date }}" required autocomplete="date" autofocus aria-required="true">

                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="col-md-3">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="end_date" value="{{  $list->end_date }}" required autocomplete="date" autofocus aria-required="true">

                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Chosen Package') }}</label>
                            <div class="col-md-6">
                                <input id="package" type="text" class="form-control @error('package') is-invalid @enderror" name="c_package" value="{{  $list->c_package }}" required autocomplete="package" autofocus aria-required="true">

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
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection