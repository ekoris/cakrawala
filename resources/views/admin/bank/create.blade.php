@extends('layouts.master')

@push('breadcumb')
<h4 class="page-title pull-left">Admin</h4>
<ul class="breadcrumbs pull-left">
    <li><a href="">Home</a></li>
    <li><span>Bank</span></li>
</ul>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 mt-5">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.master-bank.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Nama Bank</label>
                        <div class="col-md-8">
                            <input type="text" placeholder="inputkan Nama Bank" class="form-control" name="name" value="" required autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-md-4 col-form-label text-md-end">No Rekening</label>
                        <div class="col-md-8">
                            <input type="text" placeholder="inputkan Nomor Rekenng" required class="form-control" name="number">
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-4 align-right ">
                        </div>
                        <div class="col-md-8 text-right">
                            <button type="submit" class="btn btn-sm btn-dark">
                                Simpan
                            </button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-outline-dark">
                                Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- table dark end -->
    
</div>
@endsection
