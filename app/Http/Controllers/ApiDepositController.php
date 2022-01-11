<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Deposits;

class ApiDepositController extends Controller
{
    /**
     * Confirm deposit
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmDeposit(Request $request)
    {
        $deposit = Deposits::find($request->deposit_id);
        $user = $deposit->user;
        $status = $request->status;

        if ($status == 'confirm') {
            $depositAmount = $deposit->amount;
            $oldBalance = $user->balance;
            $newBalance = $oldBalance + $depositAmount;
            $deposit->update(['status' => 'completed']);
            $user->update(['balance' => $newBalance]);
        } else {
            $deposit->update(['status' => 'cancel']);
        }

        return response()->json([
            'success' => true,
            'data' => "Deposit status is updated"
        ]);
    }
}
