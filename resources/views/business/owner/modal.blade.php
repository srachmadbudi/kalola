@extends('layouts.main')

@section('title')
    <title>Modal</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Modal</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Modal Baru</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('modal.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="source">Sumber Modal</label>
                                    <input type="text" name="source" class="form-control" required>
                                    <input type="hidden" value="{{ Auth::user()->business_id }}" name="business_id">
                                    <p class="text-danger">{{ $errors->first('source') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <input type="text" name="nominal" class="form-control" required>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="district_id">Kecamatan</label>
                                    <select name="district_id" class="form-control">
                                        <option value="">Pilih</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('district_id') }}</p>
                                </div> -->
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <input type="text" name="description" class="form-control" required>
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
                            <h4 class="card-title">Daftar Modal</h4>
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
                                            
                                            <th>Sumber Modal</th>
                                            <th>Nominal</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($modal as $val)
                                        <tr>
                                            <td><strong>{{ $val->source }}</strong></td>
                                            <td>{{ $val->nominal}}</td>
                                            <td>{{ $val->description }}</td>
                                            <td>
                                                <form action="{{ route('modal.destroy', $val->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('modal.edit', $val->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Modal?')">Hapus</button>
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
                            {!! $modal->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
