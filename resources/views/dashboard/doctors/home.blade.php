@extends('layouts.dashboard')

@section('title', 'Doctors')
@section('page-back', route('home'))
@section('back-check', true)

@section('content')
    @if (isset($doctors) && $doctors->isNotEmpty())
        <div class="row justify-content-between mt-5">
            <div class="col-md-7">
                <form action="{{route('doctors.home')}}" method="GET">
                    <div class="form-row">
                        <input type="text" name="searchKey" id="searchKey" value="{{old('searchKey') ?? $searchKey}}" class="form-control w-75" placeholder="Search for Doctor by Name, Email, or Card">
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
                <span class="text-light">{{session()->get('success_message')}}</span>
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
    @if (isset($doctors) && $doctors->isNotEmpty())
        <div class="row p-2 my-3">
          <div class="table-responsive">
            <table class="table table-hover">
                <thead class="bg-success text-light">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th nowrap="nowrap">Professional ID</th>
                    <th>Region</th>
                    <th>District</th>
                    <th>Hospital</th>
                </thead>
                <tbody class="my-2">
                    @foreach ($doctors as $doctor)
                        <tr class="cursor-pointer table-success my-1">
                            <td nowrap="nowrap">{{$doctor->lastname . ' ' . $doctor->firstname . ' ' . ($doctor->othernames ?? '')}}</td>
                            <td>{{$doctor->email}}</td>
                            <td>{{$doctor->phone_number}}</td>
                            <td nowrap="nowrap">{{$doctor->doctor_card_number}}</td>
                            <td nowrap="nowrap">{{$doctor->region}}</td>
                            <td nowrap="nowrap">{{$doctor->district}}</td>
                            <td nowrap="nowrap">{{$doctor->hospital->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
    @else
        <br><br><br>
        <div class="row justify-content-center h4 text-secondary mt-5">
            There are no doctors in the system.
        </div>
    @endif
@endsection