@extends('layouts.main')

@section('title')
<title>Edit Transaksi</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Daftar Transaksi</a></li>
        <li class="breadcrumb-item active">Edit Transaksi</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="col-md-6">
                <div>
                    <a href="{{ route('transaction.index') }}">
                        <button class="btn btn-info mb-3"><i class="fa fa-chevron-circle-left"></i> Kembali</button>
                    </a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Data Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transaction.update', $trx->id) }}" method="post" enctype="multipart/form-data">
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
                                    <input type="text" name="total" class="form-control" value="{{ $trx->total }}" required>
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
                                        <input placeholder="Masukkan tanggal pembelian" type="text" class="form-control datepicker @error('date') is-invalid @enderror" name="date" value="{{ $trx->date->format('d-m-Y') }}" required>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('date') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi Pembelian</label>
                                    <textarea type="description" name="description" class="form-control" rows="5" value="{{ $trx->description }}" required></textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Update</button>
                                </div>
                            </div>
                        </form>
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
