<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(
            Product::all()
        );
    }


    public function searchProductName(Request $request)
    {
        $query = $request->input('query');
        return response()->json(
            Product::query()
                ->where('productName', 'like', '%' . $query . '%')
                ->get()
        );
    }
}
