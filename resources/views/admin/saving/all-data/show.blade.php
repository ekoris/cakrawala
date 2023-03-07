@extends('layouts.master')

@php
use App\Http\Constants\SavingType;
use App\Http\Constants\HistoryTransactionStatus;
@endphp

@push('breadcumb')
<h4 class="page-title pull-left">Admin</h4>
<ul class="breadcrumbs pull-left">
    <li><a href="">Home</a></li>
    <li><span>Simpanan</span></li>
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
                                <span>Total Dana Tersimpan</span>
                            </div>
                            <div class="iv-center col-12 text-center">
                                <span style="color: red">Rp {{ number_format($saving->total_balance,0,'.','.') }}</span>
                            </div>
                            <div class="iv-left col-12 text-center">
                                @if ($saving->lastUpdateUser)
                                    <p>Terakhir di update oleh : <br><i><b>{{ $saving->lastUpdateUser->name.' ('.$saving->last_updated_at.')' }}</b></i></p>
                                @endif
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
                                        <td>: {{ $saving->account->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat, Tanggal Lahir</td>
                                        <td>: {{ $saving->account->place_of_birth.', '.$saving->account->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: {{ $saving->account->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>: {{ $saving->account->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>: {{ $saving->account->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td>Account Officer</td>
                                        <td>:  {{ $saving->account->account_officer }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pasar</td>
                                        <td>: {{ $saving->account->market->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>KTP</td>
                                        <td>: <a download="" href="{{ $saving->account->url_identity_attachment }}">Download</a></td>
                                    </tr>
                                    <tr>
                                        <td>Foto Selfie</td>
                                        <td>: <a download="" href="{{ $saving->account->url_self_photo }}">Download</a></td>
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
                <form action="" id="form-filter">
                    <div class="d-md-flex justify-content-md-end" style="padding-bottom: 15px">
                        <div class="" style="padding-right: 10px">
                            <select name="status" class="form-control form-control-sm" id="">
                                <option value="" selected>Pilih Status</option>
                                @foreach (HistoryTransactionStatus::labels() as $key => $item)
                                    <option value="{{ $key }}" {{ Request::get('status') == $key ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="" style="padding-right: 10px">
                            <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control form-control-sm">
                        </div>
                        <div class="" style="padding-right: 10px">
                            <input type="text" name="q"  placeholder="cari nama akun" value="{{ Request::get('q') }}" class="form-control form-control-sm">
                        </div>
                        <div class="" style="padding-right: 10px">
                            <button type="submit" class="btn btn-xs btn-outline-dark">Cari</button>
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
                                    <th>Total Simpanan</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Status</th>
                                    <th>Di Konfirmasi Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($historySaving as $item)
                                <tr>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            @if (in_array($item->status, [1,3]))
                                            <a href="{{ route('admin.saving.all-data.submit', [$saving->user_id, $saving->type, $item->id, 2]) }}" title="Approve">
                                                <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-check"></i></button>
                                            </a>
                                            @endif
                                            @if (!in_array($item->status, [3]))
                                                <a href="{{ route('admin.saving.all-data.submit', [$saving->user_id, $saving->type, $item->id, 3]) }}" title="Batalkan" style="padding-left: 5px">
                                                    <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-close"></i></button>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($item->total,0,',','.') }}</td>
                                    <td>{{ $item->date_transaction }}</td>
                                    <td>{!! HistoryTransactionStatus::labelHtml($item->status) !!}</td>
                                    <td>{{ optional($item->confirmBy)->name ?? '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="5">Tidak Ada Data Ditampilkan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="custom-pagination" style="padding-top: 20px"></div>
                    {{ $historySaving->withQueryString()->links('layouts.pagination') }}
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
