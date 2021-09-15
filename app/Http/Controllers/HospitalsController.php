<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Hospital;

class HospitalsController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::with('root_user')->get();
        $searchKey = null;
        
        if (request()->searchKey && request()->searchKey !== '') {
            $hospitalsFilter = $hospitals->filter(function ($value) {
                return stripos($value->name, request()->searchKey) !== false ||
                    stripos($value->email, request()->searchKey) !== false ||
                    stripos($value->type_of_institution, request()->searchKey) !== false ||
                    stripos($value->root_user->name, request()->searchKey) !==
                        false;
            });
            if (count($hospitalsFilter) <= 0) {
                session()->flash(
                    'search_message',
                    'No result found for search key: ' . request()->searchKey
                );
            }
            $hospitals =
                count($hospitalsFilter) > 0
                    ? $hospitalsFilter
                    : $hospitals;
            
            $searchKey = request()->searchKey;
        }

        $data = [
            'hospitals' => $hospitals,
            'searchKey' => $searchKey,
        ];

        return view('dashboard.hospitals.home', $data);
    }

    public function registerHospital()
    {
        return view('dashboard.hospitals.registerHospital');
    }

    public function registerAdmin()
    {
        return view('dashboard.hospitals.registerAdmin')->with('id', request()->id);
    }

    public function storeHospital()
    {
        $this->validate(request() ,[
            'logo' => 'nullable|image|',
            'name' => 'required|string',
            'institution_id' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
            'region' => 'required|string',
            'district' => 'required|string',
            'town' => 'required|string',
            'ghana_post_gps' => 'required|string',
            'type_of_institution' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $hospital = Hospital::create(request()->all());
            
            if(request()->logo){
                $image = request()->file('logo');
                $name = $hospital->id . '_logo' . '.' .
                $image->getClientOriginalExtension();
                $folder = '/uploads/hospital';
                $filePath = $this->uploadOne($image, $folder, $name);
                $hospital->logo = $filePath;
                $hospital->save();
            }
            
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Hospital Was Not Successfully Registered Into The System.');
            return redirect()->back();
        }

        return redirect()->route('hospitals.register.admin', ['id' => $hospital->id]);
    }

    public function storeAdmin()
    {
        $this->validate(request() ,[
            'profile_pic' => 'nullable|image',
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            'hospital_id' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $hospital = Hospital::find(request()->hospital_id);

            //Hash encode the password before saving into database.
            request()['password'] = Hash::make(request()->password);

            $hospital_admin = $hospital->root_user()->create(request()->all());
            
            if(request()->profile_pic){
                $image = request()->file('profile_pic');
                $name = $hospital_admin->id . '_profile_pic' . '.' .
                $image->getClientOriginalExtension();
                $folder = '/uploads/hospital/root_user';
                $filePath = $this->uploadOne($image, $folder, $name);
                $hospital_admin->profile_pic = $filePath;
                $hospital_admin->save();
            }
            
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Hospital Administrator Was Not Successfully Registered Into The System.');
            return redirect()->back();
        }

        session()->flash('success_message', 'Hospital Was Successfully Registered Into The System.');

        return redirect()->route('hospitals.home');
    }

    public function showHospital($id)
    {
        $hospital = Hospital::find($id);
        
        $data = [
            'hospital' => $hospital,
        ];

        return view('dashboard.hospitals.show', $data);
    }

    public function updateHospital($id)
    {
        $this->validate(request() ,[
            'logo' => 'nullable|image|',
            'name' => 'required|string',
            'institution_id' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
            'region' => 'required|string',
            'district' => 'required|string',
            'town' => 'required|string',
            'ghana_post_gps' => 'required|string',
            'type_of_institution' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $hospital = Hospital::find($id);
            $hospital->name = request()->name;
            $hospital->institution_id = request()->institution_id;
            $hospital->email = request()->email;
            $hospital->phone_number = request()->phone_number;
            $hospital->region = request()->region;
            $hospital->district = request()->district;
            $hospital->town = request()->town;
            $hospital->ghana_post_gps = request()->ghana_post_gps;
            $hospital->type_of_institution = request()->type_of_institution;
            $hospital->save();
            
            if(request()->logo){
                $image = request()->file('logo');
                $name = $hospital->id . '_logo' . '.' .
                $image->getClientOriginalExtension();
                $folder = '/uploads/hospital';
                $filePath = $this->uploadOne($image, $folder, $name);
                $hospital->logo = $filePath;
                $hospital->save();
            }
            
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Hospital Was Not Successfully Registered Into The System.');
            return redirect()->back();
        }

        session()->flash('success_message', 'Hospital Information Was Successfully Uppdated');

        return redirect()->back();
    }

    public function updateHospitalAdmin($id)
    {
        $this->validate(request() ,[
            'profile_pic' => 'nullable|image',
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|phone:GH',
        ]);

        DB::beginTransaction();

        try {
            $hospital = Hospital::find($id);

            $hospital_admin = $hospital->root_user;
            $hospital_admin->fullname = request()->fullname;
            $hospital_admin->email = request()->email;
            $hospital_admin->phone_number = request()->phone_number;
            $hospital_admin->save();

            if(request()->profile_pic){
                $image = request()->file('profile_pic');
                $name = $hospital_admin->id . '_profile_pic' . '.' .
                $image->getClientOriginalExtension();
                $folder = '/uploads/hospital/root_user';
                $filePath = $this->uploadOne($image, $folder, $name);
                $hospital_admin->profile_pic = $filePath;
                $hospital_admin->save();
            }
            
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollback();

            session()->flash('error_message', 'Administrator Information Was Not Successfully Uppdated.');
            return redirect()->back();
        }

        session()->flash('success_message', 'Administrator Information Was Successfully Uppdated');

        return redirect()->back();
    }
}
