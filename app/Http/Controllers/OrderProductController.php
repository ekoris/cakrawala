<?php

namespace App\Http\Controllers;

use App\Repositories\OrderEloquent;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    protected $order;

    public function __construct(OrderEloquent $order)
    {
        $this->order = $order;
    }

    public function allOrder(Request $request)
    {
        $orders = $this->order->allOrder($request->all());
        return view('admin.order.all-order', compact('orders'));
    }

    public function newOrder(Request $request)
    {
        $orders = $this->order->newOrder($request->all());
        return view('admin.order.new-order', compact('orders'));
    }

    public function action(Request $request)
    {
        try {
            $this->order->action($request->all());
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('admin.order.all-order.index');
    }

}