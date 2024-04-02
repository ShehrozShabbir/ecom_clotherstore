@extends('layouts.admin')
@section('title', 'Profile')
@section('content')

    <div class="card">
        <form method="post" action="{{ route('admin.profile.update') }}" class="needs-validation" novalidate="">
            @csrf
            <div class="card-header h3 ">Edit Profile</div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Name</label>
                        <input type="text" name='name' value="{{ auth()->user()->name }}" class="form-control"
                            required="">
                        <div class="invalid-feedback">
                            Please fill in the Name
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}"
                          readonly="">
                      <div class="invalid-feedback">
                          Please fill in the email
                      </div>
                    </div>
                </div>
               


            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header h4">
            Change Password
        </div>
        <div class="card-body">
            <form action="{{ route('reset.password.post') }}" method="POST">
                @csrf
                <div class="row form-group">
                    <div class="col-sm-6">
                        <input type="hidden" name="key" value="{{ base64_encode(auth()->id()) }}">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label>Confirm Password</label>
                        <input type="text" name="password_confirmation" class="form-control">
                    </div>
                    @error('password')
                      <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <button class="btn btn-primary float-right" type="submit">Save</button>
            </form>
        </div>
    </div>

@endsection
