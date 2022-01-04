<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Deposits;

class AccountController extends Controller
{
    /**
     * Display a listing of the account settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function deposits()
    {
        $deposits = Auth::user()->deposits;
        return view('front.pages.account.deposits',compact('deposits'));
    }
}
