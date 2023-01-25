<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\AccountCollection;
use App\Repositories\API\SavingEloquent;
use Illuminate\Http\Request;

class SavingController extends BaseController
{
   protected $saving;

   public function __construct(SavingEloquent $saving)
   {
      $this->saving = $saving;
   }

   public function saving(Request $request)
   {
        try {
            $saving = $this->saving->saving($request->all());
            return $this->sendResponse($saving, 'Data Berhasil di simpan');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }

   public function listSaving(Request $request)
   {
        try {
            $saving = $this->saving->listSaving();
            return $this->sendResponse($saving, 'Data');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }

   public function savingType($type)
   {
        try {
            $saving = $this->saving->savingType($type);
            return $this->sendResponse($saving, 'Data');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }

   public function savingDepositDetail($savingDepositId)
   {
        try {
            $saving = $this->saving->findBySavingDepositId($savingDepositId);
            return $this->sendResponse($saving, 'Data');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }

   public function historySavingDepositTransaction($savingDepositId)
   {
        try {
            $saving = $this->saving->historyTransactionDeposit($savingDepositId);
            return $this->sendResponse($saving, 'Data');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }
   
}