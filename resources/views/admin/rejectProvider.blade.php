@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-2">
                <div class="card-header bg-dark text-light">
                    Reject Form
                </div>
                <form action="{{url('admin/reject/'.$data->id)}}" method="post">
                    @csrf
                    <div class="card-body">
                        <textarea name="reason" cols="30" rows="10" class="form-control"></textarea>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection