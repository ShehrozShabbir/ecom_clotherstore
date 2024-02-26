<!-- resources/views/admin/edit-brand.blade.php -->

@extends('layouts.admin') @section('title', 'Edit Brand') @section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Edit Brand</h1>
            </div>
            <div class="card-body">
                <table id="brand-table" class="table table-striped table-bordered dataTable1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Populate table rows with brand data -->
                        @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->name }}</td>
                            <td>
                                {{ $brand->status == 1 ? 'Enabled' : 'Disabled' }}
                            </td>
                            <td>
                                <a type="button" style="cursor: pointer" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu">
                                <a
                                    href="{{ route('admin.edit.brand', ['id' => $brand->id]) }}"
                                    class="btn dropdown-item"
                                    >Edit</a
                                >
                                <form
                                    action="{{ route('admin.delete.brand', $brand->id) }}"
                                    method="POST"
                                    style="display: inline"
                                >
                                    @csrf @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn dropdown-item"
                                    >
                                        Delete
                                    </button>
                                </div>
                                </form>
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
