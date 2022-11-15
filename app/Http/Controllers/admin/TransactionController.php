<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->paginate(10);
        return view('admin.transactions', [
            'transactions' => $transactions
        ]);
    }

    public function report()
    {
        $transactions = Transaction::latest()->get();

        $pdf = PDF::loadView('pdf.transaction', ['transations' => $transactions]);



        return $pdf->download('transaction-report'.now().'.pdf');
    }
}
