<?php

namespace App\Http\Controllers;

use App\Http\Constants\LoanStatus;
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

    public function show(Request $request, $id, $type)
    {
        $loan = $this->loan->detailLoan($id, $type);   
        if (!$loan) {
            notice('error', 'Belum Ada Pinjaman Yang tersimpan');
            return redirect()->route('admin.loan.all-data.index');
        }

        $listLoan = $this->loan->listLoanFinancing($request->all(), $loan->id);
        $listLoanTransaction = $this->loan->listLoanTransaction($request->all(), $loan->id);
        return view('admin.loan.all-data.show', compact('loan','listLoan','listLoanTransaction'));
    }

    public function submitTransaction($id, $type, $transactionId, $status)
    {
        try {
            $transaction = $this->loan->findTransaction($transactionId);

            if ($status == 3) {
                $this->loan->submitTransaction($transactionId, $status);
            }elseif ($transaction->loanListFinancing->status == LoanStatus::PAID) {
                notice('error', 'Pembayaran Pinjaman ini sudah dilakukan !!, Ganti ke Tagihan lain');
                return redirect()->route('admin.loan.transaction.edit-transaction', $transactionId);
            }else{
                $this->loan->submitTransaction($transactionId, $status);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('admin.loan.all-data.show', [$id, $type]);
    }

    public function newLoan(Request $request)
    {
        $loans = $this->loan->fetchLoanNew($request->all());
        return view('admin.loan.new.index', compact('loans'));
    }

    public function submit($id, $status)
    {
        $findLoan = $this->loan->find($id);
        $findLoanExist = $this->loan->findLoanExist($findLoan->user_id, $findLoan->type);

        if ($findLoanExist->count() > 0) {
            $this->loan->submit($id, 3);
            notice('error', 'Sudah ada Pinjaman Yang sedang berjalan, Harus menyelesaikan Simpanan yang sedang berjalan dahulu, pengajuan akan otomatis dibatalkan');
            return redirect()->route('admin.loan.new.index');
        }


        $this->loan->submit($id, $status);
        return redirect()->route('admin.loan.new.index');
    }

    public function transaction(Request $request)
    {
        $transactions = $this->loan->newTransaction($request->all());
        return view('admin.loan.transaction.index', compact('transactions'));
    }

    public function transactionSubmit($id, $status)
    {
        try {
            $transaction = $this->loan->findTransaction($id);

            if ($transaction->loanListFinancing->status == LoanStatus::PAID) {
                notice('error', 'Pembayaran Pinjaman ini sudah dilakukan !!, Ganti ke Tagihan lain');
                return redirect()->route('admin.loan.transaction.edit-transaction', $id);
            }

            $this->loan->submitTransaction($id, $status);
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.loan.transaction.index');
    }

    public function editTransaction($id)
    {
        $transaction = $this->loan->findTransaction($id);
        $notPaidFinancings = $this->loan->loanFinancingNotPaid($transaction->loanListFinancing->loan_id);
        return view('admin.loan.transaction.edit', compact('transaction','notPaidFinancings'));
    }

    public function updateTransaction(Request $request, $id)
    {
        try {
            if ($request->submit == 1 && $request->loan_list_financing_id == null) {
                notice('error', 'Pilih Jenis Tagihan Dahulu');
                return redirect()->route('admin.loan.transaction.edit-transaction', $id);
            }

            if ($request->submit == 2){
               $this->loan->submitTransaction($id, 3);
            }else{
                $this->loan->updateTransaction($id, $request->loan_list_financing_id, $request->submit);
            }

        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->route('admin.loan.transaction.index');
    }
}
