@extends('layouts.main')

@section('title')
    <title>Asset</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Asset</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Asset Baru</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('asset.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tipe">Tipe</label>
                                    <input type="text" name="tipe" class="form-control" required>
                                    <input type="hidden" value="{{ Auth::user()->business_id }}" name="business_id">
                                    <p class="text-danger">{{ $errors->first('tipe') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <input type="text" name="nominal" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Jumlah</label>
                                    <input type="text" name="quantity" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi Asset</label>
                                    <textarea type="description" name="description" class="form-control" rows="5" required></textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Asset</h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered text-center">
                                    <thead>
                                        <tr>
                                            
                                            <th>Tipe</th>
                                            <th>Nominal</th>
                                            <th>Jumlah</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($asset as $val)
                                        <tr>
                                            <td><strong>{{ $val->tipe }}</strong></td>
                                            <td>{{ $val->nominal }}</td>
                                            <td>{{ $val->quantity }}</td>
                                            <td>{{ $val->description }}</td>
                                            <td>
                                                <form action="{{ route('asset.destroy', $val->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('asset.edit', $val->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Asset?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {!! $asset->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
