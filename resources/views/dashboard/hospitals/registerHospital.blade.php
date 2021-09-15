@extends('layouts.dashboard')

@section('title', 'Register Hospital')
@section('page-back', route('hospitals.home'))
@section('back-check', true)

@section('content')
    <div class="row justify-content-center my-5">
        <span class="h4 text-success">Register A New Hospital onto the GhCare Platform</span>
    </div>
    @if (session()->has('error_message'))
        <div class="row justify-content-center">
            <div class="col-6 bg-danger px-4 py-2">
                <span class="text-light">{{session()->get('error_message')}}</span>
            </div>
        </div><br><br>
    @endif
    <div class="row justify-content-center mb-5">
        <div class="col-md-10 px-2">
            <div class="card border-success py-5">
                <div class="header">
                    <span class="h5 text-success"><strong>Step 1</strong></span>
                </div>
                <div class="body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row justify-content-center my-3">
                            <span class="h5 text-secondary">Please Enter Details of the Hospital.</span>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <span class="text-secondary">Upload Hospital Logo</span>
                        </div>
                        <div class="row justify-content-center mb-5">
                            <div class="col-6 col-md-3">
                                <div id="uploadImageBlock" class="border border-success w-100 p-5 d-flex align-center justify-content-center rounded cursor-pointer" onclick="document.getElementById('logo').click()">
                                    <span class="text-success"><i class="fa fa-camera fa-2x"></i></span>
                                </div>
                                <img id="imagePreview" src="#" class="img img-fluid rounded" onclick="document.getElementById('logo').click()" hidden>
                            </div>
                            <input type="file" name="logo" id="logo" onchange="loadImagePreview('imagePreview', this);" hidden>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Hospital Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="institution_id" class="col-md-4 col-form-label text-md-right">{{ __('Institution ID') }}</label>

                            <div class="col-md-6">
                                <input id="institution_id" type="text" class="form-control @error('institution_id') is-invalid @enderror" name="institution_id" value="{{ old('institution_id') }}" required autocomplete="name" autofocus>

                                @error('institution_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" required>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="region" class="col-md-4 col-form-label text-md-right">{{ __('Region') }}</label>

                            <div class="col-md-6">
                                <select id="region" class="form-control @error('region') is-invalid @enderror" name="region" required>
                                    <option>AHAFO</option>
                                    <option>ASHANTI</option>
                                    <option>BONO EAST</option>
                                    <option>BRONG AHAFO</option>
                                    <option>CENTRAL</option>
                                    <option>EASTERN</option>
                                    <option>GREATER ACCRA</option>
                                    <option>NORTH EAST</option>
                                    <option>NORTHERN</option>
                                    <option>OTI</option>
                                    <option>SAVANNAH</option>
                                    <option>UPPER EAST</option>
                                    <option>UPPER WEST</option>
                                    <option>WESTERN</option>
                                    <option>WESTERN NORTH</option>
                                    <option>VOLTA</option>
                                </select>
                                
                                @error('region')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>

                            <div class="col-md-6">
                                <input id="district" type="text" class="form-control @error('district') is-invalid @enderror" name="district" required>
                                
                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="town" class="col-md-4 col-form-label text-md-right">{{ __('City / Town') }}</label>

                            <div class="col-md-6">
                                <input id="town" type="text" class="form-control @error('town') is-invalid @enderror" name="town" required>
                                
                                @error('town')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ghana_post_gps" class="col-md-4 col-form-label text-md-right">{{ __('GhanaPost-GPS Address') }}</label>

                            <div class="col-md-6">
                                <input id="ghana_post_gps" type="text" class="form-control @error('ghana_post_gps') is-invalid @enderror" name="ghana_post_gps" required>
                                
                                @error('ghana_post_gps')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type_of_institution" class="col-md-4 col-form-label text-md-right">{{ __('Type of Institution') }}</label>

                            <div class="col-md-6">
                                <select id="type_of_institution" class="form-control @error('type_of_institution') is-invalid @enderror" name="type_of_institution" required>
                                    <option>Hospital</option>
                                    <option>Clinic</option>
                                    <option>Heath Center</option>
                                </select>
                                
                                @error('type_of_institution')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row justify-content-center mt-5">
                            <div class="col-6">
                                <button type="submit" class="btn btn-success w-100">Continue &emsp;<i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection