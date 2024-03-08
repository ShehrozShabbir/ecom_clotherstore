@extends('layouts.admin') @section('title', 'Edit Order') @section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Edit Order</h2>
            </div>
            <div class="card-body">
                <!-- Form for editing the order -->
                <form
                    action="{{ route('admin.orders.update', ['id' => $order->id]) }}"
                    method="POST"
                >
                    <!-- CSRF Token -->
                    @csrf
                    <!-- Method Spoofing for PUT request -->
                    @method('PUT')

                    <div class="row">
                        <!-- First Column -->
                        <div class="col-md-6">
                            <!-- Customer Name -->
                            <div class="form-group">
                                <label for="customer_name"
                                    >Customer Name:</label
                                >
                                <input
                                    type="text"
                                    name="customer_name"
                                    id="customer_name"
                                    class="form-control"
                                    value="{{ $order->customer_name }}"
                                />
                            </div>
                            <!-- Customer Address -->
                            <div class="form-group">
                                <label for="customer_address"
                                    >Customer Address:</label
                                >
                                <input
                                    type="text"
                                    name="customer_address"
                                    id="customer_address"
                                    class="form-control"
                                    value="{{ $order->customer_address }}"
                                />
                            </div>
                            <!-- Contact Number -->
                            <div class="form-group">
                                <label for="contact_number"
                                    >Contact Number:</label
                                >
                                <input
                                    type="text"
                                    name="contact_number"
                                    id="contact_number"
                                    class="form-control"
                                    pattern="[0-9]+"
                                    title="Please enter numbers only"
                                    value="{{ $order->contact_number }}"
                                />
                            </div>
                        </div>
                        <!-- Second Column -->
                        <div class="col-md-6">
                            <!-- Payment Method -->
                            <div class="form-group">
                                <label for="payment_type"
                                    >Payment Method:</label
                                >
                                <select
                                    name="payment_type"
                                    id="payment_type"
                                    class="form-control"
                                >
                                    <option value="COD" {{ $order->
                                        payment_type == 'COD' ? 'selected' : ''
                                        }}>Cash on Delivery (COD)
                                    </option>
                                    <option value="Bank" {{ $order->
                                        payment_type == 'Bank' ? 'selected' : ''
                                        }}>Bank Transfer
                                    </option>
                                    <!-- Add more payment methods as needed -->
                                </select>
                            </div>
                            <!-- Payment Status -->
                            <div class="form-group">
                                <label for="payment_status"
                                    >Payment Status:</label
                                >
                                <select
                                    name="payment_status"
                                    id="payment_status"
                                    class="form-control"
                                >
                                    <option value="Pending" {{ $order->
                                        payment_status == 'Pending' ? 'selected'
                                        : '' }}>Pending
                                    </option>
                                    <option value="Paid" {{ $order->
                                        payment_status == 'Paid' ? 'selected' :
                                        '' }}>Paid
                                    </option>
                                </select>
                            </div>
                            <!-- Order Status -->
                            <div class="form-group">
                                <label for="order_status">Order Status:</label>
                                <select
                                    name="order_status"
                                    id="order_status"
                                    class="form-control"
                                >
                                    <option value="pending" {{ $order->
                                        order_status == 'Pending' ? 'selected' :
                                        '' }}>Pending
                                    </option>
                                    <option value="rejected" {{ $order->
                                        order_status == 'Rejected' ? 'selected'
                                        : '' }}>Rejected
                                    </option>
                                    <option value="processing" {{ $order->
                                        order_status == 'Processing' ?
                                        'selected' : '' }}>Processing
                                    </option>
                                    <option value="processed" {{ $order->
                                        order_status == 'Processed' ? 'selected'
                                        : '' }}>Processed
                                    </option>
                                    <option value="delivered" {{ $order->
                                        order_status == 'Delivered' ? 'selected'
                                        : '' }}>Delivered
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Order Notes -->
                    <div class="form-group">
                        <label for="order_notes">Order Notes:</label>
                        <textarea
                            name="order_notes"
                            id="order_notes"
                            class="form-control"
                            >{{ $order->order_notes }}</textarea
                        >
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">
                        Update Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
