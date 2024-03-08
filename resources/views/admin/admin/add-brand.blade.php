@extends('layouts.admin') @section('title', 'Create Brand') @section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Create Brand</h2>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session("success") }}
                </div>
                @endif @if(session('error'))
                <div class="alert alert-danger">
                    {{ session("error") }}
                </div>
                @endif

                <form action="{{ route('admin.store.brand') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Brand Name:</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label for="status">Brand Status:</label>
                        <select
                            name="status"
                            id="status"
                            class="form-control"
                            required
                        >
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Add Brand
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
