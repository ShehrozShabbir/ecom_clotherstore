<!-- resources/views/admin/orders/order_details.blade.php -->

@extends('layouts.admin')

@section('title', 'Order Detail')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Order Detail</h2>
                </div>
                <div class="card-body">
                    <h3>Order Information</h3>
                    <!-- Display order details here -->
                    <p>customer Name: {{ $order->customer_name }}</p>
                    <p>Order ID: {{ $order->id }}</p>
                    <p>Order Date: {{ $order->order_date }}</p>
                    <!-- Display other order details as needed -->

                    <h3>Order Items</h3>
                    @if ($orderItems && count($orderItems) > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <!-- Add more columns as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $orderItem)
                                    <tr>
                                        <td>{{$loop->iteration }}</td>
                                        <td>
                                            @if ($orderItem->product)
                                                {{ $orderItem->product->name }}
                                            @endif
                                        </td>
                                        <td>{{ $orderItem->size }}</td>
                                        <td>{{ $orderItem->quantity }}</td>
                                        <td>{{ $orderItem->price }}</td>
                                        <td>{{ $orderItem->discount }}</td>
                                        <td>{{ $orderItem->total }}</td>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No order items found for this order.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
