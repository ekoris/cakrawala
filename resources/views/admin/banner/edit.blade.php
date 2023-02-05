@extends('layouts.master')

@push('breadcumb')
<h4 class="page-title pull-left">Admin</h4>
<ul class="breadcrumbs pull-left">
    <li><a href="#">Home</a></li>
    <li><span>Banner</span></li>
</ul>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 mt-5">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.master-banner.update', $repository->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Nama Banner</label>
                        <div class="col-md-8">
                            <input type="text" placeholder="inputkan Nama Banner" class="form-control" name="name" value="{{ old('name', $repository->name) }}" required autocomplete="name" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">File Banner</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">{{ $repository->image ?? 'Choose file' }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-0">
                        <div class="col-md-4 align-right ">
                        </div>
                        <div class="col-md-8 text-right">
                            <button type="submit" class="btn btn-sm btn-dark">
                                Simpan
                            </button>
                            <a href="{{ route('admin.master-banner.index') }}" class="btn btn-sm btn-outline-dark">
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
