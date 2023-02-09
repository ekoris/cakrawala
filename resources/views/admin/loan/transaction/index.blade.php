@extends('layouts.master')

@php
use App\Http\Constants\SavingType;
use App\Http\Constants\HistoryTransactionStatus;
use App\Http\Constants\LoanType;
@endphp

@push('breadcumb')
<h4 class="page-title pull-left">Admin</h4>
<ul class="breadcrumbs pull-left">
    <li><a href="">Home</a></li>
    <li><span>Data Pinjaman Baru</span></li>
</ul>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">
                <form action="" id="form-filter">
                    <div class="d-md-flex justify-content-md-end" style="padding-bottom: 15px">
                        <div class="" style="padding-right: 10px">
                            <select name="type" class="form-control form-control-sm" id="">
                                <option value="" selected>Pilih Pinjaman</option>
                                @foreach (LoanType::labels() as $key => $item)
                                    <option value="{{ $key }}" {{ Request::get('type') == $key ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="" style="padding-right: 10px">
                            <input type="text" name="q"  placeholder="cari nama akun" value="{{ Request::get('q') }}" class="form-control form-control-sm">
                        </div>
                        <div class="" style="padding-right: 10px">
                            <button type="submit" name="find" value="0" class="btn btn-xs btn-outline-dark">Cari</button>
                        </div>
                        <div class="" >
                            <button type="button"class="btn btn-xs btn-outline-danger btn-reset" onclick="this.form.reset();">Reset Filter</button>
                        </div>
                    </div>
                </form>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th witdh="10px" style="width: 20px !important">Aksi</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tipe Pinjaman</th>
                                    <th>Pembayaran Tempo</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Total Bayar</th>
                                    <th>Total Pinjaman</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $item)
                                <tr>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.loan.transaction.submit', [$item->id, 2]) }}" title="Approve">
                                                <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-check"></i></button>
                                            </a>
                                            <a href="{{ route('admin.loan.transaction.submit', [$item->id, 3]) }}" title="Batalkan" style="padding-left: 5px">
                                                <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-close"></i></button>
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ LoanType::label($item->loanListFinancing->loan->type) }}</td>
                                    <td>{{ $item->loanListFinancing->due_date }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>Rp {{ number_format($item->total,0,',','.') }}</td>
                                    <td>Rp {{ number_format($item->loanListFinancing->loan->total_loan,0,',','.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="6">Tidak Ada Data Ditampilkan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="custom-pagination" style="padding-top: 20px"></div>
                    {{ $transactions->links('layouts.pagination') }}
                </div>
                <div class="col-sm-12 col-md-12">
                </div>
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
