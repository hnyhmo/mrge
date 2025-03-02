<?php

use App\Http\Controllers\MrgeJobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/jobs', [MrgeJobController::class, 'index']);
Route::post('/jobs', [MrgeJobController::class, 'store']);
Route::get('/jobs/external', [MrgeJobController::class, 'updateMrgeJobsFromExternalApi']);