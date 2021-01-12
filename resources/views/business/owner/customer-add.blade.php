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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Data Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
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
                                <div class="form-group">
                                    <label for="phone_number">Nomor Telepon</label>
                                    <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
                                    <p class="text-danger">{{ $errors->first('phone_number') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main

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
</script>
@endsection