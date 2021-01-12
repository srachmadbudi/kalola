@extends('layouts.main')

@section('title')
<title>Edit Pesanan</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Daftar Pesanan</a></li>
        <li class="breadcrumb-item active">Edit Pesanan</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <a href="{{ route('order.index') }}">
                            <button class="btn btn-info mb-3"><i class="fa fa-chevron-circle-left"></i> Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <form action="{{ route('order.update', $order->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Update Data Pesanan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date">Tanggal Pesanan</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                                <input placeholder="Masukkan tanggal pemesanan" type="text" class="form-control datepicker @error('date') is-invalid @enderror" name="date" value="{{ $order->date }}" required>
                                            </div>
                                            <p class="text-danger">{{ $errors->first('date') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="total">Total</label>
                                            <input type="text" name="total" class="form-control" value="{{ $order->total }}" required>
                                            <p class="text-danger">{{ $errors->first('total') }}</p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="">Kurir</label>
                                            <select class="form-control" name="shipping_provider" id="shipping_provider" required>
                                                <option value="JNT">JNT</option>
                                                <option value="JNE">JNE</option>
                                                <option value="SiCepat">SiCepat</option>
                                            </select>
                                            <p class="text-danger">{{ $errors->first('shipping_provider') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="0">Inisial</option>
                                                <option value="1">Dibayar</option>
                                                <option value="2">Dikirim</option>
                                                <option value="3">Diterima</option>
                                            </select>
                                            <p class="text-danger">{{ $errors->first('status') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="items">Keterangan Pesanan</label>
                                            <textarea type="items" name="items" class="form-control" rows="5" value="{{ $order->items }}" required></textarea>
                                            <p class="text-danger">{{ $errors->first('items') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Tambah</button>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" name="name" class="form-control" value="{{ $order->consumer->name }}" required>
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">Nomor Telepon</label>
                                            <input type="text" name="phone_number" class="form-control" value="{{ $order->consumer->phone_number }}" required>
                                            <p class="text-danger">{{ $errors->first('phone_number') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <input type="text" name="address" class="form-control" value="{{ $order->consumer->address }}" required>
                                            <p class="text-danger">{{ $errors->first('address') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Provinsi</label>
                                            <select class="form-control" name="province_id" id="province_id" required>
                                                @foreach ($provinces as $row)
                                                <option value="{{ $row->id }}" {{ $order->consumer->district->city->province->id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger">{{ $errors->first('province_id') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kabupaten / Kota</label>
                                            <select class="form-control" name="city_id" id="city_id" required>
                                                @foreach ($cities as $row)
                                                <option value="{{ $row->id }}" {{ $order->consumer->district->city->id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger">{{ $errors->first('city_id') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kecamatan</label>
                                            <select class="form-control" name="district_id" id="district_id" required>
                                                @foreach ($cities as $row)
                                                <option value="{{ $row->id }}" {{ $order->consumer->district->city->id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger">{{ $errors->first('district_id') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
