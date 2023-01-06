<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data = Products::paginate(8);
        return view('frontend.home', compact('data'));
    }

    public function details($id)
    {
        $data = Products::where('id', $id)->first();
        return response()->json($data);
    }

    public function shop()
    {
        $data = Products::paginate(6);
        $categories = Categories::get();
        return view('frontend.shop', compact('data', 'categories'));
    }

    public function categories($slug)
    {
        $all_categories = Categories::all();
        $categories_id  = Categories::where('slug', $slug)->first();
        if ($categories_id) {
            $data = Products::where('categories_id', $categories_id->id)->paginate(6);
        }
        return view('frontend.categories', compact('data', 'all_categories', 'categories_id'));
    }
}
