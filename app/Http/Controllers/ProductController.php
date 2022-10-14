<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{

    public function index()
    {
        //GET - all data from db 
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        //Validate

        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'photo' => 'required',
            'description' => 'required'
        ]);
        //  Image Data 
        $product = new Product();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $allowedfileExtension = ['pdf', 'png', 'jpg'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);

            if ($check) {
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $product->photo = $name;
            };
        }

        //TEXT DATA
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $product->save();
        return response()->json($product);
    }


    public function show($id)
    {
        //GET 1 Item from products table
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        //Validate

        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'photo' => 'required',
            'description' => 'required'
        ]);


        //  Image Data 
        $product = Product::find($id);


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $allowedfileExtension = ['pdf', 'png', 'jpg'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
 
            if ($check) {
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $product->photo = $name;
            };
        }
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $product->save();
        return response()->json($product);
    }


    public function destroy($id)
    {
        //DELETE by ID
        $product = Product::all();
        $product->delete();
        return response()->json('Product Deleted Successfully');
    }
}
