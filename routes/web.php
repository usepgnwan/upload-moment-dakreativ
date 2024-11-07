<?php

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QRCodeController;
use App\Livewire\Dashboard\Event;
use App\Livewire\Dashboard\Home as DashboardHome;
use App\Livewire\Dashboard\Paket;
use App\Livewire\Dashboard\Pelanggan;
use App\Livewire\Front\Home;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('account')->group(function () {
        Route::get('dashboard', DashboardHome::class)->name('account.dashboard');
        Route::get('paket', Paket::class)->name('account.master.paket');
        Route::get('event', Event::class)->name('account.master.event');
        Route::get('pelanggan', Pelanggan::class)->name('account.pelanggan');
        Route::get('generate-qr/{url?}', QRCodeController::class)->name('download.qr');
    });
});

Route::get('login', Login::class)->name('login');
Route::get('/logout', LogoutController::class)->name('logout');
Route::get('/{slug?}/{type?}', Home::class)->name('toPage');
