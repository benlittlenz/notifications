<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Inertia\Inertia;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {

        return Inertia::render('Transactions/Index', [
            'transactions' => Message::all()
        ]);
    }
}
