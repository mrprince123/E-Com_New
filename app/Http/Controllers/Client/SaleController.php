<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale as RequestsSale;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class SaleController extends Controller
{
    // This is showing the Sale Data in the Admin
    public function indexAdmin()
    {
        $sale = Sale::all();
        return view('Admin.sale', compact('sale'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sale = Sale::all();
        return view('cart', compact('sale'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsSale $request)
    {

        $imagePath = $request->file('image')->store('images', 'public');

        $sale = new Sale();
        $sale->image = $imagePath;
        $sale->name = $request['name'];
        $sale->offer = $request['offer'];
        $sale->description = $request['description'];
        $sale->save();

        return redirect()->back()->withMessage(Lang::get('sale.success'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $saleId)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $saleId)
    {
        $sale = Sale::find($saleId);
        return view('Admin.saleEdit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $saleId)
    {
        $request->validate([
            'image' => 'required',
            'name' => 'required',
            'offer' => 'required',
            'description' => 'required'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $sale = Sale::find($saleId);
        $sale->image = $imagePath;
        $sale->name = $request['name'];
        $sale->offer = $request['offer'];
        $sale->description = $request['description'];
        $sale->save();

        return redirect('/admin/sale')->withMessage(Lang::get('sale.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $saleId)
    {

        $sale = Sale::find($saleId);
        if (!is_null($sale)) {
            $sale->delete();
        }

        return redirect()->back()->withMessage(Lang::get('sale.delete'));
    }
}
