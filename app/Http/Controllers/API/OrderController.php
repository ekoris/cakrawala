<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CategoryProductCollection;
use App\Http\Resources\ListOrderCollection;
use App\Http\Resources\ProductCollection;
use App\Models\Category;
use App\Repositories\API\ProductEloquent;
use App\Repositories\API\TransactionProductEloquent;
use Illuminate\Http\Request;
use App\Repositories\API\UserEloquent;

class OrderController extends BaseController
{
   protected $transactionProduct;

   public function __construct(TransactionProductEloquent $transactionProduct)
   {
      $this->transactionProduct = $transactionProduct;
   }

   public function list(Request $request)
   {
      return ListOrderCollection::collection($this->transactionProduct->listOrders($request->all()));
   }
   
   public function order(Request $request)
   {
       try {
            $order = $this->transactionProduct->order($request->all());
            return $this->sendResponse($order, 'Data Berhasil di Simpan');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }

   public function detailOrder($idOrder)
   {
       try {
            $order = $this->transactionProduct->detailOrder($idOrder);
            return $this->sendResponse($order, '');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }

   public function confirmPayment(Request $request, $orderId)
   {
       try {
            $confirm = $this->transactionProduct->confirmPayment($orderId, $request->all());
            return $this->sendResponse($confirm, 'Data Berhasil di Simpan');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }
}