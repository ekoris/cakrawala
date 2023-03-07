@extends('layouts.master')

@push('breadcumb')
    <h4 class="page-title pull-left">Admin</h4>
    <ul class="breadcrumbs pull-left">
        <li><a href="">Home</a></li>
        <li><span>Produk</span></li>
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
                            <a class="btn btn-dark ms-2" href="{{ route('admin.product.create') }}">
                                Tambah
                            </a>
                        </div>
                        <div class="">
                            <div class="input-group">
                                <input type="search" class="form-control form-control-sm rounded" placeholder="Cari Nama Produk" value="{{ Request::get('q') }}" name="q" aria-label="Search" aria-describedby="search-addon" />
                                <button type="button" class="btn btn-sm btn-outline-dark">Cari</button>
                              </div>
                        </div>
                    </div>
                </form>
                <div class="break" style="margin-top: 50px"></div>
                <div class="row">
                    @forelse ($products as $item)
                        <div class="col-md-2 col-lg-3">
                            <div class="card mb-4 box-shadow" style="padding-bottom: 30px">
                                <img class="card-img-top" data-src="{{ $item->url_image_thumbnail }}" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;object-fit: scale-down;" src="{{ $item->url_image_thumbnail }}" data-holder-rendered="true">
                                <div class="card-body">
                                    <small><i><b>{{ $item->productCategory->name }}</b></i></small>
                                    <p class="card-text">{{ $item->name }}</p>
                                    <h3>Rp {{ number_format($item->price, 0,',','.') }}</h3>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('admin.product.edit', $item->id) }}" class="btn btn-sm btn-info" style="width: 47%">Edit</a>
                                    <a href="{{ route('admin.product.delete', $item->id) }}" onclick="return confirm('Are You Sure ??')" class="btn btn-sm btn-danger" style="width: 47%">delete</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card text-center">
                            <div class="card-header">
                                Product
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Data Empty</h5>
                                <a href="#" class="btn btn-primary">Find Someelse or create Something</a>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="custom-pagination" style="padding-top: 20px">

                </div>
                {{ $products->links('layouts.pagination') }}
            </div>
        </div>
    </div>
    <!-- table dark end -->
    
</div>
@endsection
