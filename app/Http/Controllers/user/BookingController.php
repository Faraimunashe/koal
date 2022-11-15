<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Cattle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        return view('user.create-booking');
    }

    public function add(Request $request)
    {
        $request->validate([
            'abattoir_id' => ['required', 'integer'],
            'purpose' => ['required']
        ]);

        try{
            $book = new Booking();
            $book->abattoir_id = $request->abattoir_id;
            $book->user_id = Auth::id();
            $book->purpose = $request->purpose;
            $book->save();

            return redirect()->route('user-create-cow', ['book_id'=>$book->id])->with('success', 'may you add cattle to this booking');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function cow(Request $request)
    {
        return view('user.add-cow', [
            'booking' => Booking::find($request->book_id)
        ]);
    }

    public function add_cow(Request $request)
    {
        $request->validate([
            'book_id' => ['required', 'integer'],
            'color' => ['required', 'string'],
            'breed' => ['required', 'string'],
            'gender' => ['required', 'string']
        ]);

        try{
            $cow = new Cattle();
            $cow->booking_id = $request->book_id;
            $cow->color = $request->color;
            $cow->breed = $request->breed;
            $cow->gender = $request->gender;
            $cow->reference = rand(111111,999999);
            if(isset($request->description)){
                $cow->description = $request->description;
            }
            $cow->save();

            return redirect()->back()->with('success', 'successfully added cattle to booking.');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
