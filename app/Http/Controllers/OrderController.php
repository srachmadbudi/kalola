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
            $business = Business::where('id', Auth::user()->business_id)->first();

            $orders = Order::with(['details', 'district.city.province'])->where('business_id', $business->id)->get();

            return view('business.owner.order-list', compact('business', 'orders'));
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
            $business = Business::where('id', Auth::user()->business_id)->first();

            $products = Product::with(['category'])->where('business_id', $business->id)->get();

            $provinces = Province::get();

            return view('business.owner.order-add', compact('products', 'provinces'));
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
                'date' => 'required|date',
                'total' => 'required',
                'name' => 'required|string',
                'address' => 'required|string',
                'district_id' => 'required|exists:districts,id',
                'phone_number' => 'required|string',
                'status' => 'required|boolean',
                'shipping_provider' => 'required|string',
                'items' => 'required'
            ]);
            
            $cust = Consumer::create([
                'name' => $request->name,
                'address' => $request->address,
                'district_id' => $request->district_id,
                'phone_number' => $request->phone_number,
                'business_id' => $business->id
            ]);

            $order = Order::create([
                'status' => $request->status,
                'total' => $request->total,
                'date' => $request->date,
                'shipping_provider' => $request->date,
                'items' => $request->items,
                'business_id' => Auth::user()->business_id,
                'consumer_id' => $customer->id,
                'employee_id' => Auth::user()->id
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
            $order = Order::with(['consumer', 'details.product.category'])->where('id', $id)->first();

            return view('business.owner.order-show', compact('cust', 'order'));
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
            $order = Order::with(['details', 'consumer.district.city.province'])->where('id', $id)->first();
            $provinces = Province::get();
            $cities = City::get();
            $districts = District::get();
            

            return view('business.owner.order-edit', compact('order', 'provinces', 'cities', 'districts'));
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
