<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('brand' , 'category')->get();
        return view('product.index' , ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::get();
        $categories = Category::get();
        return view('product.form', ['brands' => $brands , 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
//     */


    public function store(Request $request)
    {
        $request->validate([
            'title.*.title' => 'required',
            'price.*.price' => 'required|numeric',
            'brand_id.*.brand_id' => 'required',
            'category_id.*.category_id' => 'required',
            'img.*.img' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);

        $forms = $request->input('title');

        foreach ($forms as $key => $form) {
            $model = new Product();
            $model->title = $form['title'];
            $model->price = $request->input('price')[$key]['price'];
            $model->brand_id = $request->input('brand_id')[$key]['brand_id'];
            $model->category_id = $request->input('category_id')[$key]['category_id'];


            if (isset($request->file('img')[$key])) {
                $file = $request->file('img')[$key]['img'];
                if ($file->isValid()) {
                    $path = $file->store('upload', 'public');
                    $model->img = $path;
                } else {
                    return back()->withErrors(['img' => 'File not uploaded properly.']);
                }
            }
            $model->save();
        }
        return redirect('/admin/product')->with('success', 'Products and their duplicates have been saved.');
    }






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
        //
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show = Product::findorfail($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('product.form' , ['show' => $show , 'brands' => $brands , 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $store = Product::findorfail($id);

        $store->title = $request->title;
        $store->img = $request->img;
        $store->price = $request->price;
        $store->brand_id = $request->brand_id;
        $store->category_id = $request->category_id;

        if($request->hasFile('img')){
            $file = $request->file('img')->store('upload', 'public');
            $store->img = $file;
        }

        $store->save();

        return redirect('/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pro = Product::findorfail($id);
        if ($pro->img) {
            Storage::delete('public/' . $pro->img);
        }
        $pro->delete();
        return redirect('/admin/product');
    }
}
