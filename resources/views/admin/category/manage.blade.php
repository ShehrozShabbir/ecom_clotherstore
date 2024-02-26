@extends('layouts.admin') @section('title', 'Category Manage') @section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Category Manage</h2>
            </div>
            <div class="card-body">


                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Category Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required
                            value="{{ $data ? $data->name : '' }}" />
                    </div>

                    <input type="hidden" name="id" value="{{ $data ? $data->id : '' }}" />
                    <div class="form-group">
                        <label for="status">Main Category:</label>
                        <select name="main_category" id="main_category" class="form-control" required>
                            <option {{ $data && $data == 'men' ? 'selected' : '' }} value="men">Men</option>
                            <option {{ $data && $data == 'women' ? 'selected' : '' }} value="women">Women</option>
                            <option {{ $data && $data == 'accessories' ? 'selected' : '' }} value="accessories">Accessories</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Category Status:</label>
                        <select name="status" id="status" class="form-control" required>
                            <option {{ $data && $data == '1' ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $data && $data == '0' ? 'selected' : '' }} value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


