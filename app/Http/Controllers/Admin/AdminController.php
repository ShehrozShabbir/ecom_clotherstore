<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\User;

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
    public function profile()
    {
        return view('profile');
    }
    public function profileUpdate(REQUEST $request)
    {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:30',

            ]);
            if ($validator->fails()) {

                flashy()->error("Something went wrong", '#');
                return redirect()->back()->withErrors($validator->messages())->withInput();
            } else {

                User::find(auth()->id())->update([

                    'name' => $request->name,

                ]);
                flashy()->info("Profile Has been Updated", '#');
                return redirect()->back();

            }

        

    }
    
}
