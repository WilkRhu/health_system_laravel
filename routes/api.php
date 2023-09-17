<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MedicalSpecialtiesController;
use App\Http\Controllers\Api\SpecialtiesController;


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



Route::middleware(['jwt.admin.and.user'])->group(function () {
    Route::get('/', function (){
        return response()->json(['api_name' => 'laravel-app', 'api_version' => '1.0.0']);
    });
    // ============== User ===============//
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);
    // ====================================== //

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/show/{id}', [UserController::class, 'show']);
    Route::put('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy']);

});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    
});

Route::controller(SpecialtiesController::class)->group(function () {
    Route::get('/specialties', 'index');
    Route::get('/specialties/{id}', 'show');
    Route::post('/specialties/create', 'store');
    Route::put('/specialties/update/{id}', 'update');
    Route::delete('/specialties/destroy/{id}', 'destroy');
})->middleware('auth:api', 'jwt.admin');

Route::controller(MedicalSpecialtiesController::class)->group(function (){
    Route::get('/medicalspecialties', 'index');
    Route::post('/medicalspecialties/create', 'store');
    Route::get('/medicalspecialties/{id}', 'show');
    Route::delete('/medicalspecialties/destroy/{id}', 'destroy');
})->middleware('jwt.admin');

