<?php

namespace App\Http\Controllers;

use App\Repositories\SavingEloquent;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    protected $saving;

    public function __construct(SavingEloquent $saving)
    {
        $this->saving = $saving;
    }

    public function index(Request $request)
    {
        $savings = $this->saving->fetch($request->all());
        return view('admin.saving.all-data.index', compact('savings'));
    }

    public function show(Request $request, $id, $type)
    {
        $saving = $this->saving->detailSaving($id, $type);   
        if (!$saving) {
            notice('error', "Tidak ada Data Tersimpan");
            return redirect()->route('admin.saving.all-data.index');
        }
        $historySaving = $this->saving->historySaving($request->all(), $id, $type);   
        return view('admin.saving.all-data.show', compact('saving','historySaving'));
    }

    public function submit($id, $type, $transactionId, $status)
    {
        try {
            $this->saving->submit($transactionId, $status);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('admin.saving.all-data.show', [$id, $type]);
    }

    public function transactionPending(Request $request)
    {
        $transactions = $this->saving->transactionPending($request->all());   
        return view('admin.saving.transaction.index', compact('transactions'));
    }

    public function submitTransactionPending($transactionId, $status)
    {
        try {
            $this->saving->submit($transactionId, $status);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('admin.saving.transaction-pending.index');
    }
}
