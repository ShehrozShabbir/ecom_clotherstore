@extends('layouts.admin')
@section('title', 'Order Dispatcher')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">{{ $mode === 'edit' ? 'Edit Disptached Order' : 'Create Disptached Order' }}</h2>

            </div>
            <div class="card-body">

                <form
                    action="{{ $mode === 'edit' ? route('admin.orders.dispatch.update', ['id' => base64_encode($order->id)]) : route('admin.orders.dispatch.store') }}"
                    method="POST">
                    @csrf
                    @if ($mode === 'edit')
                    @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="order_id">Order ID:</label>
                                <input type="text" class="form-control" id="order_id" name="order_id"
                                    value="{{ $mode === 'edit' ? $order->order_id : $order->id }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payment_type">Payment Method:</label>
                                <input type="text" class="form-control" id="payment_type" name="payment_type"
                                    value="{{ $mode === 'edit' ? $order->payment_type : ($order->payment_type=='cod' ? 'Cash on Delivery' : $order->payment_type) }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_name">Customer Name:</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    value="{{ $mode === 'edit' ? $order->order->customer_name :  $order->customer_name}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $mode === 'edit' ? $order->order->customer_address :  $order->customer_address}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="designation">Designation:</label>
                                <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter City Name"
                                    value="{{ $mode === 'edit' ? $order->designation : '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="weight">Weight:</label>
                                <input type="number" class="form-control" id="weight" name="weight" placeholder="Kg weight Please enter a valid like 0.5" 
                                value="{{ $mode === 'edit' ? $order->weight : '' }}">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_phone">Customer Phone:</label>
                                <input type="text" class="form-control" id="customer_phone" name="customer_phone"
                                    value="{{ $mode === 'edit' ? $order->order->contact_number :  $order->contact_number}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="remarks">Remarks:</label>
                                <textarea class="form-control" id="remarks" name="remarks"
                                    rows="3">{{ $mode === 'edit' ? $order->remarks : 'Kindly Call the and just Deliver the Packet' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shipper">Shipper:</label>
                                <input type="text" class="form-control" id="shipper" name="shipper"
                                    value="{{ $mode === 'edit' ? $order->shipper : '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shipper_address">Shipper Address:</label>
                                <input type="text" class="form-control" id="shipper_address" name="shipper_address"
                                    value="{{ $mode === 'edit' ? $order->shipper_address : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" class="form-control" id="date" name="date"
                                    value="{{ $mode === 'edit' ? $order->date : \Carbon\Carbon::now()->toDateString() }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $mode === 'edit' ? 'Update Order' : 'Create Order'
                        }}</button>
                </form>



            </div>
        </div>
    </div>
</div>
@endsection