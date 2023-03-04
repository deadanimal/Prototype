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
        $user = $request->user();
        if ($user->email != 'afeezaziz@pipeline.com.my') {
            return redirect('/');
        }        
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'prototype_link' => $request->prototype_link,
            'web_link' => $request->web_link,
            'app_repo' => $request->app_repo,
            'web_repo' => $request->web_repo,
        ]);
        return back();
    }

    public function update_product(Request $request) {
        $id = (int) $request->route('product_id');  
        $product = Product::find($id);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'prototype_link' => $request->prototype_link,
            'web_link' => $request->web_link,
            'app_repo' => $request->app_repo,
            'web_repo' => $request->web_repo,
        ]);        

        return back();
    }     

}
