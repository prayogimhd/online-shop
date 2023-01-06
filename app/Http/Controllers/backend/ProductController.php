<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function product(Request $request)
    {
        if ($request->ajax()) {
            $data = Products::with(['categories'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('categories_id', function ($data) {
                    return '<span class="badge badge-info"> ' . $data->categories->name . ' <span>';
                })
                ->editColumn('thumbnails', function ($data) {
                    return '<img src="../backend/products/' . "$data->thumbnails" . '"  width="120px" class="img-thumbnail">';
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="productAction"  data-product="' . $row->id . '" class="btn btn-primary btn-lg"> Edit </a>
                    <a href="javascript:void(0)" id="deleteProduct"  data-product="' . $row->id . '" class="btn btn-danger btn-lg"> Delete </a>';
                    return $btn;
                })
                ->rawColumns(['action', 'thumbnails', 'categories_id'])
                ->toJson();
        }

        return view('backend.product.product');
    }

    public function formProduct(Request $request)
    {
        $id             = $request->product_id;
        $product        = Products::find($id);
        $categories     = Categories::all();
        $data           = [
            'data'          => $product,
            'categories'    => $categories,
        ];

        $view = view('backend.product.formproduct', $data)->render();
        $response = [
            'success' => $view
        ];
        return response()->json($response);
    }

    public function actionProduct(Request $request)
    {
        $id             = $request->product_id;

        if ($id) {
            $request->validate([
                'product_name'          => 'required|min:3',
                'product_descriptions'  => 'required|min:5',
                'price'                 => 'required|integer',
                'weight'                => 'required|min:3',
                'thumbnails'            => 'image|mimes:png,jpg',
            ]);
            try {
                $product = Products::find($id);
                $fileName = $product->thumbnails;

                if ($request->thumbnails) {
                    $fileName = str_replace(' ', '_', $request->product_name) . '_' . time() . '.' . $request->file('thumbnails')->extension();
                    unlink('backend/products/' . $product->thumbnails);
                    $request->thumbnails->move(public_path('backend/products'), $fileName);
                }
                $product->product_name          = $request->product_name;
                $product->slug                  = Str::slug($request->product_name);
                $product->product_descriptions  = $request->product_descriptions;
                $product->categories_id         = $request->categories_id;
                $product->price                 = $request->price;
                $product->weight                = $request->weight;
                $product->thumbnails            = $fileName;
                $product->save();

                $response = [
                    'status'    => 200,
                    'message'   => 'Products successfully updated'
                ];
            } catch (\Exception $e) {
                $response = [
                    'status'    => 500,
                    'message'   => $e->getMessage()
                ];
            }
        } else {
            $request->validate([
                'product_name'          => 'required|min:3',
                'product_descriptions'  => 'required|min:5',
                'price'                 => 'required|integer',
                'weight'                => 'required|min:3',
                'thumbnails'            => 'required|image|mimes:png,jpg',
            ]);
            try {
                $product = new Products;
                $fileName = str_replace(' ', '_', $request->product_name) . '_' . time() . '.' . $request->file('thumbnails')->extension();
                $request->thumbnails->move(public_path('backend/products'), $fileName);

                $product->product_name          = $request->product_name;
                $product->slug                  = Str::slug($request->product_name);
                $product->product_descriptions  = $request->product_descriptions;
                $product->categories_id         = $request->categories_id;
                $product->price                 = $request->price;
                $product->weight                = $request->weight;
                $product->thumbnails            = $fileName;
                $product->save();

                $response = [
                    'status'    => 200,
                    'message'   => 'Products successfully added'
                ];
            } catch (\Exception $e) {
                $response = [
                    'status'    => 500,
                    'message'   => $e->getMessage()
                ];
            }
        }

        return response()->json($response);
    }

    public function deleteProduct($id)
    {
        try {
            $product = Products::find($id);
            unlink('backend/products/' . $product->thumbnails);
            $product->delete();
            $response = [
                'status'    => 200,
                'message'   => 'Categories successfully deleted!'
            ];
        } catch (\Exception $e) {
            $response = [
                'status'    => 500,
                'message'   => $e->getMessage()
            ];
        }
        return response()->json($response);
    }


    public function categories(Request $request)
    {
        if ($request->ajax()) {
            $data = Categories::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="categoriesAction"  data-categories="' . $row->id . '" class="btn btn-primary btn-lg"> Edit </a>
                    <a href="javascript:void(0)" id="deleteCategories"  data-categories="' . $row->id . '" class="btn btn-danger btn-lg"> Delete </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('backend.product.categories');
    }

    public function formCategories(Request $request)
    {
        $id             = $request->categories_id;
        $categories     = Categories::find($id);
        $data           = [
            'data'    => $categories,
        ];

        $view = view('backend.product.formcategories', $data)->render();
        $response = [
            'success' => $view
        ];
        return response()->json($response);
    }

    public function actionCategories(Request $request)
    {
        $id             = $request->categories_id;
        $request->validate(
            [
                'name'          => 'required',
            ]
        );
        if ($id) {
            try {
                $categories = Categories::find($id);
                $categories->name = $request->name;
                $categories->slug = Str::slug($request->name);
                $categories->save();

                $response = [
                    'status'    => 200,
                    'message'   => 'Categories successfully updated'
                ];
            } catch (\Exception $e) {
                $response = [
                    'status'    => 500,
                    'message'   => $e->getMessage()
                ];
            }
        } else {
            try {
                $categories = new Categories;
                $categories->name = $request->name;
                $categories->slug = Str::slug($request->name);
                $categories->save();

                $response = [
                    'status'    => 200,
                    'message'   => 'Categories successfully added'
                ];
            } catch (\Exception $e) {
                $response = [
                    'status'    => 500,
                    'message'   => $e->getMessage()
                ];
            }
        }

        return response()->json($response);
    }

    public function deleteCategories($id)
    {
        try {
            Categories::find($id)->delete();
            $response = [
                'status'    => 200,
                'message'   => 'Product successfully deleted!'
            ];
        } catch (\Exception $e) {
            $response = [
                'status'    => 500,
                'message'   => $e->getMessage()
            ];
        }
        return response()->json($response);
    }
}
