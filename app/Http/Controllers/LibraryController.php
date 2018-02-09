<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Borrow;
use App\Transaction;
use Auth;

class LibraryController extends Controller
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
     * Show the borrows.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrow = Borrow::where('userId', Auth::User()->id)->whereNull('returned_on')->get();

        return view('library.index')->with('borrow', $borrow);
    }

    /**
     * Borrow specified item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrow($id)
    {
        $borrow = new Borrow;
        $borrow->userId = Auth::User()->id;
        $borrow->catalogId = $id;
        $borrow->save();

        return redirect()->action('LibraryController@index')->with('success', 'Book borrowed');
    }


    /**
     * Return specified item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function return($id)
    {
        $borrow = Borrow::find($id);
        $borrow->returned_on = now();
        $borrow->save();
        $txn = new Transaction;
        $txn->userId = Auth::User()->id;
        $txn->borrowId = $id;
        $duration = $borrow->borrowed_on->diffInDays($borrow->returned_on);
        if($duration == 0)
          $duration = 1;
        $txn->credit_change = -$borrow->catalog->price * $duration;
        $txn->save();
        Auth::User()->credit += $txn->credit_change;
        Auth::User()->save();
        return redirect()->action('LibraryController@index')->with('success', 'Book returned');
    }
}
