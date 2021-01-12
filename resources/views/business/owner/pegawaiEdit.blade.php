@extends('layouts.main')

@section('title')
    <title>Edit Pegawai</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Pegawai</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Pegawai</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pegawai.update', $pegawai->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Nama Pegawai</label>
                                    <input type="text" name="name" class="form-control" value="{{ $pegawai->name }}" required>
                                    <p class="text-danger">{{ $errors->first('product') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="stock">Username</label>
                                    <input type="text" name="username" class="form-control" value="{{ $pegawai->username }}" required>
                                    <p class="text-danger">{{ $errors->first('username') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="price">Password</label>
                                    <input type="text" name="password" class="form-control" value="" required>
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
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