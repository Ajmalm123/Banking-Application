<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function create()
    {
        return view('withdraw.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
        ]);

        $amount = $request->input('amount');

        // Get the current user.
        $user = auth()->user();

        // Get or create the user's account.
        $account = $user->account ?? Account::create([
            'user_id' => $user->id,
            'balance' => 0,
        ]);

        $account->balance -= $amount;
        $account->save();

        // Create a transaction record.
        Transaction::create([
            'account_id' => $account->id,
            'transaction_type' => 2,
            'balance'=>$account->balance,
            'amount' => $amount,
        ]);

        return redirect()->back()->with('success', 'Withdraw successful');
    }

}