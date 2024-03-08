@extends('layouts.admin')
@section('title', 'Order List')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Order List</h2>
            </div>
            <div class="card-body">
                @if ($orders && count($orders) > 0)
                <table class="table table-striped table-responsive" id="view_orders_tb">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Order Date</th>
                        <th>Weight (kg)</th>
                        <th>Customer Name</th>
                        <th>Contact Number</th>
                        <th>Contact Address</th>
                        <th>Designation</th>
                        <th>Shipper</th>
                        <th>Shipper Address</th>
                        <th>Remarks</th>
                        <th>Payment Type</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                  <tbody>
                      @foreach ($orders as $order)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $order->date }}</td>
                          <td>{{ $order->weight }}</td>
                          <td>{{ $order->designation }}</td>
                          <td>{{ $order->order->customer_name }}</td>
                          <td>{{ $order->order->contact_number }}</td>
                          <td>{{ $order->order->customer_address }}</td>
                          <td>{{ $order->shipper }}</td>
                          <td>{{ $order->shipper_address }}</td>
                          <td>{{ $order->remarks }}</td>
                          <td>{{ $order->payment_type }}</td>
                          <td>{{ $order->date }}</td>
                          <td>
                            <a type="button" style="cursor: pointer" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-primary"
                                    href="{{ route('admin.orders.view_details', ['id' => base64_encode($order->id)]) }}">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a class="dropdown-item text-info"
                                    href="{{ route('admin.orders.dispatch.edit', ['id' => base64_encode($order->id)]) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.orders.dispatch.destroy', ['id' => base64_encode($order->id)]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this order?')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                        
                        
                      </tr>
                      @endforeach
                  </tbody>
              </table>
              
                {!! $orders->links('pagination::bootstrap-4') !!}
                @else
                <p>No orders found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

