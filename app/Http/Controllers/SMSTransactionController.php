<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SMSTransactionController extends Controller
{
    public function index()
    {
        return Inertia::render('Organizations/Index', [
            'transactions' => Auth::user()->account->sms_transactions()
                ->orderBy('date')
                ->paginate()
        ]);
    }
}
