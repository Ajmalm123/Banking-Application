<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatementController extends Controller
{
    public function index(){
        $user = Auth::user();
        $transactions = Transaction::whereHas('account', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('account')->orderBy('created_at', 'desc')->paginate(5);
    
        return view('statement.index', compact('transactions'));
    }
}
