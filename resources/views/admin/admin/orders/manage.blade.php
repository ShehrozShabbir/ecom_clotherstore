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
                <table class="table table-striped text-center" id="view_orders_tb">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Date</th>
                            <th>Customer Name</th>
                            <th>Contact Number</th>
                            <th>Contact Address</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->contact_number }}</td>
                            <td>{{ $order->customer_address }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>
                              @php
                              $badgeColor = '';
                              switch ($order->order_status) {
                              case 'pending':
                              $badgeColor = 'badge-primary border-primary';
                              break;
                              case 'dispatched':
                              $badgeColor = 'badge-success border-success text-dark';
                              break;
                              case 'delivered':
                              $badgeColor = 'badge-secondary border-secondary';
                              break;
                              case 'rejected':
                              $badgeColor = 'badge-danger border-danger';
                              break;
                              case 'returned':
                              $badgeColor = 'badge-info border-info';
                              break;
                              case 'delivery_failed':
                              $badgeColor = 'badge-danger border-danger';
                              break;
                              default:
                              $badgeColor = 'badge-primary border-primary';
                              break;
                              }
                              @endphp
              
                              <span class="badge border {{ $badgeColor }}">{{ Str::ucfirst($order->order_status) }}</span>
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
                                        class="dropdown-item text-danger"
                                        href="{{ route('admin.orders.view_details', ['id' => base64_encode($order->id)]) }}"
                                        >View</a
                                    >
                                    <a
                                        onclick="changeOrderStatus(`{{base64_encode($order->id)}}`,`{{$order->order_status}}`)"
                                        class="dropdown-item text-success"
                                        href="javascript:void(0)"
                                        >Change Status</a
                                    >
                                    <a
                                        onclick="changePaymenttatus(`{{base64_encode($order->payment_status)}}`)"
                                        class="dropdown-item text-warning"
                                        href="javascript:void(0)"
                                        >Payment</a
                                    >

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

@push('js')
<script type="text/javascript">
    function changeOrderStatus(id,status) {
      // body...

      (async () => {
      const { value: fruit } = await Swal.fire({
        title: "Select Order Status",
        input: "select",
        inputOptions: {
          pending: "Pending",
          dispatched: "Dispatched",
          delivered: "Delivered",
         rejected: "Rejected",
        returned: "Returned",
         delivery_failed: "Delivery Failed",
        },
        inputPlaceholder: "Select to change the order Status",
        showCancelButton: true,
        inputValidator: (value) => {
          return new Promise((resolve) => {
            if (value !==status) {

              $.ajax({
                type: 'POST',
                url: '{{route("admin.orders.status")}}',
                data: {changeOrderStatus:value,id:id},
                dataType:"json",
                headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                 },
                success:function (response) {
                  $("#view_orders_tb").load(location.href+" #view_orders_tb");
                  if(response.order_status.order_status=='dispatched'){
                      window.open("{{ route('admin.orders.dispatch.create') }}/" + id, "_blank");
                    }
                   resolve();
                    Swal.fire(response.msg);

                }
            });//ajax call }
            } else {
              resolve("Current order status is "+status);
            }
          });
        }
      });

    })()
    }
    function changePaymenttatus(id,status) {
      // body...

      (async () => {
      const { value: fruit } = await Swal.fire({
        title: "Select Order Status",
        input: "select",
        inputOptions: {
          0: "Pending",
          1: "Completed",
        },
        inputPlaceholder: "Select to change the order Status",
        showCancelButton: true,
        inputValidator: (value) => {
          return new Promise((resolve) => {
            if (value !==status) {

              $.ajax({
                type: 'POST',
                url: '{{route("admin.orders.payment")}}',
                data: {changePaymenttatus:value,id:id},
                dataType:"json",
                headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                 },
                success:function (response) {
                  $("#view_orders_tb").load(location.href+" #view_orders_tb");
                   resolve();
                    Swal.fire(response.msg);


                }
            });//ajax call }
            } else {
              resolve("Current order status is "+status);
            }
          });
        }
      });

    })()
    }
    </script>
@endpush
