<!-- resources/views/branches/show.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between ">
            <h3 class="mb-0">Reset Password</h3>
        </div>
        <div class="card-body">
            <form action="{{route('reset.password.post')}}" method="POST">
                @csrf
                <div class="row form-group">
                    <input type="hidden" name="key" value="{{$key}}">
                    <div class="col-sm-6">
                        <label for="">Password</label>
                        <input type="text" class="form-control" name="password" value="">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="">Confirm Password</label>
                        <input type="text" class="form-control" name="password_confirmation" value="">
                         @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary float-right" type="submit">Change Password</button>
            </form>
        </div>
    </div>


@endsection
