@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('sameDate'))
    <div class="alert alert-danger">
        {{ session('sameDate') }}
    </div>
    @endif
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow" style="background: #81D4FA">
                <div class="card-header bg-dark text-light">
                    <div class="row justify-content-center">
                        Booking Form
                        <div class="col">
                            <form action="{{url('fullcalender/'.$service->s_id)}}" method="get">

                                <button class="btn btn-success btn-sm" type="submit">Check Availability</button>
                            </form>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    <form action="{{route('createBooking')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Service Category') }}</label>
                            <div class="col-md-6">
                                <input readonly id="touristName" type="text" class="form-control @error('touristName') is-invalid @enderror" name="s_category" value="{{$service->s_category}}">

                                @error('touristName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Chosen Service') }}</label>
                            <div class="col-md-6">
                                <input readonly id="touristName" type="text" class="form-control @error('touristName') is-invalid @enderror" name="s_name" value="{{$service->s_name}}">

                                @error('touristName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <input type="hidden" name="provider_id" value="{{$service->user_id}}">
                        <input type="hidden" name="service_id" value="{{$service->s_id}}">
                        <input type="hidden" name="totalPrice" value="{{$service->s_price}}">

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('No of Tourist') }}</label>
                            <div class="col-md-6">
                                <input id="contact" type="number" min=1 class="form-control" name="no_tourist">

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
                   
                </div>
            </div>
            <div class="card shadow" style="background: #81D4FA">
                <div class="card-header bg-dark text-light">
                    Tourist Details
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tourist Name') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="t_name" value="{{$user->name}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="t_number" value="{{$user->number}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Emergency Contact Number') }}</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="te_number" required>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Place Booking') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Payment Details
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name on Card') }}</label>
                    <div class="col-md-6">
                        <input
                        class='form-control' size='4' type='text'>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Card Number') }}</label>
                    <div class="col-md-6">
                        <input
                        class='form-control' size='20' type='text'>
                    </div>
                </div>
                <div class="form-group row">
                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                        <label class='control-label'>CVC</label> <input autocomplete='off'
                           class='form-control card-cvc' placeholder='ex. 311' size='4'
                           type='text'>
                     </div>
                     <div class='col-xs-12 col-md-4 form-group expiration required'>
                        <label class='control-label'>Expiration Month</label> <input
                           class='form-control card-expiry-month' placeholder='MM' size='2'
                           type='text'>
                     </div>
                     <div class='col-xs-12 col-md-4 form-group expiration required'>
                        <label class='control-label'>Expiration Year</label> <input
                           class='form-control card-expiry-year' placeholder='YYYY' size='4'
                           type='text'>
                     </div>
                </div>
            </div>
        </div> --}}
    </div>

</div>
@endsection