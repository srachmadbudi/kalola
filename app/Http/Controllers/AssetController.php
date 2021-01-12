<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Asset;
use App\Business;

class AssetController extends Controller
{
    public function index()
    {
        $asset = Asset::orderBy('created_at', 'DESC')->paginate(10);
        return view('business.owner.asset', compact('asset'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tipe' => 'required|string|max:50',
            'quantity' => 'required',
            'nominal' => 'required',
            'business_id' => 'required',
            'description' => 'required'
        ]);

        Asset::create($request->except('_token'));
        return redirect(route('asset.index'))->with(['success' => 'Asset Baru Ditambahkan!']);
    }

    public function edit($id)
    {
        $asset = Asset::find($id);
        return view('business.owner.assetEdit', compact('asset'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'quantity' => 'required',
            'nominal' => 'required',
            'description' => 'required',
            'tipe' => 'required|string|max:50' . $id
        ]);

        $asset = Asset::find($id);
        $asset->update([
            'tipe' => $request->tipe,
            'quantity' => $request->quantity,
            'nominal' => $request->nominal,
            'description' => $request->description
        ]);
        return redirect(route('asset.index'))->with(['success' => 'Data Asset Diperbaharui!']);
    }

    public function destroy($id)
    {
        $asset = Asset::find($id);
        $asset->delete();
        return redirect(route('asset.index'))->with(['success' => 'Asset Sudah Dihapus!']);
    }
}
