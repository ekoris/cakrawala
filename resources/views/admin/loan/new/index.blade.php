@extends('layouts.master')

@php
    use App\Http\Constants\LoanType;
    use App\Http\Constants\TenorType;
@endphp

@push('breadcumb')
    <h4 class="page-title pull-left">Admin</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="index.html">Home</a></li>
        <li><span>Bank</span></li>
    </ul>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">
                <form action="">
                    <div class="d-flex justify-content-end" style="padding-bottom: 15px">
                        <div class="">
                            <div class="input-group">
                                <input type="search" class="form-control form-control-sm rounded" placeholder="Cari Nama User" value="{{ Request::get('q') }}" name="q" aria-label="Search" aria-describedby="search-addon" />
                                <button type="button" class="btn btn-sm btn-outline-dark">Cari</button>
                              </div>
                        </div>
                    </div>
                </form>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <th witdh="150px" style="width: 130px !important">Aksi</th>
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
                                                @if (in_array($item->status, [1,4]))
                                                <a href="{{ route('admin.loan.new.submit', [$item->id, 2]) }}" title="Setujui">
                                                    <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-check"></i></button>
                                                </a>
                                                @endif
                                                @if (!in_array($item->status, [4]))
                                                    <a href="{{ route('admin.loan.new.submit', [$item->id, 3]) }}" title="Batalkan" style="padding-left: 5px">
                                                        <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-close"></i></button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $item->customer->name }}</td>
                                        <td>{!! LoanType::labelHtml($item->type) !!}</td>
                                        <td><b>Rp {{ number_format($item->total_loan,0,'.','.') }}</b></td>
                                        <td>{{ $item->tenors.' '.TenorType::label($item->tenor_type) }}</td>
                                        <td>{{ $item->collateral->name }}</td>
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
