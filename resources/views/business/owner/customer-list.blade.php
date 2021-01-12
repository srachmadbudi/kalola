@extends('layouts.main')

@section('title')
    <title>Daftar Pelanggan</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('customer.index') }}">Daftar Pelanggan</a></li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('customer.create') }}">
                        <button class="btn btn-success mb-3">Tambah Pelanggan</button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('customer.index') }}" method="get">
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
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Kecamatan</th>
                                            <th>Kota / Kabupaten</th>
                                            <th>Provinsi</th>
                                            <th>Nomor Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($business->consumers as $row)
                                        <tr>
                                            <td>
                                                <a href="{{ route('customer.show', $row->id) }}">CUST{{ $row->id ?? '' }}</a>
                                            </td>
                                            <td>
                                                <strong>{{ $row->name ?? '' }}</strong>
                                            </td>
                                            <td>{{ $row->address ?? '' }}</td>
                                            <td>{{ $row->district->name }}</td>
                                            <td>{{ $row->district->city->name }}</td>
                                            <td>{{ $row->district->city->province->name }}</td>
                                            <td>{{ $row->phone_number }}</td>
                                            <td>
                                                <form action="{{ route('customer.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('customer.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Pelanggan?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
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