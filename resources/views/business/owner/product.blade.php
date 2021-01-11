@extends('layouts.main')

@section('title')
    <title>Produk</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Produk</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Produk Baru</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('product.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="product_category_id">Kategori</label>
                                    <select name="product_category_id" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($category as $row)
                                        <option value="{{ $row->id }}" {{ old('category_id') == $row->id ? 'selected':'' }}>
                                            {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="name">Produk</label>
                                    <input type="text" name="name" class="form-control" required>
                                    <input type="hidden" value="{{ Auth::user()->business_id }}" name="business_id">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="name">Stok</label>
                                    <input type="text" name="stock" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Harga</label>
                                    <input type="text" name="price" class="form-control" required>
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
                            <h4 class="card-title">Daftar Produk</h4>
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
                                            
                                            <th>Produk</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($product as $val)
                                        <tr>
                                            
                                            <td><strong>{{ $val->name }}</strong></td>
                                            <td>{{ $val->stock }}</td>
                                            <td>{{ $val->price }}</td>
                                            <td>
                                                <form action="{{ route('product.destroy', $val->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('product.edit', $val->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Kategori?')">Hapus</button>
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
                            {!! $product->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
