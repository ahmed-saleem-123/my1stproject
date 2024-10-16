<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Frontend\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('brand_id');

        if (empty($search)) {
            $products = Product::with('brand')->get();
        } else {
            $products = Product::with('brand')
                ->where('title', 'LIKE',  $search . '%')
                ->get();
        }

        $categories = Category::all();
        $brands = Brand::all();
        return view('producted.product', ['products' => $products] , compact('categories' , 'brands') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      //
    }

    public function showByCategory(Request $request, $categoryId)
    {
        $products = Product::where('category_id', $categoryId)->get();
        $categories = Category::get();
        $brands = Brand::get();
        $selectedCategory = Category::find($categoryId);

        return view('producted.product', compact('products', 'categories', 'brands', 'selectedCategory'));
    }


    public function showByBrand($brandId)
    {
        $products = Product::where('brand_id', $brandId)->get();
        $categories = Category::all();
        $brands = Brand::all();

        return view('producted.product', compact('products', 'categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = Product::find($id);
        return view('producted.detail' , ['details' => $details]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }



    public function viewCart()
{
    $cart = session()->get('cart', []);

    return view('producted.cart', ['cart' => $cart]);
}

    public function addToCart(Request $request)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Add to cart logic
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->title,
                "price" => $product->price,
                "quantity" => $request->quantity,
                "img" => $product->img,
            ];
        }

        // Save updated cart in session
        session()->put('cart', $cart);

        return response()->json(['message' => 'Product added to cart successfully!']); // Return JSON response
    }







    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }



    public function checkout(Request $request)
    {
        $cartItems = session()->get('cart', []);

        if(empty($cartItems)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        DB::transaction(function () use($request, $cartItems) {
            $order = Order::create([
                'name' => $request->name,
                'email' => $request->email,
                'city' => $request->city,
                'country' => $request->country,
                'address' => $request->address,
            ]);

            foreach ($cartItems as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'qty' => $item['quantity'],
                ]);
            }
        });

        session()->forget('cart');

        return redirect()->route('cart.thank-you')->with('success', 'Checkout successfully completed.');
    }


    public function ThankYou(){
        return view('producted.thankyou');
    }












}

