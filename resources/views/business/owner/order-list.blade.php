@extends('layouts.main')

@section('title')
    <title>Daftar Pesanan</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('order.index') }}">Daftar Pesanan</a></li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('order.create') }}">
                        <button class="btn btn-success mb-3">Tambah Pesanan</button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Pesanan</h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('order.index') }}" method="get">
                                <div class="input-group mb-3 col-md-3 float-right">
                                    <input type="text" name="q" class="form-control" placeholder="Cari..." value="{{ request()->q }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button">Cari</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Pemesan</th>
                                            <th>Alamat Tujuan</th>
                                            <th>Nomor Telepon</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Kurir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $row)
                                        <tr>
                                            <td>
                                                <a href="{{ route('order.show', $row->id) }}">ORD{{ $row->id ?? '' }}</a>
                                            </td>
                                            <td>
                                                <strong>{{ $row->consumer->name ?? '' }}</strong>
                                            </td>
                                            <td>{{ $row->consumer->address ?? '' }}</td>
                                            <td>{{ $row->consumer->phone_number ?? '' }}</td>
                                            <td>{{ $row->date }}</td>
                                            <td>{{ $row->status }}</td>
                                            <td>{{ $row->shipping_provider }}</td>
                                            <td>
                                                <form action="{{ route('order.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('order.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Pesanan?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection