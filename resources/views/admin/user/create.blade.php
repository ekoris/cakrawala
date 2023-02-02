@extends('layouts.master')

@push('breadcumb')
<h4 class="page-title pull-left">Admin</h4>
<ul class="breadcrumbs pull-left">
    <li><a href="index.html">Home</a></li>
    <li><span>Tambah Pengguna</span></li>
</ul>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 mt-5">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Username</label>
                        <div class="col-md-8">
                            <input id="name" type="text" placeholder="inputkan Username" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-8">
                            <input id="email" type="email" placeholder="Inputkan Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                        <div class="col-md-8">
                            <input id="password" type="password" placeholder="Inputkan Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Password Ulang</label>
                        <div class="col-md-8">
                            <input id="password-confirm" type="password" placeholder="Masukkan Password Lagi" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
