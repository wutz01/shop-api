<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;
use Validator, Auth;

class ProductController extends Controller
{
    public function allCategory () {
      $json['categories'] = Category::all();
      return response()->json($json, 200);
    }

    public function getCategory ($id) {
      $json['category'] = $category = Category::find($id);
      if ($category) {
        $json['products'] = $category->products;
        return response()->json($json, 200);
      }
      return response()->json($json, 404);
    }

    public function updateCategory (Request $request) {
      $catId = $request->input('catId');
      if (!isset($catId)) return response()->json(['error' => 'Category not found'], 404);

      $validator = Validator::make($request->all(), [
          'name'             => 'required',
          'description'		   => 'required'
      ]);

      if ($validator->fails()) {
        $json['errors'] = $validator->messages();
        return response()->json($json, 400);
      }
      $category = Category::find($catId);
      $category->name = $request->input('name');
      $category->description = $request->input('description');
      if ($request->has('status')) {
        $category->status = strtoupper($request->input('status'));
      }
      $category->save();

      $json['category'] = $category;
      return response()->json($json, 200);
    }

    public function createCategory (Request $request) {
      $validator = Validator::make($request->all(), [
          'name'             => 'required',
          'description'		   => 'required'
      ]);

      if ($validator->fails()) {
        $json['errors'] = $validator->messages();
        return response()->json($json, 400);
      }
      $category = new Category;
      $category->name = $request->input('name');
      $category->description = $request->input('description');
      $category->save();

      $json['category'] = $category;
      return response()->json($json, 200);
    }

    public function allProducts () {
      $json['products'] = Product::all();
      return response()->json($json, 200);
    }

    public function getProduct ($id) {
      $json['product'] = $product = Product::find($id);
      if ($product) {
        $json['categories'] = $product->categories;
        $json['supplier'] = $product->supplier;
        return response()->json($json, 200);
      }
      return response()->json($json, 404);
    }

    public function updateProduct (Request $request) {
      $prodId = $request->input('prodId');
      if (!isset($prodId)) return response()->json(['error' => 'Product not found'], 404);

      $validator = Validator::make($request->all(), [
          'name'             => 'required',
          'description'		   => 'required',
          'supplier_id'      => 'required'
      ]);

      if ($validator->fails()) {
        $json['errors'] = $validator->messages();
        return response()->json($json, 400);
      }
      $product = Product::find($prodId);
      $product->name = $request->input('name');
      $product->description = $request->input('description');
      $product->price = $request->input('price');
      $product->supplier_id = $request->input('supplier_id');
      if ($request->has('status')) {
        $product->status = strtoupper($request->input('status'));
      }
      if ($request->has('isFeatured')) {
        $product->isFeatured = $request->input('isFeatured');
      }
      $product->save();

      $product->categories()->sync($request->input('categories'));

      $json['product'] = $product;
      return response()->json($json, 200);
    }

    public function createProduct (Request $request) {
      $validator = Validator::make($request->all(), [
          'name'             => 'required',
          'description'		   => 'required',
          'supplier_id'      => 'required'
      ]);

      if ($validator->fails()) {
        $json['errors'] = $validator->messages();
        return response()->json($json, 400);
      }
      $product = new Product;
      $product->name = $request->input('name');
      $product->description = $request->input('description');
      $product->price = $request->input('price') ? $request->input('price') : 0.00;
      $product->supplier_id = $request->input('supplier_id');
      if ($request->has('status')) {
        $product->status = strtoupper($request->input('status'));
      }
      if ($request->has('isFeatured')) {
        $product->isFeatured = $request->input('isFeatured');
      }
      $product->save();

      $product->categories()->sync($request->input('categories'));

      $json['product'] = $product;
      return response()->json($json, 200);
    }

    public function testUploadImage(Request $request) {
      $data = $request->all();
      dd($data);
      if($image = array_pull($data, 'image')){
       $destinationPath = 'uploads/users/';
       //
       // if (!file_exists(public_path($destinationPath))) {
       //     mkdir(public_path($destinationPath), 0777, true);
       // }

       if($image->isValid()){
         $ext        = $image->getClientOriginalExtension();
         $filename   = $image->getFilename();
         $orig_name  = $image->getClientOriginalName();

         $for_upload = $filename . "." . $ext;

         dd(public_path($destinationPath));
         // $is_success = $image->move(public_path($destinationPath), $for_upload);

         // if($is_success){
         //     $user->image_path    = $destinationPath;
         //     $user->filename      = $filename;
         //     $user->orig_filename = $orig_name;
         //     $user->extension     = $ext;
         //     $user->save();
         // }
       }
      }
    }
}
