<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;

class HelpController extends Controller
{
    public function resetPassIndex()
    {
    	return view('apps.help.resetPassword');
    }

    public function updateProfile()
    {
    	return view('apps.help.updateProfile');
    }
}
