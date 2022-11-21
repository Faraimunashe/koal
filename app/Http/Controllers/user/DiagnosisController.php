<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosisController extends Controller
{
    public function index()
    {
        return view('user.diagnosis', [
            'diagnosis' => Diagnosis::join('cattle', 'cattle.id', '=', 'diagnoses.cattle_id')->join('bookings', 'bookings.id', '=', 'cattle.booking_id')
            ->where('bookings.user_id', Auth::id())
            ->select('diagnoses.id', 'diagnoses.cattle_id', 'diagnoses.disease', 'diagnoses.description', 'diagnoses.advice')
            ->get()
        ]);
    }
}
