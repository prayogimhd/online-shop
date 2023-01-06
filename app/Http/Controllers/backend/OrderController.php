<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::orderBy('created_at','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('transaction_status', function ($data) {
                    if ($data->transaction_status == 'settlement') {
                        $status = '<span class="badge badge-success"> Settlement </span>';
                    } elseif ($data->transaction_status == 'pending') {
                        $status = '<span class="badge badge-secondary"> Pending </span>';
                    } else {
                        $status = '<span class="badge badge-danger"> Failure </span>';
                    }
                    return $status;
                })
                ->editColumn('order_status', function ($data) {
                    if ($data->order_status == 'A') {
                        $status = '<span class="badge badge-success"> Accepted </span>';
                    } elseif ($data->order_status == 'O') {
                        $status = '<span class="badge badge-info"> On The Way </span>';
                    } elseif ($data->order_status == 'P') {
                        $status = '<span class="badge badge-secondary"> Process </span>';
                    } else {
                        $status = '<span class="badge badge-danger"> Cancel </span>';
                    }
                    return $status;
                })
                ->editColumn('total', function ($data){
                    return rupiah($data->total);
                })
                ->editColumn('created_at', function ($data){
                    return date('d/m/y H:i', strtotime($data->created_at) );
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="orderAction"  data-order="' .$row->id. '" class="btn btn-primary btn-lg btn-block btn-icon-split"> Detail </a>';
                    return $btn;
                })

                ->rawColumns(['action', 'transaction_status', 'order_status'])
                ->toJson();
        }

        return view('backend.order.index');
    }

    public function formOrder(Request $request)
    {
        $id            = $request->order_id;
        $order         = Order::find($id);
        $detail        = OrderDetail::with(['products', 'order'])->where('order_id', $id)->get();

        $data          = [
            'data'    => $order,
            'detail'  => $detail,
        ];

        $view = view('backend.order.formorder', $data)->render();
        $response = [
            'success' => $view
        ];
        return response()->json($response);
    }

    public function orderStore(Request $request)
    {
        $id = $request->order_id;
        $order = Order::find($id);
        try {
            $order->order_status = $request->order_status;
            $order->save();
            $response = [
                'status' => 200,
                'message'=> 'Status update successfully!'
            ];
        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                'message'=> $e->getMessage()
            ];
        }
        return response()->json($response);
    }
}
