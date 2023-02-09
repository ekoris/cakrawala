@extends('layouts.master')

@php
use App\Http\Constants\LoanStatus;
use App\Http\Constants\LoanType;
use App\Http\Constants\LoanTransactionStatus;
@endphp

@push('breadcumb')
<h4 class="page-title pull-left">Admin</h4>
<ul class="breadcrumbs pull-left">
    <li><a href="">Home</a></li>
    <li><span>Data Pinjaman</span></li>
</ul>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 mt-5">
        <div class="card">
            <div class="card-body">
                <form method="POST" onsubmit="return confirm('Apakah Anda Yakin ingin merubah transaksi');" action="{{ route('admin.loan.transaction.update-transaction', $transaction->id) }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>
                        <div class="col-md-8">
                            <span class="form-control" readonly>{{ $transaction->loanListFInancing->loan->user->name }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Tipe Pinjaman</label>
                        <div class="col-md-8">
                            <span class="form-control" readonly>{{ LoanType::label($transaction->loanListFinancing->loan->type) }}</span>
                        </div>
                    </div>
                     <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Total Bayar</label>
                        <div class="col-md-8">
                            <span class="form-control" readonly>Rp. {{ $transaction->total }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Rubah Tagihan Ke ?</label>
                        <div class="col-md-8">
                            <select name="loan_list_financing_id" class="form-control" id="">
                                <option value="" selected>Pilih Tagihan</option>
                                @foreach ($notPaidFinancings as $item)
                                    <option value="{{ $item->id }}">{{ $item->due_date }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-4 align-right ">
                        </div>
                        <div class="col-md-8 text-right">
                            <button type="submit" onclick="" name="submit" value="1" class="btn btn-sm btn-dark">
                                Rubah Pembayaran
                            </button>
                            <button type="submit" name="submit" value="2" class="btn btn-sm btn-danger">
                                Batalkan Pembayaran
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
@endpush

@push('scripts')
<script>
    $(document).ready(function () {
        $('.btn-reset').on('click', function () {
            $("#form-filter").find('input:text, input:password, input:file, select, textarea').val('');
            $("#form-filter").find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
            $("#form-filter").submit();
        });
    });
</script>
@endpush
