@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/provider/accept/{{$booking->id}}" method="post">
                @csrf
                <div class="card shadow">
                    <div class="card-header bg-dark text-light">
                        Booking Details
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Service Category') }}</label>
                            <div class="col-md-6">
                                <input readonly type="text" class="form-control" name="s_name" value="{{$booking->s_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Service Name') }}</label>
                            <div class="col-md-6">
                                <input readonly type="text" class="form-control" name="s_name" value="{{$booking->s_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Deposit Price') }}</label>
                            <div class="col-md-6">
                                <input readonly type="text" class="form-control" name="depositPrice" value="{{$booking->depositPrice}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Total Price') }}</label>
                            <div class="col-md-6">
                                <input readonly type="text" class="form-control" name="totalPrice" value="{{$booking->totalPrice}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tour Schedule') }}</label>
                            <div class="col-md-3">
                                <input id="date" type="date" class="form-control" name="start" value="{{ $booking->start }}">
                            </div>
                            <div class="col-md-3">
                                <input id="date" type="date" class="form-control" name="end" value="{{ $booking->end }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Accept</button>
                        <a href="/provider/dashboard"><button type="submit" class="btn btn-danger">Reject</button></a>
                    </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

@endsection