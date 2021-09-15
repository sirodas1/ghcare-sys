@extends('layouts.dashboard')

@section('title', 'Emergency Unit')
@section('page-back', route('home'))
@section('back-check', true)

@section('content')
    @if (isset($emergency_units) && $emergency_units->isNotEmpty())
    <div class="row justify-content-between mt-5">
        <div class="col-md-7">
            <form action="{{route('emergency.home')}}" method="GET">
                <div class="form-row">
                    <input type="text" name="searchKey" id="searchKey" value="{{old('searchKey') ?? $searchKey}}" class="form-control w-75" placeholder="Search for Personnel by Name, Email or Card No.">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <a href="{{route('emergency.register.form')}}" class="btn btn-success"><i class="fa fa-plus"></i>&emsp;Add Unit Personnel</a>
        </div>
    </div>  
    @else
    <div class="row justify-content-end mt-5">
        <div class="col-md-3">
            <a href="{{route('emergency.register.form')}}" class="btn btn-success"><i class="fa fa-plus"></i>&emsp;Add Unit Personnel</a>
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
    @if (isset($emergency_units) && $emergency_units->isNotEmpty())
        <div class="row my-4">
            <div class="col">
                <table class="table table-hover w-100">
                    <thead class="bg-success text-light">
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Pharmacist Card No.</th>
                        <th></th>
                    </thead>
                    <tbody class="my-2">
                        @foreach ($emergency_units as $emergency_unit)
                            <tr class="cursor-pointer table-success my-1" onclick="window.location.href= '{{route('emergency.show', ['id' => $emergency_unit->id])}}'">
                                <td>{{$emergency_unit->lastname . ' ' . $emergency_unit->firstname}}</td>
                                <td>{{$emergency_unit->email}}</td>
                                <td>{{$emergency_unit->phone_number}}</td>
                                <td>{{$emergency_unit->pharmacist_card_number}}</td>
                                <td><a href="#"><i class="fa fa-edit"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <br><br><br>
        <div class="row justify-content-center h4 text-secondary mt-5">
            There Are no Emergency Unit Personnel Registered into the system.
        </div>
    @endif
@endsection