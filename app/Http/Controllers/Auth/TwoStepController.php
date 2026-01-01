<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoStepController extends Controller
{
    function showTwoStepForm()
    {
        return view('backend.auth.twostep');
    }
}
