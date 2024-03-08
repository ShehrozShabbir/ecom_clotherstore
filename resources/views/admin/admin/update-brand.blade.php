@extends('layouts.admin') @section('title', 'Update Brand') @section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Update Brand</h1>
            </div>
            <div class="card-body">
                <form
                    method="POST"
                    action="{{ route('admin.update.brand', $brand->id) }}"
                >
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="{{ $brand->name }}"
                        />
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ $brand->
                                status == 1 ? 'selected' : '' }}>Enabled
                            </option>
                            <option value="0" {{ $brand->
                                status == 0 ? 'selected' : '' }}>Disabled
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Update Brand
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
