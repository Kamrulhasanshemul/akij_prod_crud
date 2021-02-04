<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $products = Product::latest();
        if ($request->exp_date != null) {
            $products = $products->where([['exp_date', '=', Carbon::parse($request->exp_date)]]);
        }

        if ($request->price != null) {
            $products = $products->where([['price', '=', $request->price]]);
        }

        $products = $products->get();
        return view('home', compact('products'));
    }
}
