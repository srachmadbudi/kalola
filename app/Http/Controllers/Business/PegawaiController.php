<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Business;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = User::orderBy('created_at', 'DESC')->where('role_id', 3)->paginate(10);
        return view('business.owner.pegawai', compact('pegawai'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'username' => 'required',
            'password' => 'required',
            'business_id' => 'required',
            'role_id' => 'required'
        ]);

        User::create($request->except('_token'));
        return redirect(route('pegawai.index'))->with(['success' => 'Pegawai Baru Ditambahkan!']);
    }

    public function edit($id)
    {
        $pegawai = User::find($id);
        return view('business.owner.pegawaiEdit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'name' => 'required|string|max:50' . $id
        ]);

        $pegawai = User::find($id);
        $pegawai->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password
        ]);
        return redirect(route('pegawai.index'))->with(['success' => 'Data Pegawai Diperbaharui!']);
    }

    public function destroy($id)
    {
        $pegawai = User::find($id);
        $pegawai->delete();
        return redirect(route('pegawai.index'))->with(['success' => 'Pegawai Sudah Dihapus!']);
    }
}
