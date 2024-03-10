<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\CustomerAPIController;
use App\Http\Controllers\API\MedicationAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//api user login
Route::post('/login', [AuthAPIController::class, 'login'])->name('api.login');

//medications APIs
Route::get('/medications', [MedicationAPIController::class, 'index'])->name('api.medications');
Route::post('/medications/store', [MedicationAPIController::class, 'store'])->name('api.medications.store');
Route::get('/medications/get/{id}', [MedicationAPIController::class, 'show'])->name('api.medications.show');
Route::post('/medications/update', [MedicationAPIController::class, 'update'])->name('api.medications.update');
Route::get('/medications/delete/{id}', [MedicationAPIController::class, 'destroy'])->name('api.medications.delete');


//customer APIs
Route::get('/customers', [CustomerAPIController::class, 'index'])->name('api.customers');
Route::post('/customers/store', [CustomerAPIController::class, 'store'])->name('api.customers.store');
Route::get('/customers/get/{id}', [CustomerAPIController::class, 'show'])->name('api.customers.show');
Route::post('/customers/update', [CustomerAPIController::class, 'update'])->name('api.customers.update');
Route::get('/customers/delete/{id}', [CustomerAPIController::class, 'destroy'])->name('api.customers.delete');

