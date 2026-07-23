<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// الصفحة الرئيسية لتسجيل الدخول
Route::get('/', function () {
    return view('login');
});

// مسارات الضيوف (Guest Routes)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/check-email', [AuthController::class, 'checkEmail'])->name('register.checkEmail');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// مسارات محمية (تتطلب تسجيل الدخول)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // 1. لوحة تحكم المستخدم العادي / الرئيسية
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // 2. لوحة تحكم الأدمن (تم تغيير الرابط إلى /admin/dashboard لتجنب التصادم)
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // 3. استعراض الأدوية
    Route::get('/user/medicines', [UserController::class, 'index'])->name('user.medicines.view');

    // 4. طلب صرف دواء بوصفة
    Route::get('/user/issue-request', [UserController::class, 'createIssueRequest'])->name('user.issue.request');
    Route::post('/user/issue-request', [UserController::class, 'storeIssueRequest'])->name('user.issue.store');

    // 5. طلب توفير دواء غير متوفر
    Route::get('/user/provide-request', [UserController::class, 'createProvideRequest'])->name('user.medicine.provide');
    Route::post('/user/provide-request', [UserController::class, 'storeProvideRequest'])->name('user.medicine.store');

    // 6. مسار الملف الشخصي
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');

});