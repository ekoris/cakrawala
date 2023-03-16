<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\AccountCollection;
use App\Repositories\API\HistoryTransactionEloquent;
use App\Repositories\API\LoanEloquent;
use Illuminate\Http\Request;

class HistoryTransactionController extends BaseController
{
    protected $history;

    public function __construct(HistoryTransactionEloquent $history)
    {
        $this->history = $history;
    }

    public function index(Request $request)
    {
        try {
            $history = $this->history->fetch($request->all());
            return $this->sendResponse($history, 'data');
        } catch (\Throwable $th) {
            throw $th;
            return $this->sendError('data error');
        }
    }
}