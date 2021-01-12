<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use App\TransactionDetail;
use App\User;
use App\Business;
use App\Supplier;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id == 2){
            $business = Business::with(['transactions.details', 'transactions.supplier'])->where('id', Auth::user()->business_id)->first();
            $suppliers = Supplier::where('business_id', $business->first()->id)->get();

            if (request()->q != '') {
                $business = $business->transactions->where('name', 'LIKE', '%' . request()->q . '%');
            }
    
            return view('business.owner.transaction-list', compact('business', 'suppliers'));
        }
        
        return view('business.error-404');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role_id == 2) {
            $business = Business::where('id', Auth::user()->business_id);
        
            $this->validate($request, [
                'supplier_id' => 'required|exists:suppliers,id',
                'total' => 'required',
                'date' => 'required|date',
                'description' => 'required'
            ]);

            $trx = Transaction::create([
                'total' => $request->total,
                'date' => Carbon::create($request->date)->toDateTimeString(),
                'description' => $request->description,
                'business_id' => Auth::user()->business_id,
                'supplier_id' => $request->supplier_id
            ]);

            return redirect(route('transaction.index'))->with(['success' => 'Transaksi baru berhasil ditambahkan.']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->role_id == 2) {
            $business = Business::where('id', Auth::user()->business_id);

            $suppliers = Supplier::where('business_id', $business->first()->id)->get();
            $trx = Transaction::with(['supplier', 'details'])->where('id', $id)->first();
            
            return view('business.owner.transaction-show', compact('suppliers', 'trx'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role_id == 2) {
            $business = Business::where('id', Auth::user()->business_id);

            $suppliers = Supplier::where('business_id', $business->first()->id)->get();
            $trx = Transaction::with(['details'])->where('id', $id)->first();

            return view('business.owner.transaction-edit', compact('suppliers', 'trx'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->role_id == 2) {
            $business = Business::where('id', Auth::user()->business_id);
        
            $this->validate($request, [
                'supplier_id' => 'required|existing:suppliers,id',
                'total' => 'required|double',
                'date' => 'required|date',
                'description' => 'required|text'
            ]);

            $trx = Transaction::update([
                'total' => $request->total,
                'date' => $request->date,
                'description' => $request->description,
                'business_id' => $business->id,
                'supplier_id' => $request->supplier_id
            ]);

            return redirect(route('transaction.index'))->with(['success' => 'Transaksi berhasil diperbarui.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role_id == 2) {
            $trx = Transaction::find($id);
            $trx->delete();
            return redirect(route('transaction.index'))->with(['success' => 'Transaksi berhasil dihapus!']);
        }
    }
}
