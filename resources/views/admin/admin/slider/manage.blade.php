@extends('layouts.admin') @section('title', $slider ? 'Edit Slider' : 'Create
Slider') @section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    {{ $slider ? "Edit Slider" : "Create Slider" }}
                </h2>
            </div>
            <div class="card-body">
                <!-- Form for slider management -->
                <form
                    action="{{ $slider ? route('admin.sliders.update', $slider->id) : route('admin.sliders.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf @if ($slider) @method('PUT') @endif

                    <!-- Slider Title -->
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control"
                            required
                            value="{{ old('title', $slider->title ?? '') }}"
                        />
                    </div>

                    <!-- Slider Description -->
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea
                            name="description"
                            id="description"
                            class="form-control"
                            >{{ old('description', $slider->description ?? '') }}</textarea
                        >
                    </div>
<div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-control">
        <option value="">Select Status</option>
        <option value="active" {{ old('status', $slider->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ old('status', $slider->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
                    <!-- Slider Image -->
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" name="image" id="image"
                        class="form-control"
                        {{ $slider ? "" : "required" }} accept="image/*">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror @if ($slider && $slider->image_path)
                        <img
                            src="{{ asset($slider->image_path) }}"
                            alt="Slider Image"
                            class="img-fluid mt-2"
                            style="max-width: 200px"
                        />
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">
                        {{ $slider ? "Update" : "Save" }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
