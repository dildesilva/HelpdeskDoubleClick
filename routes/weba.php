<?php

use App\Http\Controllers\Adminregidtion;
use App\Http\Controllers\Dashbordrouts;
use Illuminate\Support\Facades\Route;


Route::post('/adreg', [Adminregidtion::class, 'addUsernewadmin'])->name('adreg');
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', [Dashbordrouts::class, 'Maindash'])->name('dashboard');
    Route::get('/tikect', [Dashbordrouts::class, 'Tikect'])->name('tikect');
    Route::get('/cashteam', [Dashbordrouts::class, 'Team'])->name('Team');
    Route::get('/addUser', [Dashbordrouts::class, 'addUsers'])->name('addUser');
    Route::get('/bucketT', [Dashbordrouts::class, 'bucket'])->name('bucketT');
    Route::get('/manageUsers', [Dashbordrouts::class, 'manageUser'])->name('manageUsers');
    Route::get('/addBranch', [Dashbordrouts::class, 'addNewBranch'])->name('addBranch');
    Route::get('/tiketAdmin', [Dashbordrouts::class, 'Admintiket'])->name('tiketAdmin');
    Route::get('/processingAdmin', [Dashbordrouts::class, 'Adminprocessing'])->name('processingAdmin');
    Route::get('/doneAdmin', [Dashbordrouts::class, 'Admindone'])->name('doneAdmin');
    Route::get('/manageBranch', [Dashbordrouts::class, 'Adminmanage'])->name('manageBranch');
    Route::get('/ticket-Approval', [Dashbordrouts::class, 'jasonApprovalAdminDash']);
    Route::get('/adminTiketopen', [Dashbordrouts::class, 'adminTiketopenfun'])->name('adminTiketopen');
    Route::get('/adminTiketprocess', [Dashbordrouts::class, 'adminTiketprocessfun'])->name('adminTiketprocess');
    Route::get('/adminReport', [Dashbordrouts::class, 'adminReportfun'])->name('adminReport');


});
Route::get('/securityfdc', [Dashbordrouts::class, 'securityfdc'])->name('securityfdc');
Route::middleware(['auth', 'verified', 'user'])->group(function () {
    Route::get('/userDash', [Dashbordrouts::class, 'user'])->name('userDash');
    Route::get('/userDashup', [Dashbordrouts::class, 'userDashupdate'])->name('userDashup');
    Route::get('/serDashupdatePROCEING', [Dashbordrouts::class, 'userDashupdatePROCEING'])->name('userDashupdatePROCEING');
    Route::get('/userDashCont', action: [Dashbordrouts::class, 'userDashContact'])->name('userDashCont');
});
Route::middleware(['auth', 'verified', 'itEng'])->group(function () {
    Route::get('/engDash', [Dashbordrouts::class, 'eng'])->name('engDash');
    Route::get('/engTiket', [Dashbordrouts::class, 'engTiketr'])->name('engTiket');
    Route::get('/engTiket/tickets', [Dashbordrouts::class, 'getTickets'])->name('engTiket.tickets');
    Route::get('/engTeam', [Dashbordrouts::class, 'engTeamr'])->name('engTeam');
    Route::get('/securityfdc', [Dashbordrouts::class, 'securityfdc'])->name('securityfdc');
    Route::get('/engProcessing', [Dashbordrouts::class, 'engProcess'])->name('engProcessing');
    Route::get('/engdone', [Dashbordrouts::class, 'engdoneT'])->name('engdone');
    Route::get('/addengtikect', [Dashbordrouts::class, 'addengtikecs'])->name('addengtikect');
    Route::get('/ticket-count', [Dashbordrouts::class, 'jasonUpdateWaitingEngDash']);
    Route::get('/engTiketopen', [Dashbordrouts::class, 'engTiketopenfun'])->name('engTiketopen');
    Route::get('/engTiketprocess', [Dashbordrouts::class, 'engTiketprocessfun'])->name('engTiketprocess');
    Route::get('/engReport', [Dashbordrouts::class, 'engReportfun'])->name('engReport');

});
Route::get('/usernameupdate', [Dashbordrouts::class, 'usernameupdateAD']);
Route::get('/fetchAssined-updates', [Dashbordrouts::class, 'fetchAssinedUpdates']);
