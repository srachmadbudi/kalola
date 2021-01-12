@extends('layouts.main')

@section('title')
    <title>Daftar Transaksi</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('transaction.index') }}">Daftar Transaksi</a></li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Data Pembelian</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transaction.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="supplier_id">Supplier</label>
                                    <select name="supplier_id" class="form-control">
                                        @foreach ($suppliers as $row)
                                        <option value="{{ $row->id }}" {{ old('supplier_id') == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('supplier_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="total">Total Pembelian</label>
                                    <input type="text" name="total" class="form-control" value="{{ old('total') }}" required>
                                    <p class="text-danger">{{ $errors->first('total') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="date">Tanggal Pembelian</label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                        <input placeholder="Masukkan tanggal pembelian" type="text" class="form-control datepicker @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('date') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi Pembelian</label>
                                    <textarea type="description" name="description" class="form-control" rows="5" required></textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Transaksi</h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('transaction.index') }}" method="get">
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
                                            <th>Supplier</th>
                                            <th>Tanggal</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($business->transactions as $row)
                                        <tr>
                                            <td>
                                                <a href="{{ route('transaction.show', $row->id) }}">TRX{{ $row->id ?? '' }}</a>
                                            </td>
                                            <td>
                                                <strong>{{ $row->supplier->name ?? '' }}</strong>
                                            </td>
                                            <td>{{ $row->date->format('d-m-Y') ?? '' }}</td>
                                            <td>Rp {{ number_format($row->total) ?? '' }}</td>
                                            <td>
                                                <form action="{{ route('transaction.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('transaction.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Transaksi?')">Hapus</button>
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

@section('js')
<script type="text/javascript">
$(function(){
    $(".datepicker").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
});

$('select').select2({
    theme: 'bootstrap4'
});
</script>
@endsection