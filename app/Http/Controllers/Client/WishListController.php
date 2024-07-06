<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WishListController extends Controller
{

    public function indexAdmin()
    {
        $wishlist = WishList::all();
        return view('Admin.wishlist', compact('wishlist'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id();
        $wishlist = WishList::all()->where('user_id', $user);
        // dd($wishlist);
        return view('wishlist', compact('wishlist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $product_id = $request->product_id;
            $wishlist = WishList::where('product_id', $product_id)->first();

            if (!$wishlist) {
                WishList::create([
                    'user_id' => $request->user_id,
                    'product_id' => $request->product_id
                ]);

                return redirect('/wishlist')->withMessage('Product Added to your wishlist');
            } else {
                return redirect()->back()->withMessage('Product already exits in the wishlist');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $wishlistId)
    {
        // find the wishlist product
        $wishlist = WishList::find($wishlistId);
        if (!is_null($wishlist)) {
            $wishlist->delete();
        }
        return redirect()->back()->withMessage('Product Remove from Wishlist Successfully');
    }
}
