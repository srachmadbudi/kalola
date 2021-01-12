@extends('layouts.main')

@section('title')
<title>Edit Pelanggan</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Daftar Pelanggan</a></li>
        <li class="breadcrumb-item active">Edit Pelanggan</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="col-md-6">
                <div>
                    <a href="{{ route('customer.index') }}">
                        <button class="btn btn-info mb-3"><i class="fa fa-chevron-circle-left"></i> Kembali</button>
                    </a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Data Pelanggan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customer.update', $cust->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{ $cust->name }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input type="text" name="address" class="form-control" value="{{ $cust->address }}" required>
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Provinsi</label>
                                    <select class="form-control" name="province_id" id="province_id" required>
                                        @foreach ($provinces as $row)
                                        <option value="{{ $row->id }}" {{ $cust->district->city->province->id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('province_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Kabupaten / Kota</label>
                                    <select class="form-control" name="city_id" id="city_id" required>
                                        @foreach ($cities as $row)
                                        <option value="{{ $row->id }}" {{ $cust->district->city->id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('city_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Kecamatan</label>
                                    <select class="form-control" name="district_id" id="district_id" required>
                                    @foreach ($cities as $row)
                                                <option value="{{ $row->id }}" {{ $cust->district->city->id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                                @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('district_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Nomor Telepon</label>
                                    <input type="text" name="phone_number" class="form-control" value="{{ $cust->phone_number }}" required>
                                    <p class="text-danger">{{ $errors->first('phone_number') }}</p>
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
