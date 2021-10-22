<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Folder;

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

    public function search(Request $request)
    {
        $this->validate($request, [
            'national_card_id' => 'required',
        ]);

        $patient = Patient::where('national_card_id', $request->national_card_id)->first();

        if (!$patient) {
            session()->flash('error_message', 'Patient Doesn\'t exist.');
            return back();
        }

        return redirect()->route('patients.show', ['id' => $patient->id]);
    }

    public function folder($id)
    {
        $folder = Folder::find($id);
        $data = [
            'folder' => $folder,
        ];
        return view('dashboard.patients.folder', $data);
    }
}
