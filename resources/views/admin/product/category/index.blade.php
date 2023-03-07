@extends('layouts.master')

@push('breadcumb')
    <h4 class="page-title pull-left">Admin</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="">Home</a></li>
        <li><span>Kategori Produk</span></li>
    </ul>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">
                <form action="">
                    <div class="d-flex justify-content-end" style="padding-bottom: 15px">
                        <div class="mr-auto ">
                            <a class="btn btn-dark ms-2" href="{{ route('admin.category.create') }}">
                                Tambah
                            </a>
                        </div>
                    </div>
                </form>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <th witdh="10px" style="width: 130px !important">Aksi</th>
                                    <th>Nama Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($repositories as $item)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('admin.category.edit', $item->id) }}" title="Edit">
                                                    <button type="button" class="btn btn-sm btn-outline-info"><i class="fa fa-pencil"></i></button>
                                                </a>
                                                {{-- <a href="{{ route('admin.category.delete', $item->id) }}" title="Hapus">
                                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                                                </a> --}}
                                            </div>
                                        </td>   
                                        <td>{{ $item->name }}</td>
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
