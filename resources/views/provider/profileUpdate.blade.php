@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-light">
                   Profile Information
                </div>
                <div class="card-body">
                    <form action="{{url('provider/profileUpdate/'.$user->id)}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input 
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
                                <input  
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

                        <button type="submit" class="btn btn-primary">Submit</button>


                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection