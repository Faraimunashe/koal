<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDetail;
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
            'price' => ['required_if:status,1'],
            'date' => ['required_if:status,1'],//, 'date', 'after:yesterday'],
            'time' => ['required_if:status,1'],
            'slaughter_room' => ['required_if:status,1']//, 'string']
        ]);

        try{
            if($request->status == 0)
            {
                $booking = Booking::find($request->booking_id);
                $booking->status = $request->status;

                $booking->save();
                return redirect()->back()->with('success', 'successfully rejected booking');
            }else{

                $booking = Booking::find($request->booking_id);
                $booking->status = $request->status;
                $booking->price = $request->price;

                $dt = new BookingDetail();
                $dt->booking_id = $booking->id;
                $dt->date = $request->date;
                $dt->time = $request->time;
                $dt->slaughter_room = $request->slaughter_room;
                $dt->save();


                $booking->save();

                return redirect()->back()->with('success', 'successfully updated booking');
            }
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'booking_id' => ['required', 'integer']
        ]);

        try{
            $booking = Booking::find($request->booking_id);
            $booking->delete();

            return redirect()->back()->with('success', 'successfully deleted a booking');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
