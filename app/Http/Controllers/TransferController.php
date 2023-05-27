<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function create()
    {
        return view('transfer.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
            'email' => ['required', 'email'],
        ]);
    
        $amount = $request->input('amount');
        $user = auth()->user();
        $account = $user->account;
    
        if ($account->balance < $amount) {
            return redirect()->back()->with('error', 'Insufficient balance');
        }
    
        $account->balance -= $amount;
        $account->save();
    
        $recipient = User::where('email', $request->input('email'))->first();
    
        if (!$recipient) {
            return redirect()->back()->with('error', 'Recipient does not exist');
        }
    
        $recipientAccount = $recipient->account;
    
        if (!$recipientAccount) {
            // Create a new account for the recipient
            $recipientAccount = new Account();
            $recipientAccount->user_id = $recipient->id;
            $recipientAccount->balance = 0;
        }
    
        $recipientAccount->balance += $amount;
        $recipientAccount->save();
    
        Transaction::create([
            'account_id' => $account->id,
            'recipient_email' => $request->input('email'),
            'balance'=>$account->balance,
            'transaction_type' => 4,
            'amount' => $amount,
        ]);
        Transaction::create([
            'account_id' => $recipientAccount->id,
            'recipient_email'=>auth()->user()->email,
            'balance'=>$recipientAccount->balance,
            'transaction_type' => 3,
            'amount' => $amount,
        ]);
    
        return redirect()->back()->with('success', 'Transfer successful');
    }




}