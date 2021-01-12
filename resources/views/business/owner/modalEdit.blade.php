@extends('layouts.main')

@section('title')
    <title>Edit Modal</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Modal</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Modal</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('modal.update', $modal->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="source">Sumber Modal</label>
                                    <input type="text" name="source" class="form-control" value="{{ $modal->source }}" required>
                                    <p class="text-danger">{{ $errors->first('source') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <input type="text" name="nominal" class="form-control" value="{{ $modal->nominal}}" required>
                                    <p class="text-danger">{{ $errors->first('nominal') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <input type="text" name="description" class="form-control" value="{{ $modal->description }}" required>
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