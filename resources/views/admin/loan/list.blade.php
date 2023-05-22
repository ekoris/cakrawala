@extends('layouts.master')

@php
    use App\Http\Constants\LoanMainStatus;
    use App\Http\Constants\LoanType;
    use App\Http\Constants\TenorType;
@endphp

@push('breadcumb')
    <h4 class="page-title pull-left">Admin</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="">Home</a></li>
        <li><span>Pinjaman</span></li>
    </ul>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <form action="">
                <div class="d-flex justify-content-end" style="padding-bottom: 15px">
                    <div class="">
                        <a href="{{ route('admin.loan.all-data.index') }}" class="btn btn-dark">Kembali</a>
                    </div>
                </div>
            </form>
            <div class="card-body">
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <th witdh="150px" style="width: 130px !important">Aksi</th>
                                    <th>Status Pinjaman</th>
                                    <th>Nama Akun</th>
                                    <th>Tipe Pinjaman</th>
                                    <th>Jumlah Pinjaman</th>
                                    <th>Tenor</th>
                                    <th>Agunan</th>
                                    <th>Nama Rekening</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>NIK</th>
                                    <th>Alamat</th>
                                    <th>Account Officer</th>
                                    <th>Pasar</th>
                                    <th>Data Pendukung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($loans as $item)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('admin.loan.all-data.show', $item->id) }}" title="Detail">
                                                    <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></button>
                                                </a>
                                            </div>
                                        </td>
                                        <td>{!! LoanMainStatus::labelHtml($item->status) !!}</td>
                                        <td>{{ $item->customer->name }}</td>
                                        <td><b>{{ LoanType::label($item->type) }}</b></td>
                                        <td><b>Rp {{ number_format($item->total_loan,0,'.','.') }}</b></td>
                                        <td>{{ $item->tenors.' '.TenorType::label($item->tenor_type) }}</td>
                                        <td>{{ optional($item->collateral)->name ?? '-' }}</td>
                                        <td>{{ $item->account->name }}</td>
                                        <td>{{ $item->account->place_of_birth.', '.$item->account->date_of_birth }}</td>
                                        <td>{{ $item->account->nik }}</td>
                                        <td>{{ $item->account->address }}</td>
                                        <td>{{ $item->account->account_officer }}</td>
                                        <td>{{ $item->account->market->name }}</td>
                                        <td>
                                            <a download="" href="{{ $item->account->url_identity_attachment }}">Ktp</a>
                                                <br>
                                            <a download="" href="{{ $item->account->url_self_photo }}">Foto Selfi</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="2">Tidak Ada Data Ditampilkan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="custom-pagination" style="padding-top: 20px"></div>
                    {{ $loans->links('layouts.pagination') }}
                </div>
                <div class="col-sm-12 col-md-12">
                </div>
            </div>
        </div>
    </div>
    <!-- table dark end -->
</div>
@endsection
