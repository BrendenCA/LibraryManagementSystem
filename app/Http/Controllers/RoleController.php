<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class RoleController extends Controller
{
    /**
     * Show the form for editing a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('role.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
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
