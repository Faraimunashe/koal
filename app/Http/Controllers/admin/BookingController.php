<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->paginate(10);

        return view('admin.bookings', [
            'bookings' => $bookings
        ]);
    }

    public function reply(Request $request)
    {
        $request->validate([
            'booking_id' => ['required', 'integer'],
            'status' => ['required', 'integer'],
            'price' => ['required', 'numeric']
        ]);

        try{
            $booking = Booking::find($request->booking_id);
            $booking->status = $request->status;
            $booking->price = $request->price;
            $booking->save();

            return redirect()->back()->with('success', 'successfully updated booking');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
