<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Http\Controllers\Auth\Validator;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AccountController extends Controller
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

	// show the edit form
    public function edit()
    {
    	$user = auth()->user();

    	return view('account', compact('user'));
    }


    // update the account information
    public function update(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|max:255',
            // 'password' => 'min:6|confirmed',
		]);

    	$user = auth()->user();

    	$user->update($request->all());

		flash()->success('Account successfully updated!');
    	
    	
    	return back();
    }
}
