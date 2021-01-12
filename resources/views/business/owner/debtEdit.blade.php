@extends('layouts.main')

@section('title')
    <title>Edit Hutang</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Hutang</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Hutang</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('debt.update', $debt->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="to">Kepada</label>
                                    <input type="text" name="to" class="form-control" value="{{ $debt->to }}" required>
                                    <p class="text-danger">{{ $errors->first('to') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="due">Jumlah</label>
                                    <input type="text" name="due" class="form-control" value="{{ $debt->due }}" required>
                                    <p class="text-danger">{{ $errors->first('due') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <input type="text" name="nominal" class="form-control" value="{{ $debt->nominal }}" required>
                                    <p class="text-danger">{{ $errors->first('nominal') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <input type="textarea" name="description" class="form-control" rows="5" value="{{ $debt->description }}" required>
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