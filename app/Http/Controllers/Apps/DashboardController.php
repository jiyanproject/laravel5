<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use Hash;
use Auth;

class DashboardController extends Controller
{
    public function changePasswordIndex()
    {
    	return view('apps.pages.changePasswordLogin');
    }

    public function changePasswd(Request $request)
    {
    	$request->validate([
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        
        $user = Auth::user();
        $user->update([
        	'password' => Hash::make($request->input('password')),
        	'is_first_login' => $request->input('is_first_login'),
        ]);
        
        return redirect()->route('userHome.index');
    }
}
