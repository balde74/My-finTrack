<?php

use App\Livewire\SettingsBank;
use App\Livewire\SettingsAccount;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function()
{
    Route::get('profile',function()
    {
        return view('profile');
    })->name('profile');

    route::get('settings/',function(){ return view('pages.settings.show');})->name('settings.show');
    

    // Route::get('/settings/account', SettingsAccount::class)->name('settings.account');
    // Route::get('/settings/bank', SettingsBank::class)->name('settings.bank');
    // Route::get('account/{user}',[AccountController::class,'userAccount'])->name('account.show');

    Route::resource('settings/account',AccountController::class)->except('show');

    // Route::get('/settings/profile-information',ProfileController::class)->name('user-profile-information.edit');
    
});

