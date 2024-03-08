<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "customer_name" => 'required',
            "contact_number" => 'required',
            "customer_address_1" => 'required',
            "order_notes" => 'required',
        ]);

        if ($validator->fails()) {
            $response = ['message' => 'Some field are missing to place order', 'status' => 'error'];
        } else {
            if (session('cart')) {
                $order = Order::create([
                    'order_date'=>date('Y-m-d'),
                    "customer_name" => $request->customer_name,
                    "contact_number" => $request->contact_number,
                    "customer_address" => $request->customer_address_1 . " " . $request->customer_address_2,
                    "order_notes" => $request->order_notes,
                    "payment_type" => 'cod',
                    "payment_status" => 'pending',
                    "order_status" => 'pending',
                    "user_id" => (auth()->check())?auth()->id():0, // Assign the user ID to the user_id field
                ]);


               
            foreach (session('cart') as $id => $details) {
                $product = Product::find($details['id']);
                if ($product) {
                    $metaData = json_decode($product->product_meta, true);
                    if ($metaData[$details['size']]) {
                        $metaData[$details['size']]['stock_quantity'] = (int)$metaData[$details['size']]['stock_quantity'] - (int)$details['quantity'];
                        $product->update(['product_meta' => json_encode($metaData)]);
                        OrderItem::create([
                            'user_id' =>  (auth()->check())?auth()->id():0,
                            "order_id" => $order->id,
                            "product_id" => $details['id'],
                            "quantity" => $details['quantity'],
                            "size" => $details['size'],
                            "price" => $details['price'],
                            "discount" => 0,
                            "total" => $details['quantity'] * $details['price'],
                        ]);
                    }
                }
            }

                $response = ['message' => 'Order Has been created Your Order Id is SP#00'.$order->id, 'status' => 'success'];
                session()->forget('cart');
            } else {
                $response = ['message' => 'There is not Order in Cart', 'status' => 'error'];

            }


        }
        return response()->json($response);
    }
    public function addBooktoCart(Request $request)
    {
        $product = Product::findOrFail($request->code);
        $cart = session()->get('cart', []);
        $metaData=json_decode($product->product_meta,true);
        if($metaData[$request->size]){
            if($metaData[$request->size]['stock_quantity']>=$request->quantity){
                $itemKey = $request->code . '_' . $request->size;
                if (isset($cart[$itemKey])) {
                    $cart[$itemKey]['quantity']++;
                } else {

                    $cart[$itemKey] = [
                        "name" => $product->name,
                        "id" => $product->id,
                        "size" => $request->size,
                        "quantity" => 1,
                        "price" => $metaData[$request->size]['selling_price'],
                        "image" => $product->images[0]->image_path,
                    ];
                }
                session()->put('cart', $cart);
                $response=["message"=>"Product is Added to Cart Successfully !",'status'=>'success'];
            }else{
                $response=["message"=>"Product is out of stock for this size !",'status'=>'warning'];
            }


        }else{
            $response=["message"=>"Current Size is not available..!",'status'=>'error'];
        }

        return response()->json($response);
    }

    public function updateCart(Request $request)
    {

        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return 'Cart is Updated Successfully !';
        }
    }

    public function deleteProduct(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            return 'Product successfully deleted';
        }
    }
    public function clearCart()
    {

         session()->forget('cart');
        flashy()->success('Cart has been clear successfully');
            return redirect()->back();

    }
}
