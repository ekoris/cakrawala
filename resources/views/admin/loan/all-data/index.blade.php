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
                                    <th witdh="10px" style="width: 130px !important">Aksi</th>
                                    <th>Nama Akun</th>
                                    <th>Pinjaman {{ LoanType::label(1) }}</th>
                                    <th>Pinjaman {{ LoanType::label(2) }}</th>
                                    <th>Pinjaman {{ LoanType::label(3) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($loans as $item)
                                    <tr>
                                        <td>
                                            <select name="" id="" class="form-control form-control-sm form-control-block" onchange="location = this.value;">
                                                <option value="" selected disabled>Pilih Detail</option>
                                                <option value="{{ route('admin.loan.all-data.show', [$item->id, 1]) }}">Detail {{ LoanType::label(1) }}</option>
                                                <option value="{{ route('admin.loan.all-data.show', [$item->id, 2]) }}">Detail {{ LoanType::label(2) }}</option>
                                                <option value="{{ route('admin.loan.all-data.show', [$item->id, 3]) }}">Detail {{ LoanType::label(3) }}</option>
                                            </select>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if ($item->pinjaman_1)
                                                <span class="fa fa-check"></span>
                                            @else
                                                <span class="fa fa-minus"></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->pinjaman_2)
                                                <span class="fa fa-check"></span>
                                            @else
                                                <span class="fa fa-minus"></span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->pinjaman_3)
                                                <span class="fa fa-check"></span>
                                            @else
                                                <span class="fa fa-minus"></span>
                                            @endif
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
