<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Order";
        $data['data'] = Order::all()->sortByDesc('id');

        return view("admin/order/index",compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data['dataModel'] = Order::find($id);
        $data['typeForm'] = "show";
        $data['title'] = "Detail";
        return view("admin/order/form",compact('data'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        $order->update(['status' => 'CANCEL']);
        $order->save();
        return response()->json([
            'Code'             => 200,
            'Message'          => "Cance Success"
        ]);
    }

    public function printinv($id)
    {
        $order = Order::find($id);
        $data['dataModel'] = Order::find($id);
        $data['typeForm'] = "show";
        $data['title'] = "Print";
        return view("admin/order/print",compact('data'));
    }

    public function ChangeStatus($id,Request $request)
    {
        $order = Order::find($id);

        $order->update(['status' => $request->status]);
        $order->save();
        return response()->json([
            'Code'             => 200,
            'Message'          => "Cance Success"
        ]);
    }
}
