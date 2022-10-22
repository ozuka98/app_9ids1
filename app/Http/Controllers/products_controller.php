<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class products_controller extends Controller
{
    public function index(){
        $products = Product::all();

        return $products;
    }

    public function save(Request $request){
        if($request->id == 0){
            $product = new Product();
        }
        else{
            $product = Product::find($request->id);
        }

        $product->code = $request->code;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;

        if($request->file('img_product') !=null){
            $path = $request->file('img_product')->store('public');
            $product->image = $path;
        }

        $product->save();
    }

    public function delete(Request $request){
        $product = Product::find($request->id);

        $product->delete();

        return "OK, perfect";
    }
}
