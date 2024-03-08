@extends('layouts.admin')
@section('title', 'Product Details')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header d-flex justify-content-between bg-primary">
                <h2 class="card-title text-white">Product Details</h2>
                <div class="d-flex">
                        <!-- Edit button -->
                    <a class="btn btn-light shadow m-1" href="{{ route('admin.products.edit', $product->id) }}">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a class="nav-link btn btn-light shadow m-1" href="{{ route('admin.product.list') }}"><i class="fas fa-list"></i> Product List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Product basic information -->
                        <div class="row">
                            <div class="col-12">
                                <h1>{{ $product->name }}</h1>
                            </div>
                            <div class="col-md-6">
                                <p><strong>ID:</strong> {{ $product->id }}</p>
                                <p><strong>Brand:</strong> {{ $product->brand->name }}</p>
                                <p><strong>Selling Price:</strong> {{ $product->selling_price }}</p>
                                <p><strong>Size:</strong> {{ $product->size }}</p>
                                <p><strong>Stock Quantity:</strong> {{ $product->stock_quantity }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Category:</strong> {{ $product->category->name }}</p>
                                <p><strong>Buying Price:</strong> {{ $product->buying_price }}</p>
                                <p><strong>Status:</strong> {{ $product->status }}</p>
                                <p><strong>Product Label:</strong> {{ $product->product_label }}</p>
                            </div>
                        </div>

                        <!-- Product images -->
                        <div class="row">
                            <div class="col-12">
                                <h4 class="pt-5">Product Images:</h4>
                            </div>
                            @foreach ($product->images as $image)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="{{ asset($image->image_path) }}" class="card-img-top img-fluid" alt="Product Image">
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Product meta -->
                        @php
                            $product->product_meta=json_decode($product->product_meta);
                        @endphp
                        <h4 class="pt-5">Product Meta:</h4>
                        <div class="row">
                            @foreach ($product->product_meta as $size => $data)
                            <div class="col-md-6">
                                <div class="card mb-3 shadow">
                                    <div class="card-header bg-primary pb-1">
                                        <h5 class="card-title text-white">Size: {{ strtoupper($size) }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><strong>Selling Price:</strong> ${{ $data['selling_price'] }}</p>
                                        <p class="card-text"><strong>Buying Price:</strong> ${{ $data['buying_price'] }}</p>
                                        <p class="card-text"><strong>Other Price:</strong> ${{ $data['other_price'] }}</p>
                                        <p class="card-text"><strong>Stock Quantity:</strong> {{ $data['stock_quantity'] }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
