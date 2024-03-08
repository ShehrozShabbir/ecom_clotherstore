@extends('layouts.admin') @section('title', 'Size List')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Size List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $list)
                        <tr>
                            <td>{{ $list->id }}</td>
                            <td>{{ $list->name }}</td>
                            <td>{{ $list->status }}</td>
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
                                        href=" {{ route('admin.size.edit',$list->id) }}"
                                        class="btn dropdown-item"
                                        >Edit</a
                                    >
                                    <form
                                        action="{{ route('admin.size.delete',$list->id) }}"
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
