@php
    $navigation = resolve(\App\Repositories\HomeEloquent::class)->navigation();
@endphp

<li class="">
    <a href="/home">
        <i class="fa fa-dashboard"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="{{ Route::is('admin.product.*') ||  Route::is('admin.category.*') ? 'active' : '' }}">
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-cubes"></i>
        <span>Product</span>
    </a>
    <ul class="collapse">
        <li class="{{ Route::is('admin.product.*') ? 'active' : '' }}">
            <a href="{{ route('admin.product.index') }}">Daftar Product</a>
        </li>
        <li class="{{ Route::is('admin.category.*') ||  Route::is('admin.category.*') ? 'active' : '' }}">
            <a href="{{ route('admin.category.index') }}">Kategori Product</a>
        </li>
    </ul>
</li>
<li class="{{ Route::is('admin.order.*') ? 'active' : '' }}">
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-cart-plus"></i>
        <span>Order Product <span class="badge badge-danger right">{{ $navigation['new_order'] }}</span></span>
    </a>
    <ul class="collapse">
        <li class="{{ Route::is('admin.order.all-order.*') ? 'active' : '' }}">
            <a href="{{ route('admin.order.all-order.index') }}">Semua Orderan</a>
        </li>
        <li class="{{ Route::is('admin.order.new-order.*') ? 'active' : '' }}">
            <a href="{{ route('admin.order.new-order.index') }}">Orderan Baru 
                <span class="badge badge-danger right">{{ $navigation['new_order'] }}</span>
            </a>
        </li>
    </ul>
</li>
<li class="{{ Route::is('admin.saving.*') ? 'active' : '' }}">
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="ti-pie-chart"></i>
        <span>Simpanan 
            <span class="badge badge-danger right">{{ $navigation['new_saving'] }}</span>
        </span>
    </a>
    <ul class="collapse">
        <li class="{{ Route::is('admin.saving.all-data.*') ? 'active' : '' }}">
            <a href="{{ route('admin.saving.all-data.index') }}">Semua Simpanan</a>
        </li>
        <li class="{{ Route::is('admin.saving.transaction-pending.*') ? 'active' : '' }}">
            <a href="{{ route('admin.saving.transaction-pending.index') }}">Simpanan Baru
                <span class="badge badge-danger right">{{ $navigation['new_saving'] }}</span>
            </a>
        </li>
    </ul>
</li>
<li class="{{ Route::is('admin.loan.*') ? 'active' : '' }}">
    <a href="javascript:void(0)" aria-expanded="true">
        <i class="fa fa-money"></i>
        <span>Pinjaman 
            <span class="badge badge-danger right">{{ $navigation['new_loan_transaction'] + $navigation['new_loan'] }}</span>
        </span>
    </a>
    <ul class="collapse">
        <li class="{{ Route::is('admin.loan.all-data.*') ? 'active' : '' }}">
            <a href="{{ route('admin.loan.all-data.index') }}">Semua Pinjaman</a>
        </li>
        <li class="{{ Route::is('admin.loan.new.*') ? 'active' : '' }}">
            <a href="{{ route('admin.loan.new.index') }}">Pengajuan Pinjaman Baru
                <span class="badge badge-danger right">{{ $navigation['new_loan'] }}</span>
            </a>
        </li>
        {{-- <li class="{{ Route::is('admin.loan.transaction.*') ? 'active' : '' }}">
            <a href="{{ route('admin.loan.transaction.index') }}">Pembayaran Pinjaman Baru
                <span class="badge badge-danger right">{{ $navigation['new_loan_transaction'] }}</span>
            </a>
        </li> --}}
    </ul>
</li>
<li class="{{ Route::is('admin.master-market.*') ? 'active' : '' }}">
    <a href="{{ route('admin.master-market.index') }}">
        <i class="fa fa-building"></i>
        <span>Data Pasar</span>
    </a>
</li>
<li class="{{ Route::is('admin.master-bank.*') ? 'active' : '' }}">
    <a href="{{ route('admin.master-bank.index') }}">
        <i class="fa fa-bank"></i>
        <span>Data Akun Bank</span>
    </a>
</li>
<li class="{{ Route::is('admin.master-collateral.*') ? 'active' : '' }}">
    <a href="{{ route('admin.master-collateral.index') }}">
        <i class="fa fa-car"></i>
        <span>Data Akun Agunan</span>
    </a>
</li>
<li class="{{ Route::is('admin.master-banner.*') ? 'active' : '' }}">
    <a href="{{ route('admin.master-banner.index') }}">
        <i class="fa fa-image"></i>
        <span>Data Banner Promo</span>
    </a>
</li>
<li class="{{ Route::is('admin.mailbox.*') ? 'active' : '' }}">
    <a href="{{ route('admin.mailbox.index') }}">
        <i class="fa fa-envelope"></i>
        <span>Kotak Surat</span>
    </a>
</li>
<li class="{{ Route::is('admin.client.*') ? 'active' : '' }}">
    <a href="{{ route('admin.client.index') }}">
        <i class="fa fa-user"></i>
        <span>Client/Customer</span>
    </a>
</li>

<li class="{{ Route::is('admin.officer.*') ? 'active' : '' }}">
    <a href="{{ route('admin.officer.index') }}">
        <i class="fa fa-users"></i>
        <span>Petugas</span>
    </a>
</li>