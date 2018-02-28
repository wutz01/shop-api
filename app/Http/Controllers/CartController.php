<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\CartItems;
use App\Product;

class CartController extends Controller
{
    public function getCartByUserId($userId) {
      $json['cart'] = $cart = Cart::where('userId', $userId)->where('status', 'ACTIVE', 'AND')->first();
      if ($cart) {
        $json['items'] = $cart->items;
      }
      return response()->json($json, 200);
    }

    public function getCartByGuestId($guestId) {
      $json['cart'] = $cart = Cart::where('guestId', $guestId)->where('status', 'ACTIVE', 'AND')->first();
      if ($cart) {
        $json['items'] = $cart->items;
      }
      return response()->json($json, 200);
    }

    public function addToCart(Request $request) {
      $authId = $request->has('userId') ? $request->input('userId') : $request->input('guestId');

      if ($request->has('userId') && $request->has('guestId') && $request->has('cartId')) {
        $updateMainCart = Cart::where('id', $request->input('cartId'))->where('guestId', $request->input('guestId'))->first();
        $updateMainCart->userId = $authId;
        $updateMainCart->save();
      }

      if (!$request->has('cartId')) {
        $cart = new Cart;
        if ($request->has('userId')) {
          $cart->userId = $request->input('userId');
        }

        if ($request->has('guestId')) {
          $cart->guestId = $request->input('guestId');
        }
        $cart->save();

        foreach ($request->input('items') as $key => $value) {
          $item = new Cart;

          $product = Product::find($value->productId);
          if (!$product) return response()->json(['error' => 'Product not found'], 400);

          $item->quantity = $value->quantity;
          $item->productId = $value->productId;
          $item->cartId = $cart->id;
          $item->reservePrice = $product->price;
          $item->finalPrice = 0.00;
          $item->save();
        }
      } else {
        $cart = Cart::find($request->input('cartId'));

        foreach ($request->input('items') as $key => $value) {
          $product = Product::find($value->productId);
          if (!$product) return response()->json(['error' => 'Product not found'], 400);

          if ($value->id) {
            $item = CartItems::find($value->id);
          } else {
            $item = new Cart;
            $item->reservePrice = $product->price;
          }

          $item->quantity = $value->quantity;
          $item->productId = $value->productId;
          $item->cartId = $cart->id;
          $item->finalPrice = 0.00;
          $item->save();
        }
      }

      $json['cart'] = $cart;
      $json['items'] = $cart->items;
      return response()->json($json, 200);
    }
}
