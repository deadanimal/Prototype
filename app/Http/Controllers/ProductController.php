<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show_products(Request $request) {
        $products = Product::all();
        return view('product_list', compact('products'));
    }

    public function show_product(Request $request) {
        $id = (int) $request->route('product_id');  
        $product = Product::find($id);

        return view('product_detail', compact('product'));
    } 
    
    public function create_product(Request $request) {

        return back();
    }

}
