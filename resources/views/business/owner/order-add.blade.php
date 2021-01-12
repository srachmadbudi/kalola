@extends('layouts.main')

@section('title')
    <title>Daftar Pesanan</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Daftar Pesanan</a></li>
        <li class="breadcrumb-item active">Tambah Pesanan</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-5">
                    <div>
                        <a href="{{ route('order.index') }}">
                            <button class="btn btn-info mb-3"><i class="fa fa-chevron-circle-left"></i> Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <form action="{{ route('order.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Data Pesanan</h4>
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
                                                <input placeholder="Masukkan tanggal pemesanan" type="text" class="form-control datepicker @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>
                                            </div>
                                            <p class="text-danger">{{ $errors->first('date') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="total">Total</label>
                                            <input type="text" name="total" class="form-control" value="{{ old('total') }}" required>
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
                                            <textarea type="items" name="items" class="form-control" rows="5" required></textarea>
                                            <p class="text-danger">{{ $errors->first('items') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Tambah</button>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">Nomor Telepon</label>
                                            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
                                            <p class="text-danger">{{ $errors->first('phone_number') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                                            <p class="text-danger">{{ $errors->first('address') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Provinsi</label>
                                            <select class="form-control" name="province_id" id="province_id" required>
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($provinces as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-danger">{{ $errors->first('province_id') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kabupaten / Kota</label>
                                            <select class="form-control" name="city_id" id="city_id" required>
                                                <option value="">Pilih Kabupaten/Kota</option>
                                            </select>
                                            <p class="text-danger">{{ $errors->first('city_id') }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kecamatan</label>
                                            <select class="form-control" name="district_id" id="district_id" required>
                                                <option value="">Pilih Kecamatan</option>
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
<script type="text/javascript">
    $('#province_id').on('change', function () {
        $.ajax({
            url: "{{ url('/get/cities') }}",
            type: "GET",
            data: {
                province_id: $(this).val()
            },
            success: function (html) {

                $('#city_id').empty()
                $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                $.each(html.data, function (key, item) {
                    $('#city_id').append('<option value="' + item.id + '">' + item.type + ' ' + item.name +
                        '</option>')
                })
            }
        });
    });

    $('#city_id').on('change', function () {
        $.ajax({
            url: "{{ url('/get/districts') }}",
            type: "GET",
            data: {
                city_id: $(this).val()
            },
            success: function (html) {
                $('#district_id').empty()
                $('#district_id').append('<option value="">Pilih Kecamatan</option>')
                $.each(html.data, function (key, item) {
                    $('#district_id').append('<option value="' + item.id + '">' + item
                        .name + '</option>')
                })
            }
        });
    });

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