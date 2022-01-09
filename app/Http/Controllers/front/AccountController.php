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
        $deposits = Auth::user()->deposits();
        $deposits = $deposits->orderByRaw("FIELD(status, \"pending\", \"completed\")")->get();
        return view('front.pages.account.deposits',compact('deposits'));
    }

    /**
     * Process user's deposit.
     *
     * @return \Illuminate\Http\Response
     */
    public function processDeposit(Request $request)
    {
        $request->validate([
            'amount' => 'required'
        ]);
        
        Deposits::create([
            'user_id' => Auth::user()->id,
            'amount' => $request->amount,
            'status' => 'pending'
        ]);

        $deposits = Auth::user()->deposits();
        $deposits = $deposits->orderByRaw("FIELD(status, \"pending\", \"completed\")")->get();
        return redirect()->route('my-gallery.index')
                        ->with('success', 'Deposit is created successfully.');
    }
}
