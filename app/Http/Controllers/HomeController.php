<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use App\Business;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Transaction;
use stdClass;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role_id == 1) {
            return view('admin.dashboard');
        } else {
            $business = Business::where('id', Auth::user()->business_id)->first();

            $day_start = Carbon::today()->format('Y-m-d H:i:s');
            $day_end = Carbon::now()->format('Y-m-d H:i:s');
            $month_start = Carbon::now()->startOfMonth();
            $month_end = Carbon::now()->endOfMonth();
            
            $daily = new stdClass();
            $monthly = new stdClass();

            // Daily Stats
            $sold_daily = Order::where([
                ['business_id', '=', $business->id],
                ['status', '!=', 0],
            ])->whereBetween('updated_at', [$day_start, $day_end])->get();
            $daily->sold = 0;
            foreach ($sold_daily as $f) {
                $daily->sold += OrderDetail::where('order_id', $f->id)->sum('quantity');
            }
            $daily->income = Order::where('business_id', $business->id)->whereBetween('updated_at', [$day_start, $day_end])->sum('total');
            $daily->transaction = Transaction::where('business_id', $business->id)->whereBetween('updated_at', [$day_start, $day_end])->sum('total');
            $daily->active_products = Product::where([
                ['business_id', '=', $business->id],
                ['active', '=', true],
            ])->whereBetween('updated_at', [$day_start, $day_end])->count();
            $daily->on_process = Order::where([
                ['business_id', '=', $business->id],
                ['status', '=', '0'],
            ])->whereBetween('updated_at', [$day_start, $day_end])->count();
            $restock_qty = Product::where([
                ['business_id', '=', $business->id],
                ['stock', '<=', 5],
            ])->count();

            // Monthly Stats
            $sold_monthly = Order::where([
                ['business_id', '=', $business->id],
                ['status', '!=', 0],
            ])->whereBetween('updated_at', [$month_start, $month_end])->get();
            $monthly->sold = 0;
            foreach ($sold_monthly as $f) {
                $monthly->sold += OrderDetail::where('order_id', $f->id)->sum('quantity');
            }
            $monthly->income = Order::where('business_id', $business->id)->whereBetween('updated_at', [$month_start, $month_end])->sum('total');
            $monthly->expense = Transaction::where('business_id', $business->id)->whereBetween('updated_at', [$month_start, $month_end])->sum('total');

            $employee_total = User::where([
                ['business_id', '=', $business->id],
                ['role_id', '!=', 0],
            ])->count();

            if(Auth::user()->role_id == 2) {
                return view('business.owner.dashboard', compact('employee_total', 'restock_qty', 'daily', 'monthly'));
            } else {
                return view('business.employee.dashboard');
            }
        }
    }
}
