@extends('layouts.master')

@php
use App\Http\Constants\LoanStatus;
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
    <div class="col-lg-3 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="invoice-area">
                    <div class="invoice-head">
                        <div class="row">
                            <div class="iv-left col-12 text-center">
                                <span>Total Dana Pinjaman</span>
                            </div>
                            <div class="iv-center col-12 text-center">
                                <span style="color: red">Rp {{ number_format($loan->total_loan,0,'.','.') }}</span>
                            </div>
                            <div class="col-md-12">
                                <div class="invoice-address">
                                    <hr>
                                    <p class="text-center">Data Transaksi</p>
                                    <table class="table">
                                        <tr>
                                            <td widht="2px">Total Yang Sudah dibayar</td>
                                            <td>: Rp {{ number_format($loan->total_paid, 0, ',','.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Yang Belum dibayar</td>
                                            <td>: Rp {{ number_format($loan->total_unpaid, 0, ',','.') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="invoice-address">
                                <h5 class="text-center">Data Rekening</h5>
                                <table class="table">
                                    <tr>
                                        <td>Nama</td>
                                        <td>: {{ $loan->account->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat, Tanggal Lahir</td>
                                        <td>: {{ $loan->account->place_of_birth.', '.$loan->account->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: {{ $loan->account->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>: {{ $loan->account->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>: {{ $loan->account->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td>Account Officer</td>
                                        <td>:  {{ $loan->account->account_officer }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pasar</td>
                                        <td>: {{ $loan->account->market->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>KTP</td>
                                        <td>: <a download="" href="{{ $loan->account->url_identity_attachment }}">Download</a></td>
                                    </tr>
                                    <tr>
                                        <td>Foto Selfie</td>
                                        <td>: <a download="" href="{{ $loan->account->url_self_photo }}">Download</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h5 class="card-title">Pembayaran Tagihan</h5>
                </div>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Aksi</th>
                                    <th>Pembayaran Tagihan</th>
                                    <th>Total Dibayarkan</th>
                                    <th>Tanggal Dibayar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listLoanTransaction ?? [] as $item)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @if (in_array($item->status, [1,3]))
                                                <a href="{{ route('admin.loan.all-data.submit', [
                                                    $loan->user_id, 
                                                    $loan->type, 
                                                    $item->id, 
                                                    2]) 
                                                }}" title="Approve">
                                                    <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-check"></i></button>
                                                </a>
                                                @endif
                                                @if (!in_array($item->status, [3]))
                                                    <a href="{{ route('admin.loan.all-data.submit', [
                                                        $loan->user_id, 
                                                        $loan->type, 
                                                        $item->id, 
                                                        3]) 
                                                }}" title="Batalkan" style="padding-left: 5px">
                                                        <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-close"></i></button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $item->loanListFinancing->due_date }}</td>
                                        <td>Rp {{ number_format($item->total,0,',','.') }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{!! LoanTransactionStatus::labelHtml($item->status) !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">Tidak ada Data Ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="custom-pagination" style="padding-top: 20px"></div>
                    {{-- {{ $listLoan->withQueryString()->links('layouts.pagination') }} --}}
                </div>
                <div class="col-sm-12 col-md-12">
                </div>
            </div>
            <div class="card-body">
                <div class="card-header">
                    <h5 class="card-title">List Pembayaran Tagihan</h5>
                </div>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Status</th>
                                    <th>Batas Waktu Pembayaran Tagihan</th>
                                    <th>Total Tagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listLoan as $item)
                                    <tr>
                                        <td>{!! LoanStatus::labelHtml($item->status) !!}</td>
                                        <td>{{ $item->due_date }}</td>
                                        <td>Rp {{ number_format($item->total_installment,0,',','.') }}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="5">Tidak Ada Data Ditampilkan</td>
                                </tr>
                                @endforelse
                                <tr>
                                    <td colspan="2" class="text-center"><b>Total Yang belum dibayar</b></td>
                                    <td>Rp {{ number_format($loan->total_unpaid,0,',','.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="custom-pagination" style="padding-top: 20px"></div>
                    {{ $listLoan->withQueryString()->links('layouts.pagination') }}
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
