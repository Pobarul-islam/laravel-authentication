<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;

Route::get('/', [WebsiteController::class, 'index'])->name('home');



Route::get('/dashboard-user', [WebsiteController::class, 'dashboard_user'])->name('dashboard_user')->middleware('auth');


Route::get('/logout', [WebsiteController::class, 'logout'])->name('logout');

Route::get('/login', [WebsiteController::class, 'login'])->name('login');
Route::post('login_submit', [WebsiteController::class, 'login_submit'])->name('login_submit');
Route::get('/registration', [WebsiteController::class, 'registration'])->name('registration');

Route::post('/registration_submit', [WebsiteController::class, 'registration_submit'])->name('registration_submit');

Route::get('/registration/verify/{token}/{email}', [WebsiteController::class, 'registration_verify']);

Route::get('/forget_password', [WebsiteController::class, 'forget_password'])->name('forget_password');

Route::post('/forget_password_submit', [WebsiteController::class, 'forget_password_submit'])->name('forget_password_submit');

Route::get('/reset_password/{token}/{user}', [WebsiteController::class, 'reset_password'])->name('reset_password');

Route::post('/reset_password_submit', [WebsiteController::class, 'reset_password_submit'])->name('reset_password_submit');



// Admin 


Route::get('/admin/login', [AdminController::class, 'login'])->name('admin_login');

Route::post('/admin/login_submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard')->middleware('admin:admin');

Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin_settings')->middleware('admin:admin');

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin_logout');