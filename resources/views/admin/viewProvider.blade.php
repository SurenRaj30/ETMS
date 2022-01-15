@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- profile information --}}
            <div class="card mt-3">
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
            <div class="card mt-3">
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
            <div class="card mt-3">
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
            <div class="card mt-3">
                <div class="card-header bg-dark text-light">
                   Business Documents 
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('IC') }}</label>
                        <div class="col-md-6">
                            <img src="{{ asset('uploads/serviceImages/'.($user->ic)) }}" alt="" title="" width="200px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Swa-Foto') }}</label>
                        <div class="col-md-6">
                            <img src="{{ asset('uploads/serviceImages/'.($user->swa)) }}" alt="" title="" width="200px">
                        </div>
                    </div>
                    <a href="profileUpdate" target="_blank" rel="noopener noreferrer">Update Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection