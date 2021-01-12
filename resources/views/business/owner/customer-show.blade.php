@extends('layouts.main')

@section('title')
<title>Detail Pelanggan</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Daftar Pelanggan</a></li>
        <li class="breadcrumb-item active">Detail Pelanggan</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <a href="{{ route('customer.index') }}">
                            <button class="btn btn-info mb-3"><i class="fa fa-chevron-circle-left"></i> Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Pelanggan</th>
                                            <td>{{ $cust->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ $cust->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $cust->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Telepon</th>
                                            <td>{{ $cust->phone_number }}</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Riwayat Pesanan</h4>
                        </div>
                        <div class="card-body">
                            @foreach($orders as $o)
                            <h5>{{ $o->date->format('d-m-Y') ?? '' }}</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Kategori Produk</th>
                                            <th>Harga Satuan</th>
                                            <th>Kuantitas</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($o->details as $row)
                                        <tr>
                                            <td>{{ $row->product->name }}</td>
                                            <td>{{ $row->product->category->name }}</td>
                                            <td>Rp {{ number_format($row->product->price) }}</td>
                                            <td>{{ $row->quantity }}</td>
                                            <td>Rp {{ number_format($row->product->price * $row->quantity) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script>
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
