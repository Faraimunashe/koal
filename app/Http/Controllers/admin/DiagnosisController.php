<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cattle;
use App\Models\Diagnosis;
use Exception;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function index()
    {
        $diagnosis = Diagnosis::latest()->paginate(10);

        return view('admin.diagnosis', [
            'diagnosis' => $diagnosis
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'reference' => ['required', 'numeric'],
            'disease' => ['required', 'string'],
            'description' => ['required', 'string'],
            'advice' => ['required', 'string']
        ]);

        try{
            $cow = Cattle::where('reference', $request->reference)->first();
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
}
