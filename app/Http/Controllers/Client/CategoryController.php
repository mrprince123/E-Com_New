<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category as RequestsCategory;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{

    public function indexAdmin()
    {
        $categories = Category::all();
        return view('Admin.category', compact('categories'));
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $category = Category::with('products')->get();
        return view('category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return redirect('category');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(RequestsCategory $request)
    {
        /* Taking the Path of the CategoryImage to Store in the DB */
        $categoryImgPath = $request->file('categoryImg')->store('images', 'public');

        $category = new Category();
        $category->name = $request['name'];
        $category->categoryImg = $categoryImgPath;
        $category->description = $request['description'];
        $category->save();

        return redirect()->back()->withMessage(Lang::get('category.success'));
    }

    /**
     * Display the specified resource.
     */

    public function show(string $categoryId)
    {
        $category = Category::find($categoryId);
        return view('category', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $categoryId)
    {
        $category = Category::find($categoryId);
        return view('Admin.categoryEdit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $categoryId)
    {
        $request->validate([
            'name' => 'required',
            'categoryImg' => 'required',
            'description' => 'required'
        ]);

        /* Taking the Path of the CategoryImage to Store in the DB */
        $categoryImgPath = $request->file('categoryImg')->store('images', 'public');

        $newCategory = Category::find($categoryId);
        $newCategory->name = $request['name'];
        $newCategory->categoryImg = $categoryImgPath;
        $newCategory->description = $request['description'];
        $newCategory->save();

        return redirect('/admin/category')->withMessage(Lang::get('category.update'));

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $categoryId)
    {
        $category = Category::find($categoryId);
        if (!is_null($category)) {
            $category->delete();
        }

        return redirect()->back()->withMessage(Lang::get('category.delete'));
    }
}
