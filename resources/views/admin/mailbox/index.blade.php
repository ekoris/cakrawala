@extends('layouts.master')

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
                                <input type="search" class="form-control form-control-sm rounded" placeholder="Cari Nama Bank" value="{{ Request::get('q') }}" name="q" aria-label="Search" aria-describedby="search-addon" />
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
                                    <th width="200px">Waktu</th>
                                    <th width="200px">Nama</th>
                                    <th width="200px">Email</th>
                                    <th>Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($repositories as $item)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('admin.mailbox.delete', $item->id) }}" title="Hapus">
                                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                                                </a>
                                            </div>
                                        </td>   
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->value }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="3">Tidak Ada Data Ditampilkan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="custom-pagination" style="padding-top: 20px">

                    </div>
                    {{ $repositories->links('layouts.pagination') }}
                </div>
                <div class="col-sm-12 col-md-12">
                </div>
            </div>
        </div>
    </div>
    <!-- table dark end -->
    
</div>
@endsection
