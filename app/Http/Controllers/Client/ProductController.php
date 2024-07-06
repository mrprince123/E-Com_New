<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product as RequestsProduct;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Lang;

class ProductController extends Controller
{

    public function indexAdmin()
    {
        $products = Product::all();
        return view('Admin.product', compact('products'));
    }


    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $products = Product::all();
        return view('product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('product');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(RequestsProduct $request)
    {

        $productPicture = $request->file('product_pic')->store('images', 'public');

        $product = new Product();
        $product->name = $request['name'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        $product->product_pic = $productPicture;
        $product->detail_description = $request['detail_description'];
        $product->category_id = $request['category_id'];
        // dd($product);
        $product->save();

        return redirect()->back()->withMessage(Lang::get('product.success'));
    }

    /**
     * Display the specified resource.
     */

    public function show(string $productId)
    {
        $product = Product::find($productId);
        return view('fullProduct', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $productId)
    {
        $product = Product::find($productId);
        $category = Category::all();
        return view('Admin.editProduct', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $productId)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'product_pic' => 'required',
            'category_id' => 'required',
            'detail_description' => 'required'
        ]);

        $productPicture = $request->file('product_pic')->store('images', 'public');

        $newProduct = Product::find($productId);
        $newProduct->name = $request['name'];
        $newProduct->description = $request['description'];
        $newProduct->price = $request['price'];
        $newProduct->category_id = $request['category_id'];
        $newProduct->product_pic = $productPicture;
        $newProduct->detail_description = $request['detail_description'];
        $newProduct->save();

        return redirect('/admin/product')->withMessage(Lang::get('product.update'));
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $productId)
    {
        $product = Product::find($productId);
        if (!is_null($product)) {
            $product->delete();
        }
        return redirect()->back()->withMessage(Lang::get('product.delete'));
    }

    public function oneCategoryProduct(string $categoryId)
    {
        $category = Category::find($categoryId);
        $products = Product::where('category_id', $categoryId)->get();
        // dd($products);
        return view('separateCategory', compact('products', 'category'));
    }
}
