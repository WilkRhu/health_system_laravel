<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MedicalSpecialtiesController;
use App\Http\Controllers\Api\HealthInsuranceController;
use App\Http\Controllers\Api\SpecialtiesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProceduresController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    
});



Route::middleware(['jwt.admin.and.user'])->group(function () {
    Route::get('/', function (){
        return response()->json(['api_name' => 'laravel-app', 'api_version' => '1.0.0']);
    });
    /**
     * Autentications
     */
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
    /** */

    /**
     * Users
     */
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/show/{id}', [UserController::class, 'show']);
    Route::put('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy']);
    /** */

    /**
     * Appointment
     */
    Route::post('/appointment/create', [AppointmentController::class, 'store']);
    Route::get('/appointment', [AppointmentController::class, 'index']);
    Route::get('/appointment/{id}', [AppointmentController::class, 'show']);
    Route::put('/appointment/update/{id}', [AppointmentController::class, 'update']);
    Route::delete('/appointment/destroy/{id}', [AppointmentController::class, 'destroy']);
    /** */

});

Route::middleware(['jwt.admin'])->group(function (){
    /**
     * Specialties Routes
     */
    Route::get('/specialties', [SpecialtiesController::class, 'index']);
    Route::get('/specialties/{id}', [SpecialtiesController::class, 'show']);
    Route::post('/specialties/create', [SpecialtiesController::class, 'store']);
    Route::put('/specialties/update/{id}', [SpecialtiesController::class, 'update']);
    Route::delete('/specialties/destroy/{id}', [SpecialtiesController::class, 'destroy']);
    /** */

    /**
     * Routes Medial Specialties
     */
    Route::get('/medicalspecialties', [MedicalSpecialtiesController::class, 'index']);
    Route::post('/medicalspecialties/create', [MedicalSpecialtiesController::class, 'store']);
    Route::get('/medicalspecialties/{id}', [MedicalSpecialtiesController::class, 'show']);
    Route::delete('/medicalspecialties/destroy/{id}', [MedicalSpecialtiesController::class, 'destroy']);

     /** */

     /**
      * Routes Health Insurance
      */
    Route::post('/healthinsurance/create', [HealthInsuranceController::class, 'store']);
    Route::get('/healthinsurance', [HealthInsuranceController::class, 'index']);
    Route::get('healthinsurance/{id}', [HealthInsuranceController::class, 'show']);
    Route::put('/healthinsurance/update/{id}', [HealthInsuranceController::class, 'update']);
    Route::delete('/healthinsurance/destroy/{id}', [HealthInsuranceController::class, 'destroy']);
    /** */

    /**
     * Procedures
     */

     Route::post('/procedures/create', [ProceduresController::class, 'store']);
     Route::get('/procedures', [ProceduresController::class, 'index']);
     Route::get('/procedures/{id}', [ProceduresController::class, 'show']);
    Route::delete('/procedures/destroy/{id}', [ProceduresController::class, 'destroy']);
     /** */
});

