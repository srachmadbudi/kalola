@extends('layouts.main')

@section('title')
<title>Detail Transaksi</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('transaction.list') }}">Daftar Transaksi</a></li>
        <li class="breadcrumb-item active">Detail Transaksi</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <a href="{{ route('transaction.list') }}">
                            <button class="btn btn-default mb-3"><i class="fa fa-chevron-circle-left"></i> Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi</th>
                                            <td>{{ $trx->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Supplier</th>
                                            <td>{{ $trx->supplier->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Pembelian</th>
                                            <td>{{ $trx->total }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Pembelian</th>
                                            <td>{{ $trx->date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td>{{ $trx->description }}</td>
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
                            <h4 class="card-title">Item yang Dibeli</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Harga Satuan</th>
                                            <th>Kuantitas</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($trx->details as $row)
                                        <tr>
                                            <td>{{ $row->item_name }}</td>
                                            <td>Rp {{ number_format($row->price) }}</td>
                                            <td>{{ $row->quantity }}</td>
                                            <td>Rp {{ number_format($row->price * $row->quantity) }}</td>
                                        </tr>
                                        @endforeach
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
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
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

    const compress = new Compress()
    const upload = document.getElementById('image')

    upload.addEventListener('change', (e) => {
        const files = [...e.target.files]
        compress.compress(files, {
            quality: 0.5
        }).then((images) => {
            console.log(images)
        })
    })

</script>
@endsection
