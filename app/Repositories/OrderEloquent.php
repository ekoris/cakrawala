<?php

namespace App\Repositories;

use App\Http\Constants\StatusOrder;
use App\Models\OrderProduct;

class OrderEloquent {

    public function allOrder($params = [])
    {
        $query = OrderProduct::latest();

        if (isset($params['status'])) {
            $query->where('status', $params['status']);
        }

        if (isset($params['name'])) {
            $query->whereHas('user', function($query) use($params){
                $query->where('name', $params['name']);
            });
        }

        if (isset($params['user'])) {
            $query->whereHas('user', function($query) use($params){
                $query->where('name', $params['user']);
            });
        }

        return $query->paginate();
    }

    public function newOrder($params = [])
    {
        $query = OrderProduct::latest()->whereIn('status',[StatusOrder::PENDING,StatusOrder::WAITING_CONFIRMATION]);

        if (isset($params['name'])) {
            $query->whereHas('user', function($query) use($params){
                $query->where('name', $params['name']);
            });
        }

        if (isset($params['user'])) {
            $query->whereHas('user', function($query) use($params){
                $query->where('name', $params['user']);
            });
        }

        return $query->paginate(15);
    }

    public function action($data)
    {
        return OrderProduct::where('id', $data['id'])->update(['status' => $data['status']]);
    }

}