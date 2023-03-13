<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductActor;
use App\Models\ProductMethod;
use App\Models\ProductTable;
use App\Models\ProductTableAttribute;
use App\Models\ProductUsecase;
use App\Models\ProductView;
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

    public function show_product_technicals(Request $request) {
        $id = (int) $request->route('product_id');  
        $product = Product::find($id);

        $actors = ProductActor::where([
            ['product_id', '=', $id]
        ])->orderBy('name')->get();
        $tables = ProductTable::where([
            ['product_id', '=', $id]
        ])->orderBy('name')->get();
        $attributes = ProductTableAttribute::where([
            ['product_id', '=', $id]
        ])->orderBy('product_table_id')->orderBy('name')->get();        
        $usecases = ProductUsecase::where([
            ['product_id', '=', $id]
        ])->orderBy('product_actor_id')->orderBy('name')->get();   
        $methods = ProductMethod::where([
            ['product_id', '=', $id]
        ])->orderBy('name')->get();           
        $views = ProductView::where([
            ['product_id', '=', $id]
        ])->orderBy('name')->get();              

        return view('product_technical', compact([
            'product', 'tables', 'actors', 'usecases', 'attributes', 
            'methods', 'views'
        ]));
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

    public function create_product_actor(Request $request) {
        $product_id = (int) $request->route('product_id');  
     
        ProductActor::create([
            'name' => $request->name,
            'product_id' => $product_id,
        ]);
        return back();
    }

    public function update_product_actor(Request $request) {
        $actor_id = (int) $request->route('actor_id');  
        $actor = ProductActor::find($actor_id);

        $actor->update([
            'name' => $request->name,
        ]);        

        return back();
    }     

    public function create_product_usecase(Request $request) {
        $product_id = (int) $request->route('product_id');  
     
        ProductUsecase::create([
            'name' => $request->name,
            'product_actor_id' => $request->product_actor_id,
            'product_id' => $product_id,
        ]);
        return back();
    }

    public function update_product_usecase(Request $request) {
        $usecase_id = (int) $request->route('usecase_id');  
        $usecase = ProductUsecase::find($usecase_id);

        $usecase->update([
            'name' => $request->name,
        ]);        

        return back();
    }        
    
    public function create_product_table(Request $request) {
        $product_id = (int) $request->route('product_id');  
     
        ProductTable::create([
            'name' => $request->name,
            'table_name' => $request->table_name,
            'product_id' => $product_id,
        ]);
        return back();
    }

    public function update_product_table(Request $request) {
        $table_id = (int) $request->route('table_id');  
        $table = ProductTable::find($table_id);

        $table->update([
            'name' => $request->name,
            'table_name' => $request->table_name,
        ]);        

        return back();
    }      
    
    public function create_product_table_attribute(Request $request) {
        $product_id = (int) $request->route('product_id');  
     
        ProductTableAttribute::create([
            'name' => $request->name,
            'datatype' => $request->datatype,
            'default' => $request->default,
            'nullable' => $request->nullable,
            'foreign_key' => $request->foreign_key,
            'product_table_id' => $request->product_table_id,
            'product_id' => $product_id,
        ]);
        return back();
    }

    public function update_product_table_attribute(Request $request) {
        $attribute_id = (int) $request->route('attribute_id');  
        $attribute = ProductTableAttribute::find($attribute_id);

        $attribute->update([
            'name' => $request->name,
            'datatype' => $request->datatype,
            'default' => $request->default,
            'nullable' => $request->nullable,
            'foreign_key' => $request->foreign_key,
        ]);        

        return back();
    }   
    
    public function create_product_method(Request $request) {
        $product_id = (int) $request->route('product_id');  
     
        ProductMethod::create([
            'name' => $request->name,
            'inputs' => $request->inputs,
            'outputs' => $request->outputs,
            'calculations' => $request->calculations,                       
            'remarks' => $request->remarks,
            'platform' => $request->platform, 
            'product_id' => $product_id,
        ]);
        return back();
    }

    public function update_product_method(Request $request) {
        $method_id = (int) $request->route('method_id');  
        $method = ProductMethod::find($method_id);

        $method->update([
            'name' => $request->name,
            'inputs' => $request->inputs,
            'outputs' => $request->outputs,
            'calculations' => $request->calculations,                       
            'remarks' => $request->remarks,
            'platform' => $request->platform,
        ]);        

        return back();
    }       

}
