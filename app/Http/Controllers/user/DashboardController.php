<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->paginate(10);
        return view('user.dashboard', [
            'bookings' => $bookings
        ]);
    }

    public function quote(Request $request)
    {

    }
}
