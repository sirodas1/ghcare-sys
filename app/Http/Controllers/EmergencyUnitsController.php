<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\EmergencyUnit;

class EmergencyUnitsController extends Controller
{
    public function index()
    {
        $emergency_units = EmergencyUnit::all();
        $searchKey = null;
        
        if (request()->searchKey && request()->searchKey !== '') {
            $emergency_units_filter = $emergency_units->filter(function ($value) {
                return stripos($value->firstname, request()->searchKey) !== false ||
                    stripos($value->lastname, request()->searchKey) !== false ||
                    stripos($value->othernames, request()->searchKey) !== false ||
                    stripos($value->email, request()->searchKey) !== false ||
                    $value->pharmacist_card_number == request()->searchKey;
            });
            if (count($emergency_units_filter) <= 0) {
                session()->flash(
                    'search_message',
                    'No result found for search key: ' . request()->searchKey
                );
            }
            $emergency_units =
                count($emergency_units_filter) > 0
                    ? $emergency_units_filter
                    : $emergency_units;
            
            $searchKey = request()->searchKey;
        }

        $data = [
            'emergency_units' => $emergency_units,
            'searchKey' => $searchKey,
        ];

        return view('dashboard.emergency_units.home', $data);
    }

    public function showUnit($id)
    {
        $emergency_unit = EmergencyUnit::find($id);
        
        $data = [
            'emergency_unit' => $emergency_unit,
        ];

        return view('dashboard.emergency_units.show', $data);
    }

    public function registerUnit()
    {
        return view('dashboard.emergency_units.register');
    }

    public function storeUnit()
    {
        $validator = Validator::make(request()->all() ,[
            'profile_pic' => 'nullable|image',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'othernames' => 'nullable|string',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            'affiliate_institution' => 'required|string',
            'pharmacist_card_number' => 'required|string',
            'gender' => 'required|string',
            'age' => 'required|numeric',
            'region' => 'required|string',
            'district' => 'required|string',
            'town' => 'required|string',
            'landmark' => 'required|string',
            'residential_address' => 'required|string',
        ]);
        if ($validator->fails()) {
            Log::error($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            //Hash encode the password before saving into database.
            request()['password'] = Hash::make(request()->password);

            $emergency_unit = EmergencyUnit::create(request()->all());
            
            if(request()->profile_pic){
                $image = request()->file('profile_pic');
                $name = $emergency_unit->id . '_profile_pic' . '.' .
                $image->getClientOriginalExtension();
                $folder = '/uploads/emergency_unit/';
                $filePath = $this->uploadOne($image, $folder, $name);
                $emergency_unit->profile_pic = $filePath;
                $emergency_unit->save();
            }
            
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Emergency Unit Personnel Was Not Successfully Registered Into The System.');
            return redirect()->back();
        }

        session()->flash('success_message', 'Emergency Unit Personnel Was Successfully Registered Into The System.');

        return redirect()->route('emergency.home');
    }

    public function updateUnit($id)
    {
        $validator = Validator::make(request()->all() ,[
            'profile_pic' => 'nullable|image',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'othernames' => 'nullable|string',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
            'affiliate_institution' => 'required|string',
            'pharmacist_card_number' => 'required|string',
            'gender' => 'required|string',
            'age' => 'required|numeric',
            'region' => 'required|string',
            'district' => 'required|string',
            'town' => 'required|string',
            'landmark' => 'required|string',
            'residential_address' => 'required|string',
        ]);
        if ($validator->fails()) {
            Log::error($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $emergency_unit = EmergencyUnit::find($id);
            $data = request()->all();
            unset($data['profile_pic']);
            $emergency_unit->update($data);
            
            if(request()->profile_pic){
                $image = request()->file('profile_pic');
                $name = $emergency_unit->id . '_profile_pic' . '.' .
                $image->getClientOriginalExtension();
                $folder = '/uploads/emergency_unit/';
                $filePath = $this->uploadOne($image, $folder, $name);
                $emergency_unit->profile_pic = $filePath;
                $emergency_unit->save();
            }
            
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Paramedic\'s Details Was Not Successfully Updated.');
            return redirect()->back();
        }

        session()->flash('success_message', 'Paramedic\'s Details Was Successfully Updated.');

        return redirect()->back();
    }
}
