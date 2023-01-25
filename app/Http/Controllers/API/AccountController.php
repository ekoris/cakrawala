<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\AccountCollection;
use App\Http\Resources\CategoryProductCollection;
use App\Http\Resources\ProductCollection;
use App\Models\Category;
use App\Repositories\API\AccountEloquent;
use Illuminate\Http\Request;

class AccountController extends BaseController
{
   protected $account;

   public function __construct(AccountEloquent $account)
   {
      $this->account = $account;
   }

   public function saveAccount(Request $request)
   {
        try {
            $account = $this->account->saveAccount($request->all());
            return $this->sendResponse($account, 'Data Berhasil di simpan');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }

   public function allAccount(Request $request)
   {
        return AccountCollection::collection($this->account->allAccount($request->all()));
   }

   public function accountType($type)
   {
        try {
            $account = $this->account->accountType($type);
            return $this->sendResponse($account, 'Data Akun');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }
   
}