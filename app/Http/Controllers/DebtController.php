<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Debt;
use App\Business;

class DebtController extends Controller
{
    public function index()
    {
        $debt = Debt::orderBy('created_at', 'DESC')->paginate(10);
        return view('business.owner.debt', compact('debt'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'to' => 'required|string|max:50',
            'due' => 'required',
            'nominal' => 'required',
            'business_id' => 'required',
            'description' => 'required'
        ]);

        Debt::create($request->except('_token'));
        return redirect(route('debt.index'))->with(['success' => 'Hutang Baru Ditambahkan!']);
    }

    public function edit($id)
    {
        $debt = Debt::find($id);
        return view('business.owner.debtEdit', compact('debt'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'due' => 'required',
            'nominal' => 'required',
            'description' => 'required',
            'to' => 'required|string|max:50' . $id
        ]);

        $debt = Debt::find($id);
        $debt->update([
            'to' => $request->to,
            'due' => $request->due,
            'nominal' => $request->nominal,
            'description' => $request->description
        ]);
        return redirect(route('debt.index'))->with(['success' => 'Data Hutang Diperbaharui!']);
    }

    public function destroy($id)
    {
        $debt = Debt::find($id);
        $debt->delete();
        return redirect(route('debt.index'))->with(['success' => 'Hutang Sudah Dihapus!']);
    }
}
