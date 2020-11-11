<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,"index"])->name("home.index");
Route::post('/',[HomeController::class,"store"])->name("home.store");
Route::get('/delete/{id}',[HomeController::class,"delete"])->name("home.delete");
Route::get('/download/{id}',[HomeController::class,"download"])->name("home.download");
