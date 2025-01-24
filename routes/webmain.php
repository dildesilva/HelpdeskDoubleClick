<?php

use App\Http\Controllers\Addbranch;
use App\Http\Controllers\Adminregidtion;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashbordrouts;
use App\Http\Controllers\Engdonetiket;
use App\Http\Controllers\FilterIndex;
use App\Http\Controllers\TikectUser;
use Illuminate\Support\Facades\Route;
Route::get('/q', function () {
    return view('dashboard.wtapp');
});
Route::middleware('auth')->group(function () {
    Route::post('/report', [Dashbordrouts::class, 'downloadReport'])->name('report');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/tikcetSend', [TikectUser::class, 'tiketSENDone'])->name('tikcetSend');
    Route::post('/assignedTECH', [TikectUser::class, 'assigned'])->name('assignedTECH');
    Route::post('/proEng', [TikectUser::class, 'proEng'])->name('proEng');
    Route::post('/doneEng', [Engdonetiket::class, 'doneENGtikets'])->name('doneEng');
    Route::post('/addbranchdata', [Addbranch::class, 'addbranchdd'])->name('addbranchdata');
    Route::delete('/ticket/{id}', [TikectUser::class, 'destroy'])->name('ticket.destroy');
    Route::delete('/ticketDone/{id}', [TikectUser::class, 'destroyDone'])->name('ticketDone');
    Route::delete('/destroyEn/{id}', [TikectUser::class, 'destroyEn'])->name('destroyEn');
    Route::delete('/userAdmind/{id}', [TikectUser::class, 'destroyuserAdmind'])->name('userAdmind.delete');
    Route::delete('/posts/{post}', [TikectUser::class, 'destroyCancel'])->name('posts.destroy');
    Route::put('/tickets/{id}/update-state', [TikectUser::class, 'updateState'])->name('tickets.updateState');
    Route::put('/tickets/{id}/update-TUpdate', [TikectUser::class, 'updateTUpdate'])->name('tickets.updateTUpdate');
    Route::put('/admintickets/{id}/update-state', [TikectUser::class, 'adminupdateState'])->name('admintickets.updateState');
    Route::put('/usertickets/{id}/update-state', [TikectUser::class, 'userupdateState'])->name('usertickets.updateState');
    Route::put('/engtickets/{id}/update-state', [TikectUser::class, 'engupdateState'])->name('engtickets.updateState');
    Route::put('/userechenges/{id}', [Adminregidtion::class, 'userechenges'])->name('userechenges');
    Route::get('/fillindex', [FilterIndex::class, 'findex'])->name('fillindex');
    Route::get('/tickets/{id}/fetch-updates', [TikectUser::class, 'fetchUpdates'])->name('tickets.fetchUpdates');
});
require __DIR__ . '/weba.php';
