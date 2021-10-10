@extends('layouts.dashboard')

@section('title', 'Patients')
@section('page-back', route('home'))
@section('back-check', true)

@section('content')
    @if (isset($patients) && $patients->isNotEmpty())
        <div class="row justify-content-between mt-5">
            <div class="col-md-7">
                <form action="{{route('patients.home')}}" method="GET">
                    <div class="form-row">
                        <input type="text" name="searchKey" id="searchKey" value="{{old('searchKey') ?? $searchKey}}" class="form-control w-75" placeholder="Search for Patient by Name, Email, or National ID;">
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                
            </div>
        </div>
    @endif
    
    @if (session()->has('search_message'))
    <br>
        <div class="row justify-content-center">
            <div class="col-6 bg-danger px-4 py-2">
                <span class="text-light">{{session()->get('search_message')}}</span>
            </div>
        </div><br><br>
    @endif
    @if (session()->has('success_message'))
    <br>
        <div class="row justify-content-center">
            <div class="col-6 bg-success px-4 py-2">
                <span class="text-light">{{session()->get('success_message')}}</span>
            </div>
        </div><br><br>
    @endif
    @if (isset($patients) && $patients->isNotEmpty())
        <div class="row p-2 my-3">
            <table class="table table-hover table-responsive">
                <thead class="bg-success text-light">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>National ID</th>
                    <th>Region</th>
                    <th>District</th>
                    <th></th>
                </thead>
                <tbody class="my-2">
                    @foreach ($patients as $patient)
                        <tr class="cursor-pointer table-success my-1" onclick="window.location.href= '{{route('patients.show', ['id' => $patient->id])}}'";>
                            <td>{{$patient->lastname . ' ' . $patient->firstname . ' ' . ($patient->othernames ?? '')}}</td>
                            <td>{{$patient->email}}</td>
                            <td>{{$patient->phone_number}}</td>
                            <td>{{$patient->national_card_id}}</td>
                            <td>{{$patient->region}}</td>
                            <td>{{$patient->district}}</td>
                            <td><a href="#"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <br><br><br>
        <div class="row justify-content-center h4 text-secondary mt-5">
            There are no Patients in the system.
        </div>
    @endif
@endsection