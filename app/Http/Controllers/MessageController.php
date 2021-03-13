<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        return Inertia::render('Transactions/Index', [
            'transactions' => Auth::user()->account->messages()
                ->orderBy('date')
                ->paginate(25)
                ->transform(function ($transaction) {
                    return [
                        'id' => $transaction->id,
                        'date' => $transaction->date,
                        'from' => $transaction->from,
                        'too' => $transaction->too,
                        'message' => $transaction->message,
                        'source' => $transaction->source,
                        'status' => $transaction->status,
                    ];
                }),
        ]);
    }
}
