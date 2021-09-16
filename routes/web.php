<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HospitalsController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\EmergencyUnitsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();



Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'hospitals', 'as' => 'hospitals.'],function () {
        Route::get('', [HospitalsController::class, 'index'])->name('home');
        Route::get('show/{id}', [HospitalsController::class, 'showHospital'])->name('show'); 

        Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
            Route::get('', [HospitalsController::class, 'registerHospital'])->name('hospital');
            Route::get('admin',[HospitalsController::class, 'registerAdmin'])->name('admin');
            Route::post('', [HospitalsController::class, 'storeHospital'])->name('hospital.store');
            Route::post('admin', [HospitalsController::class, 'storeAdmin'])->name('admin.store');
        });
        
        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::put('{id}', [HospitalsController::class, 'updateHospital'])->name('update');
            Route::put('admin/{id}', [HospitalsController::class, 'updateHospitalAdmin'])->name('update-admin');
        });
    });

    Route::group(['prefix' => 'emergency', 'as' => 'emergency.'],function () {
        Route::get('', [EmergencyUnitsController::class, 'index'])->name('home');
        Route::get('show/{id}', [EmergencyUnitsController::class, 'showUnit'])->name('show');

        Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
            Route::get('', [EmergencyUnitsController::class, 'registerUnit'])->name('form');
            Route::post('', [EmergencyUnitsController::class, 'storeUnit'])->name('store');
        });
        
        Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
            Route::put('{id}', [EmergencyUnitsController::class, 'updateUnit'])->name('update');
        });
    });

    Route::group(['prefix' => 'patients', 'as' => 'patients.'],function () {
        Route::get('', [PatientsController::class, 'index'])->name('home');
        Route::get('{id}', [PatientsController::class, 'show'])->name('show');
    });
});

