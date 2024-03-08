@extends('layouts.admin') @section('title', 'Edit Size')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Size Edit </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.size.update',$edit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name"> Name:</label>
                        <input type="text" name="name" id="name" class="form-control @error('name')  is-invalid @enderror" value="{{ $edit->name }}" required />

                        @error('name')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="status">status</label>

                        <select id="status" name="status" class="form-select form-control" aria-label="Default select example">
                            <option value="1" {{ $edit->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $edit->status == 0 ? 'selected' : '' }}>Inactive</option>


                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
