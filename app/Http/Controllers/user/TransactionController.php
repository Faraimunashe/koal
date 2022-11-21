<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Paynowlog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->paginate(10);

        return view('user.payments', [
            'transactions' => $transactions
        ]);
    }

    public function pay(Request $request)
    {
        $request->validate([
            'booking_id' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'phone' => ['required', 'digits:10', 'starts_with:07']
        ]);

        $booking = Booking::find($request->booking_id);

        $wallet = "ecocash";

        //get all data ready
        $email = "faraimunashe.m11@gmail.com";
        $phone = $request->phone;
        $amount = $request->price;

        /*determine type of wallet*/
        if (strpos($phone, '071') === 0) {
            $wallet = "onemoney";
        }

        $paynow = new \Paynow\Payments\Paynow(
            "11336",
            "1f4b3900-70ee-4e4c-9df9-4a44490833b6",
            route('user-pay'),
            route('user-pay'),
        );

        // Create Payments
        $invoice_name = "Koala-Booking-" . time();
        $payment = $paynow->createPayment($invoice_name, $email);

        $payment->add("Koal Payment", $amount);

        $response = $paynow->sendMobile($payment, $phone, $wallet);


        // Check transaction success
        if ($response->success()) {

            $timeout = 9;
            $count = 0;

            while (true) {
                sleep(3);
                // Get the status of the transaction
                // Get transaction poll URL
                $pollUrl = $response->pollUrl();
                $status = $paynow->pollTransaction($pollUrl);


                //Check if paid
                if ($status->paid()) {
                    // Yay! Transaction was paid for
                    // You can update transaction status here
                    // Then route to a payment successful
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::id();
                    $trans->book_id = $request->booking_id;
                    $trans->reference = $info['paynowreference'];
                    $trans->action = "slaughter";
                    $trans->method = "paynow";
                    $trans->amount = $info['amount'];
                    $trans->status = 1;
                    $trans->save();

                    $booking->payment = true;
                    $booking->save();

                    return redirect()->back()->with('success', 'Succesfully paid your booking');
                }


                $count++;
                if ($count > $timeout) {
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    $trans_status = 2;
                    if($info['status'] != 'sent')
                    {
                        $trans_status = 0;
                    }
                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::id();
                    $trans->book_id = $request->booking_id;
                    $trans->reference = $info['paynowreference'];
                    $trans->action = "slaughter";
                    $trans->method = "paynow";
                    $trans->amount = $info['amount'];
                    $trans->status = $trans_status;
                    $trans->save();

                    return redirect()->back()->with('error', 'Taking too long wait a moment and refresh');
                } //endif
            } //endwhile
        } //endif


        //total fail
        return redirect()->back()->with('error', 'Cannot perform transaction at the moment');

    }
}
