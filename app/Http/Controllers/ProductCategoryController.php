<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ProductCategory;
use App\Business;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $category = ProductCategory::orderBy('created_at', 'DESC')->paginate(10);
        return view('business.owner.category', compact('category'));
        // $business = Business::with(['category'])->where('id', Auth::user()->business_id)->first();
        // $category = ProductCategory::where('business_id', $business->first()->id)->get();
        // return view('business.owner.category', compact('category', 'business'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'business_id' => 'required'
        ]);

        ProductCategory::create($request->except('_token'));
        return redirect(route('category.index'))->with(['success' => 'Kategori Baru Ditambahkan!']);
    }

    public function edit($id)
    {
        $category = ProductCategory::find($id);
        return view('business.owner.categoryEdit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50' . $id
        ]);

        $category = ProductCategory::find($id);
        $category->update([
            'name' => $request->name
        ]);
        return redirect(route('category.index'))->with(['success' => 'Data Kategori Diperbaharui!']);
    }

    public function destroy($id)
    {
        $category = ProductCategory::find($id);
        $category->delete();
        return redirect(route('category.index'))->with(['success' => 'Kategori Sudah Dihapus!']);
    }
}
