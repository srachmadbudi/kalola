<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('created_at', 'DESC')->paginate(10);
        $category = ProductCategory::orderBy('name', 'DESC')->get();
        return view('business.owner.product', compact('product', 'category'));
    }

    // public function create()
    // {
    //     $product = Product::orderBy('name', 'DESC')->get();
    //     return view('business.owner.product', compact('product'));
    // }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'business_id' => 'required',
            'product_category_id' => 'required'
        ]);

        Product::create($request->except('_token'));
        return redirect(route('product.index'))->with(['success' => 'Produk Baru Ditambahkan!']);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = ProductCategory::orderBy('name', 'DESC')->get();
        return view('business.owner.productEdit', compact('product', 'category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'business_id' => 'required',
            'name' => 'required|string|max:50' . $id,
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'product_category_id' => 'required|exists:product_categories,id'
        ]);

        $product = Product::find($id);
        $product->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'product_category_id' => $request->product_category_id
        ]);
        return redirect(route('product.index'))->with(['success' => 'Data Produk Diperbaharui!']);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect(route('product.index'))->with(['success' => 'ProdukSudah Dihapus!']);
    }
}
