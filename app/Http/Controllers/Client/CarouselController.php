<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carousel = carousel::all();
        return view('Admin.carousel', compact('carousel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'caption' => 'required'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $carousel = new carousel();
        $carousel->image = $imagePath;
        $carousel->caption = $request['caption'];
        $carousel->save();

        return redirect()->back()->withMessage('New Carouse Data Added Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $carouselId)
    {
        $carousel = carousel::find($carouselId);
        return view('Admin.editCarousel', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $carouselId)
    {
        $request->validate([
            'image' => 'required',
            'caption' => 'required'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $carousel = carousel::find($carouselId);
        $carousel->image = $imagePath;
        $carousel->caption = $request['caption'];
        $carousel->save();


        return redirect('/admin/carousel')->with('message', 'Carousel Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $carouselId)
    {
        $carousel = carousel::find($carouselId);
        if (!is_null($carousel)) {
            $carousel->delete();
        }

        return redirect()->back()->withMessage('Carousel Data Deleted Successfully');
    }
}
