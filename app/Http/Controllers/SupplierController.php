<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;
use App\Business;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::orderBy('created_at', 'ASC')->paginate(10);
        return view('business.owner.supplier', compact('supplier'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'address' => 'required',
            // 'district_id' => 'required',
            'business_id' => 'required',
            'phone_number' => 'required'
        ]);

        Supplier::create($request->except('_token'));
        return redirect(route('supplier.index'))->with(['success' => 'Supplier Baru Ditambahkan!']);
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('business.owner.supplierEdit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'district_id' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'name' => 'required|string|max:50' . $id
        ]);

        $supplier = Supplier::find($id);
        $supplier->update([
            'name' => $request->name,
            'address' => $request->address,
            // 'district_id' => $request->district_id,
            'phone_number' => $request->phone_number
        ]);
        return redirect(route('supplier.index'))->with(['success' => 'Data Supplier Diperbaharui!']);
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect(route('supplier.index'))->with(['success' => 'Supplier Sudah Dihapus!']);
    }
}
