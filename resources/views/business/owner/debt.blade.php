@extends('layouts.main')

@section('title')
    <title>Hutang</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Hutang</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Hutang Baru</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('debt.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="to">Hutang Kepada</label>
                                    <input type="text" name="to" class="form-control" required>
                                    <input type="hidden" value="{{ Auth::user()->business_id }}" name="business_id">
                                    <p class="text-danger">{{ $errors->first('to') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="due">Tanggal Akhir Pembayaran</label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                        <input placeholder="Masukkan tanggal batas pembayaran terakhir" type="text" class="form-control datepicker @error('date') is-invalid @enderror" name="due" value="{{ old('date') }}" required>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('due') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <input type="text" name="nominal" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi Hutang</label>
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
                            <h4 class="card-title">Daftar Hutang</h4>
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
                                            
                                            <th>Kepada</th>
                                            <th>Batas Akhir Pembayaran</th>
                                            <th>Nominal</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($debt as $val)
                                        <tr>
                                            <td><strong>{{ $val->to }}</strong></td>
                                            <td>{{ $val->due }}</td>
                                            <td>{{ $val->nominal }}</td>
                                            <td>{{ $val->description }}</td>
                                            <td>
                                                <form action="{{ route('debt.destroy', $val->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('debt.edit', $val->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Hutang?')">Hapus</button>
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
                            {!! $debt->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
