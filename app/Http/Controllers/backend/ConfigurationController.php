<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfigurationController extends Controller
{
    public function index()
    {
        $configuration = Configuration::first();
        return view('backend.configuration.index', compact('configuration'));
    }

    public function formIcon(Request $request)
    {
        $id            = $request->configuration_id;
        $configuration = Configuration::find($id);

        $data          = [
            'data'  => $configuration,
        ];

        $view = view('backend.configuration.formicon', $data)->render();
        $response = [
            'success' => $view
        ];
        return response()->json($response);
    }

    public function formStore(Request $request)
    {
        $request->validate([
                'name'          => 'required',
                'description'   => 'required',
                'address'       => 'required',
                'email'         => 'required|email',
                'phone'         => 'required',
                'facebook'      => 'required',
                'instagram'     => 'required',
            ]
        );

        $id            = $request->configuration_id;
        $configuration = Configuration::find($id);
        try {
            $configuration->name        = $request->name;
            $configuration->description = $request->description;
            $configuration->address     = $request->address;
            $configuration->email       = $request->email;
            $configuration->phone       = $request->phone;
            $configuration->facebook    = $request->facebook;
            $configuration->instagram   = $request->instagram;
            $configuration->save();
            $response = [
                'status'    => 200,
                'message'   => 'Configuration updated successfully!'
            ];
        } catch (\Exception $e) {
            $response = [
                'status'    => 500,
                'message'   => $e->getMessage()
            ];
        }
        return response()->json($response);
    }

    public function iconStore(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'icon' => 'required|image|mimes:png,jpg'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => $validator->errors()->first(),
            ]);
        }

        $id            = $request->configuration_id;
        $icon          = $request->icon;
        $configuration = Configuration::find($id);
        try {
            unlink('backend/configuration/' . $configuration->icon);
            $getName             = $icon->getClientOriginalName();
            $configuration->icon = $getName;
            $configuration->save();
            $icon->move('backend/configuration/', $getName);
            $response = [
                'status'  => 200,
                'message' => 'Icon updated successfully!',
            ];
        } catch (\Exception $e) {
            $response = [
                'status'  => 500,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }
}
