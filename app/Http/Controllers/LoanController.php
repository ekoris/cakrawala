<?php

namespace App\Http\Controllers;

use App\Repositories\LoanEloquent;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    protected $loan;

    public function __construct(LoanEloquent $loan)
    {
        $this->loan = $loan;
    }

    public function allData(Request $request)
    {
        $loans = $this->loan->fetch($request->all());
        return view('admin.loan.all-data.index', compact('loans'));
    }

    public function newLoan(Request $request)
    {
        $loans = $this->loan->fetchLoanNew($request->all());
        return view('admin.loan.new.index', compact('loans'));
    }
}
