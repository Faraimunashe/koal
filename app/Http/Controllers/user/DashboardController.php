<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Quote;
use Exception;
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
        $request->validate([
            'purpose' => ['required', 'string'],
            'cattle' => ['required', 'integer'],
        ]);

        try{
            $q = new Quote();
            $q->user_id = Auth::id();
            $q->purpose = $request->purpose;
            $q->cattle = $request->cattle;

            $q->save();
            return redirect()->back()->with('success', 'Successfully request for a quote');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
