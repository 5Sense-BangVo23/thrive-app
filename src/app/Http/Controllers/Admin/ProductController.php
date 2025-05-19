<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
   public function create(){
        return view('admin.pages.products.create');
   }

    public function store(){
          return redirect()->route('admin.products.create')->with('success', 'Product created successfully!');
    }

    public function list(){

        $products = [
            [
                'id' => 1,
                'name' => 'Product 1',
                'price' => 100,
                'quantity' => 10,
            ],
            [
                'id' => 2,
                'name' => 'Product 2',
                'price' => 200,
                'quantity' => 20,
            ],
        ];
        // $products = collect($products);
        return view('admin.pages.products.list', compact('products'));
    }

    public function edit($id){
       $product = [
            'id' => $id,
            'name' => 'Product '.$id,
            'category' => 'tools',  // phải có key này
            'price' => 100 * $id,
            'quantity' => 10 * $id,
        ];

        return view('admin.pages.products.edit', compact('product'));
    }

    public function view($id){
        $product = [
            'id' => $id,
            'name' => 'Product '.$id,
            'category' => 'tools',  
            'price' => 100 * $id,
            'quantity' => 10 * $id,
        ];

        return view('admin.pages.products.detail', compact('product'));
    }

    public function destroy($id){

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }

}