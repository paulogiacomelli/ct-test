<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Validator;
use Storage;

class ProductController extends Controller
{

    public function index() {

        $path = storage_path('app/products.json');
        $json = file_get_contents($path);

        $products = json_decode($json);
        $products = collect($products)->sortBy('created_at')->toArray();

        return view('welcome')->with('products', $products);
    }

    public function store(Request $request) {

        $rules = array(
            'name'    => 'required',
            'quantity'    => 'required',
            'price'    => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            // file store
            $file_path = storage_path('app/products.json');
            $products = file_get_contents($file_path);

            $products_array = json_decode($products, true);

            $product = [
                'name' => $request->input("name"),
                'quantity' => $request->input("quantity"),
                'price' => $request->input("price"),
                'created_at' => date('Y-m-d H:i:s')
            ];

            array_push($products_array, $product);

            $json = json_encode($products_array, JSON_PRETTY_PRINT);
            $products = file_put_contents($file_path, $json);

            return response()->json($product);
        }
    }
}
