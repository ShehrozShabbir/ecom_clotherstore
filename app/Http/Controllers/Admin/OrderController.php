<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DispatchedOrder;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10);
        return view('admin.orders.manage', compact('orders'));
    }
    public function orderStatus($status)
    {
        $orders = Order::where('order_status',$status)->paginate(10);
        $status = Str::replace('_', ' ', $status); 
        return view('admin.orders.status', compact('orders','status'));
    }
     public function viewOrderDetails($id)
    {
        $order = Order::findOrFail(base64_decode($id));
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        return view('admin.orders.order_details', compact('order', 'orderItems'));
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
                "order_status" => $orderStatus,
                "order_id" => $order->id,
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
            "msg" => "Payment Status Updated successfully",
            "sts" => "success",
        ];
        return response()->json($response);
    }

    // Add more methods for other actions like adding, deleting orders


    public function dispatchOrderList(){
        $orders=DispatchedOrder::with('order')->paginate(10);
        // return $orders;
        return view('admin.orders.dispatched.list',compact('orders'));
    }
    public function dispatchOrder($id){
        $id = base64_decode($id);
        // get order data and show in dispatched order
        $order = Order::find($id);
        // check if order is alredy created 
        $existOrder = DispatchedOrder::where('order_id',$id)->first();

        if ($existOrder) {
            // Order already exists, redirect to the edit page
            return redirect()->route('admin.orders.dispatch.edit', ['id' => base64_encode($existOrder->id)]);
        } else {
            // Order does not exist, proceed to create page
            $mode = 'create';
            return view("admin.orders.dispatched.create", compact('mode', 'order'));
        }
    }
    public function dispatchOrderStore(Request $request){
        // return $request;
        // Validate the incoming request data
        $validatedData = $request->validate([
            'order_id' => 'required',
            'designation' => 'required',
            'payment_type' => 'required',
            'weight' => 'required|numeric',
            'remarks' => 'nullable',
            'shipper' => 'required',
            'shipper_address' => 'required',
            'date' => 'required|date',
        ]);

        // Prepare the data for insertion
        $data = [
            'order_id' => $validatedData['order_id'],
            'payment_type' => $validatedData['payment_type'],
           
            'designation' => $validatedData['designation'],
            'weight' => $validatedData['weight'],
            'remarks' => $validatedData['remarks'],
            'shipper' => $validatedData['shipper'],
            'shipper_address' => $validatedData['shipper_address'],
            'date' => $validatedData['date'],
        ];

        // Use the create method to insert the data
        $dispatchedOrder=DispatchedOrder::create($data);

        // return $dispatchedOrder;
        // Redirect back or wherever needed
        return redirect()->route('admin.orders.dispatch.index');
    }

    public function dispatchOrderEdit($id){
        $id = base64_decode($id);
        $order = DispatchedOrder::with('order')->find($id);
    
        if ($order) {
            // Order exists, proceed to edit page
            $mode = 'edit';
            return view('admin.orders.dispatched.create', compact('order', 'mode'));
        } else {
            // Order does not exist, redirect to create page
            return redirect()->route('admin.orders.dispatch.create', ['id' => base64_encode($id)]);
        }
    }
    public function dispatchOrderUpdate(Request $request, $id)
    {
        $id=base64_decode($id);
        // Validate the incoming request data
        $validatedData = $request->validate([
            'order_id' => 'required',
            'designation' => 'required',
            'payment_type' => 'required',
            'weight' => 'required|numeric',
            'remarks' => 'nullable',
            'shipper' => 'required',
            'shipper_address' => 'required',
            'date' => 'required|date',
        ]);
    
        // Find the dispatched order by its ID
        $dispatchedOrder = DispatchedOrder::findOrFail($id);
    
        // Update the dispatched order with the validated data
        $dispatchedOrder->update($validatedData);

        return redirect()->route('admin.orders.dispatch.index');

        
    }
    public function dispatchOrderDestroy($id)
    {
        $id=base64_decode($id);
        // Find the dispatched order by ID
        $dispatchedOrder = DispatchedOrder::findOrFail($id);

        // Delete the dispatched order
        $dispatchedOrder->delete();
        return redirect()->back();
    }
    
public function userOrders(Request $request)
{
    // Retrieve the currently authenticated user
    $user = auth()->user();
    
    // Retrieve orders associated with the authenticated user based on status
    $status = $request->query('status');
    if ($status) {
        $orders = $user->orders()->where('order_status', $status)->with('orderItems')->paginate(10);
    } else {
        $orders = $user->orders()->with('orderItems')->paginate(10);
    }
    
    // Pass the orders to the view along with the status
    return view('frontend.user_orders', compact('orders', 'status'));
}


public function viewDetails($id)
{
    // Retrieve the order details using the provided ID
    $order = Order::findOrFail($id);
    
    // Pass the order details to the view
    return view('frontend.order_details', compact('order'));
}

}
