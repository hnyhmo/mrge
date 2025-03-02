<?php

use App\Http\Controllers\MrgeJobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin/jobs/{id}'], function () {
    Route::get('/approve', [MrgeJobController::class, 'approve']);
    Route::get('/mark_as_spam', [MrgeJobController::class, 'mark_as_spam']);
});
