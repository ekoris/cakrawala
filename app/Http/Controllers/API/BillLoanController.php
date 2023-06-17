<?php

namespace App\Http\Controllers\API;

use App\Repositories\API\BillLoanEloquent;
use Illuminate\Http\Request;

class BillLoanController extends BaseController
{
    protected $bill;

    public function __construct(BillLoanEloquent $bill)
    {
        $this->bill = $bill;
    }

    public function index(Request $request)
    {
        try {
            $bills = $this->bill->fetch($request->all());
            return $this->sendResponse($bills, 'data');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
    }
}