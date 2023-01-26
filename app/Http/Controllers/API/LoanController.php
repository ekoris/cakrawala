<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\AccountCollection;
use App\Repositories\API\LoanEloquent;
use Illuminate\Http\Request;

class LoanController extends BaseController
{
   protected $loan;

   public function __construct(LoanEloquent $loan)
   {
      $this->loan = $loan;
   }

   public function store(Request $request)
   {
        try {
            $loan = $this->loan->store($request->all());
            return $this->sendResponse($loan, 'Data Berhasil di simpan');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }

   public function listLoan(Request $request)
   {
        try {
            $loan = $this->loan->listLoan();
            return $this->sendResponse($loan, 'Data');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }

   public function loanType($type)
   {
        try {
            $loan = $this->loan->loanType($type);
            return $this->sendResponse($loan, 'Data');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }

   public function loanDetail($loanId)
   {
        try {
            $loan = $this->loan->findLoan($loanId);
            return $this->sendResponse($loan, 'Data');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }

   public function loanListFinancing($loanId)
   {
        try {
            $loan = $this->loan->findListLoanFinancing($loanId);
            return $this->sendResponse($loan, 'Data');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
   }


}