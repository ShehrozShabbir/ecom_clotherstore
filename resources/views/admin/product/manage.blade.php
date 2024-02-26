@extends('layouts.admin')
@section('title', $product ? 'Edit Product' : 'Add Product')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        {{ $product ? 'Edit Product' : 'Add Product' }}
                    </h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form
                        action="{{ $product ? route('admin.products.update', $product->id) : route('admin.product.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf @if ($product)
                            @method('PUT')
                        @endif

                        <!-- First Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" id="name" class="form-control" required
                                        value="{{ old('name', $product->name ?? '') }}" />
                                </div>
                                <div class="form-group">
                                    <label for="details">Details:</label>
                                    <textarea name="details" id="details" class="form-control">{{ old('details', $product->details ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="brand">Brand:</label>
                                    <select name="brand_id" id="brand" class="form-control" required>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ isset($product) && $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category:</label>
                                    <select name="category_id" id="category" class="form-control" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}  {{ $category->main_category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @foreach ($sizes as $size)


                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label for="size">Size:</label>
                                <input type="text" readonly value="{{$size->name}}" name="size[]" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                    <label for="selling_price">Selling Price:</label>
                                    <input type="text" name="selling_price[]" id="selling_price" class="form-control"
                                        required pattern="[0-9]+([\.][0-9]+)?" title="Please enter a valid number"
                                        inputmode="numeric"
                                        value="{{ old('selling_price', $product->selling_price ?? '') }}" />

                            </div>
                            <div class="col-sm-2">
                                <label for="buying_price">Buying Price:</label>
                                <input type="text" name="buying_price[]" id="buying_price" class="form-control"
                                    required pattern="[0-9]+([\.][0-9]+)?" title="Please enter a valid number"
                                    inputmode="numeric"
                                    value="{{ old('buying_price', $product->buying_price ?? '') }}" />
                            </div>
                            <div class="col-sm-2">
                                <label for="buying_price">Other Price:</label>
                                <input type="text" name="other_price[]" id="other_price" class="form-control"
                                    required pattern="[0-9]+([\.][0-9]+)?" title="Please enter a valid number"
                                    inputmode="numeric"
                                    value="{{ old('other_price', $product->other_price ?? '') }}" />
                            </div>
                            <div class="col-sm-3">
                                <label for="stock_quantity">Stock Quantity:</label>
                                <input type="number" name="stock_quantity" id="stock_quantity" class="form-control"
                                    required value="{{ old('stock_quantity', $product->stock_quantity ?? '') }}" />
                            </div>
                        </div>
                        @endforeach
                        <!-- Third Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="product_label">Product Status:</label>
                                <select name="status" id="product_label" class="form-control">
                                    <option value="available"
                                        {{ old('product_label', $product->status ?? '') === 'available' ? 'selected' : '' }}>
                                        Available</option>
                                    <option value="not_available"
                                        {{ old('product_label', $product->product_label ?? '') === 'not_available' ? 'selected' : '' }}>
                                        Not Available</option>

                                </select>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_label">Product Label:</label>
                                    <select name="product_label" id="product_label" class="form-control">
                                        <option value="new"
                                            {{ old('product_label', $product->product_label ?? '') === 'new' ? 'selected' : '' }}>
                                            New</option>
                                        <option value="hot"
                                            {{ old('product_label', $product->product_label ?? '') === 'hot' ? 'selected' : '' }}>
                                            Hot</option>
                                        <option value="on_sale"
                                            {{ old('product_label', $product->product_label ?? '') === 'on_sale' ? 'selected' : '' }}>
                                            On Sale</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Third Row for Product Images -->
                        <div class="form-group">
                            <label for="images">Product Images:</label>
                            @if ($product && $product->images()->count() > 0)
                                <div class="row">
                                    @foreach ($product->images as $image)
                                        <div class="col-md-3" data-image-id="{{ $image->id }}">
                                            <img src="{{ asset($image->image_path) }}" alt="Product Image"
                                                class="img " width="50px" height="50px">
                                            <button type="button" class="btn btn-danger btn-sm mt-2"
                                                onclick="removeImage({{ $image->id }})">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <input type="file" {{$product?"":"required"}} name="images[]" id="images" class="form-control mt-2" multiple
                                accept="images/*">
                                @error('images')
<span class="text-danger">{{$message}} </span>
                                @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary float-right">
                            {{ $product ? 'Update' : 'Save' }}
                        </button>
                        <!-- Hidden input fields to track deleted images -->
                        @if ($product && $product->images()->count() > 0)
                            @foreach ($product->images as $image)
                                <input type="hidden" name="deleted_images[]" value="{{ $image->id }}">
                            @endforeach
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function removeImage(imageId) {
            if (confirm('Are you sure you want to remove this image?')) {
                // Find the image container element with the given imageId
                var imageContainer = document.querySelector('div[data-image-id="' + imageId + '"]');
                if (imageContainer) {
                    // Remove the image container element
                    imageContainer.remove();
                }
            }
        }
    </script>
@endsection
