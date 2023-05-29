@extends('layouts.master')

@push('breadcumb')
    <h4 class="page-title pull-left">Admin</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="">Home</a></li>
        <li><span>Pengguna</span></li>
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
                                <input type="search" name="q" value="{{ Request::get('q') }}" class="form-control form-control-sm rounded" placeholder="Cari User" aria-label="Search" aria-describedby="search-addon" />
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
                                    <th>Username</th>
                                    <th>Nama Panggilan</th>
                                    <th>Email</th>
                                    <th>No Telpon</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($repositories as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->nickname ?? '-' }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone ?? '-' }}</td>
                                        <td>{{ $item->address ?? '-' }}</td>
                                        <td>
                                            @if ($item->is_active == 1)
                                                <span class="badge bg-warning">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Tidak Aktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="5">Tidak Ada Data Ditampilkan</td>
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
