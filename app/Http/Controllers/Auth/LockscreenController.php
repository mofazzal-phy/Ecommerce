<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LockscreenController extends Controller
{
    function showLockscreenForm()
    {
        return view('backend.auth.lockscreen');
    }
}
