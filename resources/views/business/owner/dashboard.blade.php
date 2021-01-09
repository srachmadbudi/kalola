@extends('layouts.main')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Laporan Hari Ini</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="callout callout-info">
                                        <small class="text-muted">Produk Terjual</small>
                                        <br>
                                        <strong class="h4">{{ $daily->sold ?? ''}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="callout callout-success">
                                        <small class="text-muted">Pemasukan</small>
                                        <br>
                                        <strong class="h4">{{ $daily->income ?? ''}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="callout callout-primary">
                                        <small class="text-muted">Transaksi</small>
                                        <br>
                                        <strong class="h4">{{ $daily->transaction ?? ''}}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="callout callout-info">
                                        <small class="text-muted">Produk</small>
                                        <br>
                                        <strong class="h4">{{ $daily->active_products ?? ''}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-warning">
                                        <small class="text-muted">Pesanan Perlu Diproses</small>
                                        <br>
                                        <strong class="h4">{{ $daily->on_process ?? ''}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-warning">
                                        <small class="text-muted">Produk Perlu Restock</small>
                                        <br>
                                        <strong class="h4">{{ $restock_qty ?? ''}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-warning">
                                        <small class="text-muted">Pegawai</small>
                                        <br>
                                        <strong class="h4">{{ $employee_total ?? ''}}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Laporan Bulan Ini</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="callout callout-info">
                                        <small class="text-muted">Produk Terjual</small>
                                        <br>
                                        <strong class="h4">{{ $monthly->sold ?? ''}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-danger">
                                        <small class="text-muted">Pemasukan</small>
                                        <br>
                                        <strong class="h4">{{ $monthly->income ?? ''}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-primary">
                                        <small class="text-muted">Pengeluaran</small>
                                        <br>
                                        <strong class="h4">{{ $monthly->expense ?? ''}}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
