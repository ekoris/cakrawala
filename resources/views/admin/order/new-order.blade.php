@extends('layouts.master')

@php
    use App\Http\Constants\PaymentType;
    use App\Http\Constants\StatusOrder;
@endphp

@push('breadcumb')
    <h4 class="page-title pull-left">Admin</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="">Home</a></li>
        <li><span>Pesanan Baru</span></li>
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
                            <input type="text" name="product"  placeholder="Cari Product" value="{{ Request::get('product') }}" class="form-control form-control-sm">
                        </div>
                        <div class="" style="padding-right: 10px">
                            <input type="text" name="name"  placeholder="Cari Nama Pemesan" value="{{ Request::get('name') }}" class="form-control form-control-sm">
                        </div>
                        <div class="" style="padding-right: 10px">
                            <button type="submit" name="find" value="0" class="btn btn-xs btn-outline-dark">Cari</button>
                        </div>
                        <div class>
                            <button type="button" class="btn btn-xs btn-outline-danger btn-reset" onclick="this.form.reset();">Reset Filter</button>
                        </div>
                    </div>
                </form>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase text-bold" style="font-weight: 700">
                                <tr>
                                    <td>Aksi</td>
                                    <td>Tanggal Order</td>
                                    <td>User Pemesan</td>
                                    <td>Produk</td>
                                    <td>Harga Satuan</td>
                                    <td>Jumlah Pesan</td>
                                    <td>Total Bayar</td>
                                    <td>Metode Pembayaran</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $item)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('admin.order.action', ['status' => StatusOrder::APPROVED, 'id' => $item->id]) }}" title="Approve">
                                                    <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-check"></i></button>
                                                </a>
                                                <a href="{{ route('admin.order.action', ['status' => StatusOrder::CANCELED, 'id' => $item->id]) }}" title="Batalkan" style="padding-left: 5px">
                                                    <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-close"></i></button>
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ optional($item->user)->name }}</td>
                                        <td>{{ optional($item->product)->name }}</td>
                                        <td>{{ number_format(optional($item->product)->price, 0,',','.') }}</td>
                                        <td>{{  $item->qty }}</td>
                                        <td>{{ number_format($item->total_order, 0,',','.') }}</td>
                                        <td>{{ PaymentType::label($item->payment_type) }}</td>
                                        <td>{!! StatusOrder::labelHtml($item->status)  !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">Tidak Ada Data Ditampilkan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="custom-pagination" style="padding-top: 20px">

                    </div>
                    {{ $orders->links('layouts.pagination') }}
                </div>
                <div class="col-sm-12 col-md-12">
                </div>
            </div>
        </div>
    </div>
    <!-- table dark end -->
    
</div>
@endsection
