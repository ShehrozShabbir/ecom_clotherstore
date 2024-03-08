<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()  {
        $pendingOrders=Order::where('order_status','pending')->count();
        $dispatchedOrders=Order::where('order_status','dispatched')->count();
        $deliveredOrders=Order::where('order_status','delivered')->count();
        $returnedOrders=Order::where('order_status','returned')->count();
        $rejectedOrders=Order::where('order_status','rejected')->count();
        $deliveryFailedOrders=Order::where('order_status','delivery_failed')->count();

        $ordersCount=['pendingOrders'=>$pendingOrders,'dispatchedOrders'=>$dispatchedOrders,'deliveredOrders'=>$deliveredOrders,'returnedOrders'=>$returnedOrders,'rejectedOrders'=>$rejectedOrders,'deliveryFailedOrders'=>$deliveryFailedOrders];

        return view('admin.dashboard',compact('ordersCount'));
    }
}
