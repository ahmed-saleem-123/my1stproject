<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $edits = Category::all();
        return view('category.index', compact('edits'));
    }

    public function create()
    {
        return view('category.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $shabu = new Category();
        $shabu->title = $request->title;
        $shabu->save();

        return redirect()->route('category')->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $hamd = Category::findOrFail($id);
        return view('category.form', compact('hamd'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $shabu = Category::findOrFail($id);
        $shabu->title = $request->title;
        $shabu->save();

        return redirect()->route('category')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $brand = Category::findOrFail($id);
        $brand->delete();

        return redirect()->route('category')->with('success', 'Category deleted successfully!');
    }
}
