@extends('layouts.admin')

@section('title', 'Discounted Product List')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="Head">
                    <h2 class="card-title">Discounted Product List</h2>
                </div>
                <div class="createbtn" >
                <a href="{{ route('admin.discount.creatediscount') }}" class="btn btn-primary mb-3">Create Discount</a>
            </div>
            </div>
            
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Discount (%)</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($discounts as $discount)
                        <tr>
                            <td>{{ $discount->id }}</td>
                            <td>{{ $discount->title }}</td>
                            <td>{{ $discount->percentage }}</td>
                            <td>{{ $discount->start_date }}</td>
                            <td>{{ $discount->end_date }}</td>
                            <td>
                               @if ($discount->status == 1)
                                <span class="badge badge-success">On</span>
                                  @else
                                <span class="badge badge-danger">Off</span>
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
                                        href="{{ route('admin.discount.discounted-product.edit', ['discount' => $discount->id])}} "
                                        class="btn dropdown-item"
                                        >Edit</a
                                    >
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
