<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cattle;
use App\Models\Diagnosis;
use Exception;
use Illuminate\Http\Request;

class CattleController extends Controller
{
    public function index($booking_id)
    {
        $cattle = Cattle::where('booking_id', $booking_id)->paginate(10);

        return view('admin.cattle', [
            'cattle' => $cattle
        ]);
    }

    public function diagnise(Request $request)
    {
        $request->validate([
            'cattle_id' => ['required', 'integer'],
            'disease' => ['required', 'string'],
            'description' => ['required', 'string'],
            'advice' => ['required', 'string']
        ]);

        try{
            $cow = Cattle::find($request->cattle_id);
            if(is_null($cow))
            {
                return redirect()->back()->with('error', 'No cow with provided reference found');
            }
            $diag = new Diagnosis();
            $diag->cattle_id = $cow->id;
            $diag->disease = $request->disease;
            $diag->description = $request->description;
            $diag->advice = $request->advice;
            $diag->save();

            return redirect()->back()->with('success', 'Successfully added a diagnosis');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function cow($cattle_id)
    {
        $cow = Cattle::find($cattle_id);

        return view('admin.cow', [
            'cow' => $cow
        ]);
    }
}
