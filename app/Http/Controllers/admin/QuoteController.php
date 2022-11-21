<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Exception;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        return view('admin.quotation', [
            'quotations' => Quote::where('unit', null)->latest()->paginate(10)
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'quote_id' => ['required', 'integer'],
            'unit' => ['required', 'numeric'],
            'total' => ['required', 'numeric']
        ]);

        try{
            $quote = Quote::find($request->quote_id);
            $quote->unit = $request->unit;
            $quote->total = $request->total;
            $quote->save();

            return redirect()->back()->with('success', 'successfully added quotation');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
