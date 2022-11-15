<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Abattoir;
use Exception;
use Illuminate\Http\Request;

class AbattoirController extends Controller
{
    public function index()
    {
        $abattoirs = Abattoir::paginate(10);
        return view('admin.abattoirs', [
            'abattoirs' => $abattoirs
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required']
        ]);

        try{
            $aba = new Abattoir();
            $aba->name = $request->name;
            $aba->city = $request->city;
            $aba->address = $request->address;
            $aba->save();

            return redirect()->back()->with('success', 'You have successfully added an abattoir');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'abattoir_id' => ['required', 'numeric'],
            'name' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required'],
        ]);

        try{
            $aba = Abattoir::find($request->abattoir_id);
            $aba->name = $request->name;
            $aba->city = $request->city;
            $aba->address = $request->address;
            $aba->save();

            return redirect()->back()->with('success', 'You have successfully updated an abattoir');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
