@extends('layouts.admin')

@section('title', 'Pending Discount list')

@section('content')
<div class="row justify-content-center ">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="Head">
                <h2 class="card-title">Pending Product Discount list</h2></div>
                <div class="createbtn" >
                <a href="{{ route('admin.discount.creatediscount') }}" class="btn btn-primary mb-3">Create Discount</a>
            </div>
            </div>
            
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Selling Price</th>
                            <th>Status</th>
                            <th>Discount (%)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($discountableProducts as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>${{ $product->selling_price }}</td>
                            @if($product->product_label === 'on_sale')
                            <td>On Sale</td>
                            @endif
                            <td>{{ $product->discount ?? '0' }}</td>
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
                                        href=" {{ route('admin.discounts.edit', $product->id) }} "
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
