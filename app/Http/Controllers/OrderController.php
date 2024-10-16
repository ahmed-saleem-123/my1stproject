<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $adds = Order::get();
            return view('order.index' , ['adds' => $adds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new Order();

        $store->name = $request->name;
        $store->email = $request->email;
        $store->city = $request->city;
        $store->address = $request->address;
        $store->country = $request->country;
        $store->save();

        return redirect()->route('order');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $items = Orderitem::with('product', 'order')->where('order_id', $id)->get();
        return view('order.order-detail', ['items' => $items, 'order' => $order]);

        return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Order::findorfail($id);

        return view('Order.form', ['edit' => $edit]);
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
        $store = Order::findorfail($id);

        $store->name = $request->name;
        $store->email = $request->email;
        $store->city = $request->city;
        $store->address = $request->address;
        $store->country = $request->country;
        $store->save();

        return redirect()->route('order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Order::findorfail($id);

        $delete->delete();

        return redirect()->route('order');
    }
}
