<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use Auth;

class DashboardController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     * Show the bills.
     *
     * @return \Illuminate\Http\Response
     */
    public function credits()
    {
        $credit = Auth::User()->credit;
        return view('dashboard.credits')->with('credit', $credit);
    }

}
