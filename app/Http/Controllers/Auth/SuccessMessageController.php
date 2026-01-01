<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuccessMessageController extends Controller
{
    function showSuccessMessageForm()
    {
        return view('backend.auth.successmessage');
    }
}
