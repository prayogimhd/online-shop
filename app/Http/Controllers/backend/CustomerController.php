<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            $data = User::whereNot('name','admin')->orderBy('created_at','desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('email_verified_at', function ($data) {
                if($data->email_verified_at == null)
                {
                    $verified = '<span class="badge badge-danger"> Not yet </span>';
                } else {
                    $verified = '<span class="badge badge-primary"> Verified </span>';

                }
                return $verified;
            })
            ->editColumn('created_at', function ($user){
                return date('d/m/y H:i', strtotime($user->created_at) );
            })
            ->rawColumns(['email_verified_at'])
            ->toJson();
        }

        return view('backend.customer.index');
    }
}
