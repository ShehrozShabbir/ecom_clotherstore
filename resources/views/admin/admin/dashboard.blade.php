@extends('layouts.admin') @section('title',"Dashboard") @section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Hello, {{auth()->user()->name}}. Welcome to Dashboard!</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    @foreach ($ordersCount as $key => $value)
                    <div class="col-12 col-md-6 col-lg-3">
                        <div
                            class="card shadow {{ $key === 'pendingOrders' ? 'card-info' : ($key === 'dispatchedOrders' ? 'card-success' : ($key === 'deliveredOrders' ? 'card-success' : ($key === 'rejectedOrders' ? 'card-danger' : ($key === 'returnedOrders' ? 'card-warning' : 'card-danger')))) }}">
                            <div class="card-header">
                                <h4>{{ ucfirst(str_replace('Orders', '', $key)) }}</h4>
                            </div>
                            <div class="card-body">
                                <div>
                                    <span
                                        class="badge {{ $key === 'pendingOrders' ? 'badge-info' : ($key === 'dispatchedOrders' ? 'badge-primary' : ($key === 'deliveredOrders' ? 'badge-primary' : ($key === 'rejectedOrders' ? 'badge-danger' : ($key === 'returnedOrders' ? 'badge-warning' : 'badge-danger')))) }} px-3">
                                        <p class="mb-0 h5">{{ $value }}</p>
                                    </span>
                                    <p class="mt-2">
                                        @if($value > 0)
                                        @if($key === 'pendingOrders')
                                        <span class="text-info">Pending</span>
                                        @elseif($key === 'dispatchedOrders')
                                        <span class="text-primary">Dispatched</span>
                                        @elseif($key === 'deliveredOrders')
                                        <span class="text-primary">Delivered</span>
                                        @elseif($key === 'rejectedOrders')
                                        <span class="text-danger">Rejected</span>
                                        @elseif($key === 'returnedOrders')
                                        <span class="text-warning">Returned</span>
                                        @elseif($key === 'deliveryFailedOrders')
                                        <span class="text-danger">Delivery Failed</span>
                                        @endif
                                        @else
                                        <span>No orders</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach



                    <div></div>
                </div>
            </div>
        </div>
        {{-- end of card --}}
    </div>
</div>

@endsection