<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\MpesaSTKPUSHController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', [MainController::class, 'renderDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::post('change_availability', function(Request $request) {
    $user = $request -> user();
    $user -> available = !$user -> available;
    $user -> push();
    return redirect() -> back();
})->middleware(['auth'])->name('change_availability');

Route::post('initialize_payment', [MpesaSTKPUSHController::class, 'initializeSTKPush'])->name('initialize_payment');

require __DIR__.'/settings.php';