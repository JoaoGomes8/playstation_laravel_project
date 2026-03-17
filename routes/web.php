<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('utils.home');
})->name('home');
