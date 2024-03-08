@extends('layouts.admin') @section('title', 'Slider List') @section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Slider List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img
                                    src="{{ asset($slider->image_path) }}"
                                    alt="{{ $slider->title }}"
                                    class="img-thumbnail"
                                    style="max-width: 100px"
                                />
                            </td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ $slider->description }}</td>
                            <td>
                                @if ($slider->status == 'active')
                                <span class="badge badge-success">Enabled</span>
                                @else
                                <span class="badge badge-danger">Disabled</span>
                                @endif
                            </td>
                            <td>
                                <a
                                    type="button"
                                    style="cursor: pointer"
                                    data-toggle="dropdown"
                                >
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a
                                        href=" {{ route('admin.sliders.edit', $slider->id) }}"
                                        class="btn dropdown-item"
                                        >Edit</a
                                    >
                                    <form
                                        action="{{ route('admin.sliders.destroy', $slider->id) }}"
                                        method="POST"
                                        style="display: inline"
                                    >
                                        @csrf @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
