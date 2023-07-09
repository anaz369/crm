<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/companies', [CompanyController::class,'index']);
Route::get('/employees', [EmployeeController::class,'index']);
Route::post('/employees/store', [EmployeeController::class,'store']);

Route::post('/companies/create', [CompanyController::class,'create']);
Route::delete('/companies/delete/{id}', [CompanyController::class, 'destroy']);
Route::delete('/employees/delete/{id}', [EmployeeController::class, 'destroy']);

Route::get('/companies/{id}/edit', [CompanyController::class, 'edit']);
Route::put('/companies/{id}', [CompanyController::class, 'update']);

Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);

Route::post('login', [LoginController::class, 'login']);
