@extends('layouts.master')

@php
use App\Http\Constants\SavingType;
use App\Http\Constants\HistoryTransactionStatus;
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
                                <option value="" selected>Pilih Simpanan</option>
                                @foreach (SavingType::labels() as $key => $item)
                                <option value="{{ $key }}" {{ Request::get('type') == $key ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="" style="padding-right: 10px">
                            <select name="status" class="form-control form-control-sm" id="">
                                <option value="" selected>Pilih Pasar</option>
                            </select>
                        </div>
                        <div class="" style="padding-right: 10px">
                            <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control form-control-sm">
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
                                    <th>Nama Akun</th>
                                    <th>Nama Pasar</th>
                                    <th>Tipe Simpanan</th>
                                    <th>Total Simpanan</th>
                                    <th>Tanggal Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $item)
                                <tr>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.saving.transaction-pending.submit', [$item->id, 2]) }}" title="Approve">
                                                <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-check"></i></button>
                                            </a>
                                            <a href="{{ route('admin.saving.transaction-pending.submit', [$item->id, 3]) }}" title="Batalkan" style="padding-left: 5px">
                                                <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-close"></i></button>
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $item->savingDeposit->user->name }}</td>
                                    <td>{{ $item->savingDeposit->account->market->name }}</td>
                                    <td>Rp {{ number_format($item->total,0,',','.') }}</td>
                                    <td>{!! SavingType::labelHtml($item->savingDeposit->type) !!}</td>
                                    <td>{{ $item->date_transaction }}</td>
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
