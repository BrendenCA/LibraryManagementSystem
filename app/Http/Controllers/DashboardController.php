<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\User;
use App\Role;
use App\Transaction;
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
        $txns = Auth::User()->transactions->sortByDesc('created_at');
        return view('dashboard.credits')->with('credit', $credit)->with('txns', $txns);
    }

    /**
       * Show the form for editing a role.
       *
       * @return \Illuminate\Http\Response
       */
    public function editRole()
    {
        //Auth::User()->authorizeRoles(['admin']);
        return view('dashboard.editrole');
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request)
    {
        //Auth::User()->authorizeRoles(['admin']);
        $this->validate($request, [
        'email' =>'required',
        'accountType' =>'required',
      ]);
        $user = User::where('email', $request->input('email'))->first();
        $user->role()->associate(Role::where('title', $request->input('accountType'))->first());
        $user->save();
        return redirect('/dashboard')->with('success', 'Role updated');
    }

}
