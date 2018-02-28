<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Validator, Auth;

class SupplierController extends Controller
{
  public function allSuppliers () {
    $json['suppliers'] = Supplier::all();
    return response()->json($json, 200);
  }

  public function getSupplier ($id) {
    $json['supplier'] = $supplier = Supplier::find($id);
    if ($supplier) {
      $json['products'] = $supplier->products;
      return response()->json($json, 200);
    }
    return response()->json($json, 404);
  }

  public function updateSupplier (Request $request) {
    $supplierId = $request->input('supplierId');
    if (!isset($catId)) return response()->json(['error' => 'Supplier not found'], 404);

    $validator = Validator::make($request->all(), [
        'name'     => 'required',
        'address'	 => 'required',
        'currency' => 'required'
    ]);

    if ($validator->fails()) {
      $json['errors'] = $validator->messages();
      return response()->json($json, 400);
    }
    $supplier = Supplier::find($supplierId);
    $supplier->name     = $request->input('name');
    $supplier->address  = $request->input('address');
    $supplier->currency = $request->input('currency');
    if ($request->has('status')) {
      $supplier->status = strtoupper($request->input('status'));
    }
    $supplier->save();

    $json['supplier'] = $supplier;
    return response()->json($json, 200);
  }

  public function createSupplier (Request $request) {
    $validator = Validator::make($request->all(), [
      'name'     => 'required',
      'address'	 => 'required',
      'currency' => 'required'
    ]);

    if ($validator->fails()) {
      $json['errors'] = $validator->messages();
      return response()->json($json, 400);
    }

    $supplier = new Supplier;
    $supplier->name     = $request->input('name');
    $supplier->address  = $request->input('address');
    $supplier->currency = $request->input('currency');
    $supplier->save();

    $json['supplier'] = $supplier;
    return response()->json($json, 200);
  }
}
