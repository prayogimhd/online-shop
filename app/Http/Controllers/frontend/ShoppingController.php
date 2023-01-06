<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShoppingController extends Controller
{
    public function wishlist()
    {
        $id = Auth::user()->id;
        $wishlist = Wishlist::with(['products'])->where('user_id', $id)->get();
        return view('frontend.wishlist', compact('wishlist'));
    }

    public function store(Request $request)
    {
        $data = [
            'user_id'       => Auth::user()->id,
            'product_id'    => $request->product_id
        ];

        Wishlist::create($data);
        return back()->with('success', 'Successfully added to wishlist!');
    }

    public function delete($id)
    {
        Wishlist::find($id)->delete();
        return back()->with('success', 'Wishlist deleted successfully!');
    }

    public function carts()
    {
        $id = Auth::user()->id;
        $carts = Carts::with(['products'])->where('user_id', $id)->get();
        $total = [];
        foreach ($carts as $c) {
            $total[] = $c->products->price * $c->quantity;
        }
        $total = array_sum($total);
        return view('frontend.carts', compact('carts', 'total'));
    }

    public function carts_store(Request $request)
    {
        $user = Auth::user()->id;
        $data = Carts::where('user_id', $user)
            ->where('product_id', $request->product_id)
            ->first();
        if ($data) {
            $data->quantity = $data->quantity + $request->quantity;
            $data->update();
        } else {
            Carts::create([
                'user_id'   => $user,
                'product_id' => $request->product_id,
                'quantity'  => $request->quantity
            ]);
        }
        return back()->with('success', 'Product successfully added!');
    }

    public function carts_update(Request $request)
    {
        try {
            $i = 0;
            foreach ($request['carts_id'] as $cart_id) {
                $carts = Carts::find($cart_id);
                $carts->quantity = $request['carts_quantity'][$i];
                $carts->save();
                $i++;
            }
            return back()->with('success', 'Cart updated successfully!');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function delete_carts($id)
    {
        Carts::find($id)->delete();
        return back()->with('success', 'Product deleted successfully!');
    }
}
