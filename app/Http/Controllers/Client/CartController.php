<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class CartController extends Controller
{

    public function indexAdmin()
    {
        $cart = Cart::all();
        return view('Admin.cart', compact('cart'));
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $userId = Auth::id();
        // where user_id matched the login user id
        $cart = Cart::all()->where('user_id', $userId);
        $sale = Sale::all();
        return view('cart', compact('cart', 'sale'));
    }

    public function cartProductCount()
    {
        $userId = Auth::id();
        // where user_id matched the login user id
        $cart = Cart::all()->where('user_id', $userId);
        $cartProductCount = count($cart);
        return view('Layout.header', ['cartCount' => $cartProductCount]);
    }

    /**
     * Store a newly created product in the cart
     */

    public function addCart(Request $request, string $productId)
    {
        try {

            $userId = Auth::id();

            if (!$userId) {
                // User is not Authenticated 

                // Send it to the Login Page 
                return redirect('/login');
                // return response()->json(['error' => 'User not Authenticated in Cart'], 401);
            }



            $product = Product::find($productId);
            // echo $product;
            if (!$product) {
                return response()->json([
                    'error' => Lang::get('cart.notFound')
                ], 404);
            }

            // Check if the Product is already available in the Cart or not 
            $existingProduct = Cart::where('user_id', $userId)->where('product_id', $productId)->first();
            if ($existingProduct) {
                return redirect('/category')->with(
                    'error',
                    Lang::get('cart.already')
                );
            }

            // Save the Cart Items
            $cart = new Cart();
            $cart->product_id = $productId;
            $cart->quantity = $request['quantity'];
            $cart->user_id = $userId;
            $cart->save();

            return redirect('/cart')->withMessage(Lang::get('cart.success'));

        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    /**
     * Update the Quantity of the Product in the Cart
     */

    public function quantityUpdate(Request $request, string $cartId)
    {

        $cart = Cart::find($cartId);

        if (!$cart) {
            return redirect('/cart')->withMessage(Lang::get('cart.notFoundCart'));
        }

        $cart->quantity = $request['quantity'];
        $cart->save();

        return redirect('/cart');
    }

    public function removeProduct(string $cartid)
    {
        try {

            $userId = Auth::id();

            if (!$userId) {
                // User is not Authenticated 
                return response()->json([
                    'error' => Lang::get('cart.notAuth'),
                    'statusCode' => 401
                ]);
            }

            $cartItem = Cart::where('id', $cartid)->where('user_id', $userId)->first();

            if (!$cartItem) {
                return response()->json(['error' => Lang::get('cart.notFoundCart')], 404);
            }

            $cartItem->delete();

            return redirect('/cart');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
