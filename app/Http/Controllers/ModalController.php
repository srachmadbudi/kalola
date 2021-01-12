<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Capital;
use App\Business;

class ModalController extends Controller
{
    public function index()
    {
        $modal = Capital::orderBy('created_at', 'ASC')->paginate(10);
        return view('business.owner.modal', compact('modal'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'source' => 'required|string|max:50',
            'nominal' => 'required',
            // 'district_id' => 'required',
            'business_id' => 'required',
            'description' => 'required'
        ]);

        Capital::create($request->except('_token'));
        return redirect(route('modal.index'))->with(['success' => 'Modal Baru Ditambahkan!']);
    }

    public function edit($id)
    {
        $modal = Capital::find($id);
        return view('business.owner.modalEdit', compact('modal'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'district_id' => 'required',
            'nominal' => 'required',
            'description' => 'required',
            'source' => 'required|string|max:50' . $id
        ]);

        $modal = Capital::find($id);
        $modal->update([
            'source' => $request->source,
            'nominal' => $request->nominal,
            // 'district_id' => $request->district_id,
            'description' => $request->description
        ]);
        return redirect(route('modal.index'))->with(['success' => 'Data ModalDiperbaharui!']);
    }

    public function destroy($id)
    {
        $modal = Capital::find($id);
        $modal->delete();
        return redirect(route('modal.index'))->with(['success' => 'Modal Sudah Dihapus!']);
    }
}
