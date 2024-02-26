<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10);
        return view('admin.orders.manage', compact('orders'));
    }
    public function view($id)
    {
        $orders = Order::find(base64_decode($id));
        return view('admin.orders.manage', compact('orders'));
    }

    public function status(Request $request)
    {
        if ($request->id != '') {
            if ($request->changeOrderStatus == 'pending') {
                $orderStatus = ['order_status' => 'pending'];
            } elseif ($request->changeOrderStatus == 'dispatched') {
                $orderStatus = ['order_status' => 'dispatched'];
            } elseif ($request->changeOrderStatus == 'delivered') {
                $orderStatus = ['order_status' => 'delivered'];
            } elseif ($request->changeOrderStatus == 'rejected') {
                $orderStatus = ['order_status' => 'rejected'];
            } elseif ($request->changeOrderStatus == 'returned') {
                $orderStatus = ['order_status' => 'returned'];
            } elseif ($request->changeOrderStatus == 'delivery_failed') {
                $orderStatus = ['order_status' => 'delivery_failed'];
            }
            $order = Order::find(base64_decode($request->id));
            $order->update($orderStatus);
            $response = [
                "msg" => "Order Status  Updated successfully",
                "sts" => "success",
            ];
        }
        return response()->json($response);

    }

    public function payment(Request $request)
    {
        $orderStatus = ['payment_status' => $request->changePaymenttatus];
        $order = Order::find(base64_decode($request->id));
        $order->update($orderStatus);
        $response = [
            "msg" => "Payment Status  Updated successfully",
            "sts" => "success",
        ];
        return response()->json($response);
    }

    // Add more methods for other actions like adding, deleting orders
}
