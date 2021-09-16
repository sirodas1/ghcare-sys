<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientsController extends Controller
{
    public function index()
    {
        $patients = Patient::all();

        $searchKey = null;
        
        if (request()->searchKey && request()->searchKey !== '') {
            $patients_filter = $patients->filter(function ($value) {
                return stripos($value->firstname, request()->searchKey) !== false ||
                    stripos($value->lastname, request()->searchKey) !== false ||
                    stripos($value->othernames, request()->searchKey) !== false ||
                    stripos($value->email, request()->searchKey) !== false ||
                    $value->national_card_id == request()->searchKey;
            });
            if (count($patients_filter) <= 0) {
                session()->flash(
                    'search_message',
                    'No result found for search key: ' . request()->searchKey
                );
            }
            $patients =
                count($patients_filter) > 0
                    ? $patients_filter
                    : $patients;
            
            $searchKey = request()->searchKey;
        }

        $data = [
            'patients' => $patients,
            'searchKey' => $searchKey,
        ];

        return view('dashboard.patients.home', $data);
    }

    public function show($id)
    {
        $patient = Patient::find($id);
        $data = [
            'patient' => $patient,
        ];
        return view('dashboard.patients.show', $data);
    }
}
