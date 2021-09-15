@extends('layouts.dashboard')

@section('title', 'Hospitals')
@section('page-back', route('home'))
@section('back-check', true)

@section('content')
    <div class="row justify-content-between mt-5">
        <div class="col-md-7">
            <form action="{{route('hospitals.home')}}" method="GET">
                <div class="form-row">
                    <input type="text" name="searchKey" id="searchKey" value="{{old('searchKey') ?? $searchKey}}" class="form-control w-75" placeholder="Search for Hospital by Name, Type or Administrator;">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <a href="{{route('hospitals.register.hospital')}}" class="btn btn-success"><i class="fa fa-plus"></i>&emsp;Add Hospital</a>
        </div>
    </div>
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
    @if (isset($hospitals) && $hospitals->isNotEmpty())
        <div class="row p-2 my-3">
            <table class="table table-hover table-responsive">
                <thead class="bg-success text-light">
                    <th>Hospital Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Type</th>
                    <th>Administrator</th>
                    <th>Administrator Email</th>
                    <th></th>
                </thead>
                <tbody class="my-2">
                    @foreach ($hospitals as $hospital)
                        <tr class="cursor-pointer table-success my-1" onclick="window.location.href= '{{route('hospitals.show', ['id' => $hospital->id])}}'";>
                            <td>{{$hospital->name}}</td>
                            <td>{{$hospital->email}}</td>
                            <td>{{$hospital->phone_number}}</td>
                            <td>{{$hospital->type_of_institution}}</td>
                            <td>{{$hospital->root_user->fullname}}</td>
                            <td>{{$hospital->root_user->email}}</td>
                            <td><a href="#"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <br><br><br>
        <div class="row justify-content-center h4 text-secondary mt-5">
            There Are no Hospitals Registered into the system.
        </div>
    @endif
@endsection