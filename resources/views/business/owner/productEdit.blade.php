@extends('layouts.main')

@section('title')
    <title>Edit Produk</title>
@endsection

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Produk</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Produk</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('product.update', $product->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <!-- <div class="form-group">
                                    <label for="product_category_id">Kategori</label>
                                    <select name="product_category_id" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($category as $row)
                                        <option value="{{ $row->id }}" {{ $product->category_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div> -->
                                <div class="form-group">
                                    <label for="name">Kategori Produk</label>
                                    <input type="text" name="product_category_id" class="form-control" value="{{ $product->product_category_id }}" disabled>
                                    <p class="text-danger">{{ $errors->first('product_category_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                                    <p class="text-danger">{{ $errors->first('product') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stok</label>
                                    <input type="text" name="stock" class="form-control" value="{{ $product->stock }}" required>
                                    <p class="text-danger">{{ $errors->first('stock') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
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