<!-- resources/views/admin/brand-list.blade.php -->

@extends('layouts.admin') @section('title', 'Brand List') @section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Brand List</h1>
            </div>
            <div class="card-body">
                <table
                    id="table"
                    class="table table-striped text-center "
                >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Populate table rows with brand data -->
                        @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->name }}</td>
                            <td>
                                @if ($brand->status==1)
                                <span class="badge badge-success">Enabled</span>
                                @else
                                <span class="badge badge-danger">Disabled</span>
                                @endif
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
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
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
