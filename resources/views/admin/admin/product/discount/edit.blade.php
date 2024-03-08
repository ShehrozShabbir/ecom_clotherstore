@extends('layouts.admin')

@section('title', 'Edit Discount')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Edit Discount</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.discounts.update', $product->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Discount Title</label>
                                    <select id="title" class="form-control" name="title" required>
                                        <option value="" selected disabled>Select Discount Title</option>
                                        @foreach($discountTitles as $discountTitle)
                                            <option value="{{ $discountTitle->title }}" {{ ($discount && $discount->title == $discountTitle->title) ? 'selected' : '' }}>
                                                {{ $discountTitle->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="percentage">Percentage (%)</label>
                                    <input type="number" class="form-control" name="percentage" placeholder="Discount Percentage" value="{{ $discount ? $discount->percentage : old('percentage') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" placeholder="Start Date" value="{{ $discount ? $discount->start_date : old('start_date') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" class="form-control" name="end_date" placeholder="End Date" value="{{ $discount ? $discount->end_date : old('end_date') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="1" {{ ($product->discounts->first() && $product->discounts->first()->status) ? 'selected' : '' }}>On</option>
                                        <option value="0" {{ ($product->discounts->first() && !$product->discounts->first()->status) ? 'selected' : '' }}>Off</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Discount</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
