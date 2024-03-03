<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;

Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::get('/dashboard', [WebsiteController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/logout', [WebsiteController::class, 'logout'])->name('logout');

Route::get('/login', [WebsiteController::class, 'login'])->name('login');
Route::post('login_submit', [WebsiteController::class, 'login_submit'])->name('login_submit');
Route::get('/registration', [WebsiteController::class, 'registration'])->name('registration');

Route::post('/registration_submit', [WebsiteController::class, 'registration_submit'])->name('registration_submit');

Route::get('/registration/verify/{token}/{email}', [WebsiteController::class, 'registration_verify']);

Route::get('/forget-password', [WebsiteController::class, 'forget_password'])->name('forget_password');
