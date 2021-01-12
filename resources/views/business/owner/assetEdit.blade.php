@extends('layouts.main')

@section('title')
    <title>Edit Asset</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Asset</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Asset</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('asset.update', $asset->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipe">Tipe Asset</label>
                                    <input type="text" name="tipe" class="form-control" value="{{ $asset->tipe }}" required>
                                    <p class="text-danger">{{ $errors->first('tipe') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <input type="text" name="nominal" class="form-control" value="{{ $asset->nominal }}" required>
                                    <p class="text-danger">{{ $errors->first('nominal') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Jumlah</label>
                                    <input type="text" name="quantity" class="form-control" value="{{ $asset->quantity }}" required>
                                    <p class="text-danger">{{ $errors->first('quantity') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <input type="textarea" name="description" class="form-control" rows="5" value="{{ $asset->description }}" required>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
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