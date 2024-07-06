<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\carousel;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $carousel = carousel::all();
        $category = Category::with('products')->get();
        return view('home', compact('category', 'carousel'));
    }

}
