<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('user.create-booking');
    }

    public function cow($booking_id)
    {
        return view('user.add-cow', []);
    }
}
