<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class MessageController extends Controller
{
    public function index()
    {
        return Inertia::render('Transactions/Index', [
            'filters' => Request::all('search'),
            'transactions' => Auth::user()->account->messages()
                ->orderBy('date')
                ->filter(Request::only('search'))
                ->paginate()
                ->through(function ($transaction) {
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
