<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Exception;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        return view('admin.prices', [
            'prices' => Price::all()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'amount' => ['required', 'numeric']
        ]);

        try{
            $price = Price::first();
            if(is_null($price)){
                $price = new Price();
                $price->name = $request->name;
                $price->amount = $request->amount;
                $price->save();

                return redirect()->back()->with('success', 'successfully updated prices');
            }

            $price->name = $request->name;
            $price->amount = $request->amount;
            $price->save();

            return redirect()->back()->with('success', 'successfully updated prices');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
