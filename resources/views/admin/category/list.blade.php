@extends('layouts.admin') @section('title', 'Add Brand') @section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Category Lists</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Main Category</th>
                            <th>Status</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $items)


                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$items->name}}</td>
                            <td>{{$items->main_category}}</td>
                            <td>
                                @if ($items->status==1)
                                <span class="badge badge-success">Enabled</span>
                                @else
                                <span class="badge badge-success">Disabled</span>
                                @endif

                            </td>
                            <td>
                                <a type="button" style="cursor: pointer" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                  </a>
                                  <div class="dropdown-menu">
                                    <a  class="dropdown-item text-danger" href="{{ route('admin.category.edit', base64_encode($items->id)) }}">Edit</a>

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
