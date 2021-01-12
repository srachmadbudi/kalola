<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Consumer;
use App\Business;
use App\Role;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\City;
use App\District;
use App\Province;

class OrderController extends Controller
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
        if(Auth::user()->role_id != 1){
            $business = Business::with(['orders.details.district.city.province'])->where('id', Auth::user()->business_id)->first();

            return view('business.owner.order-list', compact('business'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role_id != 1){
            $business = Business::with(['consumers'])->where('id', Auth::user()->business_id)->first();

            $provinces = Province::get();

            return view('business.owner.order-add', compact('business', 'provinces'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role_id != 1) {
            $business = Business::where('id', Auth::user()->business_id);
        
            $this->validate($request, [
                'name' => 'required|string',
                'address' => 'required|string',
                'district_id' => 'required|exists:districts,id',
                'phone_number' => 'required|string'
            ]);

            $cust = Consumer::create([
                'name' => $request->name,
                'address' => $request->address,
                'district_id' => $request->district_id,
                'phone_number' => $request->phone_number,
                'business_id' => $business->id
            ]);

            return redirect(route('order.index'))->with(['success' => 'Pesanan baru berhasil ditambahkan.']);
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
        if(Auth::user()->role_id != 1) {
            $business = Business::where('id', Auth::user()->business_id);
            $cust = Consumer::where('id', $id)->first();
            $orders = Order::with(['details.product.category'])->where('consumer_id', $id)->get();

            return view('business.owner.order-show', compact('cust', 'orders'));
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
        if(Auth::user()->role_id != 1) {
            $business = Business::where('id', Auth::user()->business_id);
            $cust = Consumer::with(['district.city.province'])->where('id', $id)->first();
            $provinces = Province::get();
            $cities = City::get();
            $districts = District::get();
            

            return view('business.owner.order-edit', compact('cust', 'provinces', 'cities', 'districts'));
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
        if(Auth::user()->role_id != 1) {
            $business = Business::where('id', Auth::user()->business_id);
        
            $this->validate($request, [
                'name' => 'required|string',
                'address' => 'required|string',
                'district_id' => 'required|exists:districts,id',
                'phone_number' => 'required|string'
            ]);

            $cust = Consumer::update([
                'name' => $request->name,
                'address' => $request->address,
                'district_id' => $request->district_id,
                'phone_number' => $request->phone_number,
                'business_id' => $business->id
            ]);

            return redirect(route('order.index'))->with(['success' => 'Data pesanan berhasil diperbarui.']);
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
        if (Auth::user()->role_id != 1) {
            $cust = Consumer::find($id);
            $cust->delete();
            return redirect(route('order.index'))->with(['success' => 'Pesanan berhasil dihapus!']);
        }
    }
}
