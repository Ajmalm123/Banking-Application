<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function create()
    {
        return view('deposit.index');
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

        $account->balance += $amount;
        $account->save();

        // Create a transaction record.
        Transaction::create([
            'account_id' => $account->id,
            'transaction_type' => 1,
            'balance'=>$account->balance,
            // Deposit
            'amount' => $amount,
        ]);

        return redirect()->back()->with('success', 'Deposit successful');
    }

}