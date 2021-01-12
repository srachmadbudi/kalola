@extends('layouts.main')

@section('title')
    <title>Edit Supplier</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Supplier</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Supplier</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('supplier.update', $supplier->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Supplier</label>
                                    <input type="text" name="name" class="form-control" value="{{ $supplier->name }}" required>
                                    <p class="text-danger">{{ $errors->first('product') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input type="text" name="address" class="form-control" value="{{ $supplier->address }}" required>
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Nomor Telepon</label>
                                    <input type="text" name="phone_number" class="form-control" value="{{ $supplier->phone_number }}" required>
                                    <p class="text-danger">{{ $errors->first('phone_number') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm" onclick="return confirm('Ubah Data?')">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection