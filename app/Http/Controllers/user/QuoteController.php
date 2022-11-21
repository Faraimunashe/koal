<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function index()
    {
        return view('user.quote', [
            'quotations' => Quote::where('user_id', Auth::id())->latest()->paginate(10)
        ]);
    }
}
