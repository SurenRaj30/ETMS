@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- profile information --}}
            <div class="card mt-3" id="card-info">
                <div class="card-header bg-dark text-light">
                   Profile Information
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input readonly 
                            id="name" 
                            type="text" 
                            class="form-control"
                            name="name" 
                            value="{{ $user->name }}" 
                            required autocomplete="name" 
                            autofocus aria-required="true"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                        <div class="col-md-6">
                            <input readonly 
                            id="email" 
                            type="text" 
                            class="form-control"
                            name="email" 
                            value="{{ $user->email }}" 
                            required autocomplete="email" 
                            autofocus aria-required="true"
                            >
                        </div>
                    </div>
                </div>
            </div>
            {{-- address information --}}
            <div class="card mt-3" id="card-info">
                <div class="card-header bg-dark text-light">
                    Address Information
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>
                        <div class="col-md-6">
                            <input readonly 
                            id="street" 
                            type="text" 
                            class="form-control"
                            name="name" 
                            value="{{ $user->street }}" 
                            required autocomplete="name" 
                            autofocus aria-required="true"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                        <div class="col-md-6">
                            <input readonly 
                            id="name" 
                            type="text" 
                            class="form-control"
                            name="city" 
                            value="{{ $user->city }}" 
                            required autocomplete="name" 
                            autofocus aria-required="true"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
                        <div class="col-md-6">
                            <input readonly 
                            id="name" 
                            type="text" 
                            class="form-control"
                            name="city" 
                            value="{{ $user->state }}" 
                            required autocomplete="name" 
                            autofocus aria-required="true"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>
                        <div class="col-md-6">
                            <input readonly 
                            id="name" 
                            type="text" 
                            class="form-control"
                            name="postcode" 
                            value="{{ $user->postcode }}" 
                            required autocomplete="name" 
                            autofocus aria-required="true"
                            >
                        </div>
                    </div>
                </div>
            </div>
            {{-- contact information --}}
            <div class="card mt-3" id="card-info">
                <div class="card-header bg-dark text-light">
                    Contact Information
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Phone No') }}</label>
                        <div class="col-md-6">
                            <input readonly 
                            id="name" 
                            type="text" 
                            class="form-control"
                            name="postcode" 
                            value="{{ $user->p_no }}" 
                            required autocomplete="name" 
                            autofocus aria-required="true"
                            >
                        </div>
                    </div>
                </div>
            </div>
            {{-- business information --}}
            <div class="card mt-3" id="card-info">
                <div class="card-header bg-dark text-light">
                   Business Documents 
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
                                    <div class="carousel-item active">
                                      <img class="d-block w-100" style="flex-shrink:0;" src="{{ asset('uploads/serviceImages/'.($user->ic)) }}"/>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" style="flex-shrink:0;" src="{{ asset('uploads/serviceImages/'.($user->swa)) }}"/>
                                    </div>
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
                    <a href="/admin/approve/{{$user->id}}"><button class="btn btn-primary btn mt-3">Approve</button></a>
                    <a href="/admin/reject/{{$user->id}}"><button class="btn btn-danger btn mt-3">Reject</button></a>
                </div>
            </div>
            {{-- <div class="card mt-3">
                <div class="card-header bg-dark text-light">
                    Swa-Foto
                </div>
                <div class="card-body">
                    <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Swa-Foto') }}</label>

                    <div class="form-group row justify-content-center">
                        <div class="col-md-6">
                            <img src="{{ asset('uploads/serviceImages/'.($user->swa)) }}" alt="" title="" width="500px">
                        </div>
                    </div>
                    <button class="btn btn-primary btn mt-3">Approve</button>
                    <button class="btn btn-danger btn mt-3">Reject</button>
                </div>
            </div> --}}

        </div>
    </div>
</div>


@endsection