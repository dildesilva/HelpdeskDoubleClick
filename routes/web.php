{{-- Copyright (c) 2025 Dilshan De Silva
This software and associated documentation files DoubleClick are the exclusive property of Dilshan De Silva. --}}
<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/addusernew', function () {
    return view('dashboardADIMN.addUsernew');
})->name('addUsernew');
require __DIR__ . '/auth.php';
require __DIR__ . '/webmain.php';

