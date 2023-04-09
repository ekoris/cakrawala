<?php

namespace App\Repositories\API;

use App\Http\Constants\PaymentType;
use App\Http\Constants\StatusOrder;
use App\Models\Category;
use App\Models\OrderProduct;
use App\Models\PaymentOrder;
use App\Models\Product;

class TransactionProductEloquent {

    public function listOrders($params = [])
    {
        $query = OrderProduct::where('user_id', logged_in_user()->id);

        if (isset($params['product_name'])) {
            $query->whereHas('product', function($q) use($params){
                $q->where('name','like','%'.$params['product_name'].'%');
            });
        }

        if (isset($params['order_date'])) {
            $query->where('created_at','like','%'.$params['order_date'].'%');
        }

        return $query->paginate(15);
    }

    public function order($data = [])
    {
        $product = Product::find($data['product_id']);

        $dataOrder = [
            'user_id' => logged_in_user()->id,
            'product_id' => $product->id,
            'qty' => $data['qty'],
            'total_order' => $data['qty'] * $product->price,
            'payment_type' => $data['payment_type'],
            'status' => 1,
            'account_bank_id' => $data['account_bank_id']
        ];

        $order = OrderProduct::create($dataOrder);

        return array_merge($dataOrder,[
            'payment_label' => PaymentType::label($data['payment_type']),
            'status_label' => StatusOrder::label(1),
            'order_id' => $order->id,
            'order_date' => date('Y-m-d H:i:s', strtotime($order->created_at)),
            'account_bank_id' => optional($order->accountBank)->id, 
            'account_bank_name' => optional($order->accountBank)->name, 
            'account_bank_number' => optional($order->accountBank)->number, 
        ]);
    }

    public function detailOrder($orderId)
    {
        $orderProduct = OrderProduct::find($orderId);
        return [
            'order_id' => $orderProduct->id,
            'user_name' => optional($orderProduct->user)->name,
            'product_name' => optional($orderProduct->product)->name,
            'qty' => $orderProduct->qty,
            'total_order' => $orderProduct->total_order,
            'payment_label' => PaymentType::label($orderProduct->payment_type),
            'status_label' => StatusOrder::label($orderProduct->status),
            'order_date' => date('Y-m-d H:i:s', strtotime($orderProduct->created_at)),
            'account_bank_id' => optional($orderProduct->accountBank)->id, 
            'account_bank_name' => optional($orderProduct->accountBank)->name,
            'account_bank_number' => optional($orderProduct->accountBank)->number, 
        ];
    }

    public function confirmPayment($orderId, $data = [])
    {
        $fileName = time().'_'.$data['attachment']->getClientOriginalName();
        $filePath = $data['attachment']->storeAs('product', $fileName, 'public');
        
        $orderProduct = OrderProduct::find($orderId);
        PaymentOrder::create([
            'order_product_id' => $orderProduct->id,
            'attachment' => $fileName
        ]);
        
        OrderProduct::find($orderId)->update([
            'status' => 2
        ]);

        return [
            'order_id' => $orderProduct->id,
            'user_id' => $orderProduct->user_id,
            'product_id' => $orderProduct->product_id,
            'qty' => $orderProduct->qty,
            'total_order' => $orderProduct->total_order,
            'payment_type' => $orderProduct->payment_type,
            'status' => 2,
            'payment_label' => PaymentType::label($orderProduct->payment_type),
            'status_label' => StatusOrder::label(2),
        ];
    }

}

