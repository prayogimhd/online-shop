<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        $data = [
            'user_id'               => Auth::user()->id,
            'invoice'               => $request->invoice,
            'total'                 => $request->totals,
            'snap_token'            => $request->snap_token,
            'transaction_status'    => $request->transaction_status,
            'order_status'          => 'P',
            'first_name'            => $request->first_name,
            'last_name'             => $request->last_name,
            'state'                 => $request->state,
            'street'                => $request->street,
            'detailstreet'          => $request->detailstreet,
            'city'                  => $request->city,
            'postcode'              => $request->postcode,
            'phone'                 => $request->phone,
            'email'                 => $request->email,
        ];
        try {
            $order = Order::create($data);
            $cart = Carts::where('user_id', Auth::user()->id);
            foreach ($cart->get() as $c) {
                OrderDetail::create([
                    'order_id'   => $order->id,
                    'product_id' => $c->product_id,
                    'quantity'   => $c->quantity
                ]);
            }
            $cart->delete();
            $response = [
                'status'    => 200
            ];
        } catch (\Exception $e) {
            $response = [
                'status'    => 500,
                'message'   => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function payMidtrans(Request $request)
    {
        $this->Midtrans();

        $carts = Carts::with(['products'])->where('user_id', Auth::user()->id)->get();

        $items = [];
        foreach ($carts as $cart) {
            $items[] = [
                'id'       => $cart->products->product_name,
                'price'    => $cart->products->price,
                'quantity' => $cart->quantity,
                'name'     => $cart->products->product_name
            ];
        }

        $shipping_address = array(
            'first_name'   => $request->firstname,
            'last_name'    => $request->last_name,
            'address'      => $request->street,
            'city'         => $request->city,
            'phone'        => $request->phone,
        );

        $customer_details = array(
            'first_name'       => $request->firstname,
            'last_name'        => $request->last_name,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'shipping_address' => $shipping_address
        );

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->totals,
            ),
            'item_details'        => $items,
            'customer_details'    => $customer_details
        );

        $data = [
            'snapToken' => \Midtrans\Snap::getSnapToken($params)
        ];

        return response()->json($data);
    }

    public function order()
    {
        $data = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('frontend.orders', compact('data'));
    }

    public function orderDetail($id)
    {
        $data = OrderDetail::with(['products', 'order'])->where('order_id', $id)->get();
        return response()->json($data);
    }

    public function orderUpdate($id)
    {
        Order::where('id', $id)->update(['order_status' => 'A']);
        return back()->with('success', 'Order has been received');
    }

    public function orderCancel($id)
    {
        $data = Order::where('id', $id)->update([
            'transaction_status' => 'failure',
            'order_status' => 'C'
        ]);
        return response()->json($data);
    }

    public function pendingPay(Request $request)
    {
        $this->Midtrans();

        $order = Order::where('id', $request->order_id)->first();

        $status = \Midtrans\Transaction::status($order->invoice);

        if ($status->transaction_status == 'settlement') {
            $order->transaction_status = 'settlement';
            $order->save();
            $data = [
                'redirect'  => true
            ];
        } else {
            $data = [
                'snapToken' => $order->snap_token
            ];
        }

        return response()->json($data);
    }

    public function pendingUpdate(Request $request)
    {
        $id = $request->order_id;
        try {
            $data = Order::where('id', $id)->update([
                'transaction_status' => 'settlement',
            ]);
            $response = [
                'status'    => 200,
                'data'      => $data
            ];
        } catch (\Exception $e) {
            $response = [
                'status'    => 500,
                'message'   => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    function Midtrans()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }
}
