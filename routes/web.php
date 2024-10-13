<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff_dashboard;
use App\Http\Controllers\Admin_dashboard;
use App\Http\Controllers\SuperAdmin_dashboard;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\GoogleAuthController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Fallback route
Route::fallback(function () {
    return redirect('/');
});

Route::middleware(['auth', 'loguseractivity', 'verified', 'autologout'])->group(function () {
    // Profile routes
    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });
    

    // Staff dashboard routes
    Route::middleware(['user-role:staff'])->group(function () {
        Route::prefix('staff')->controller(Staff_dashboard::class)->group(function () {
            Route::get('home', 'home')->name('staff.home');
            Route::get('add', 'add')->name('staff.add');

            Route::post('add_category', 'add_category')->name('staff.add_category');
            Route::put('update_category', 'update_category')->name('staff.update_category');
            Route::delete('delete_category/{id}', 'delete_category')->name('staff.delete_category');

            Route::post('add_subcategory', 'add_subcategory')->name('staff.add_subcategory');
            Route::put('update_subcategory', 'update_subcategory')->name('staff.update_subcategory');
            Route::delete('delete_subcategory/{id}', 'delete_subcategory')->name('staff.delete_subcategory');

            Route::post('add_product', 'add_product')->name('staff.add_product');
            Route::put('update_product', 'update_product')->name('staff.update_product');
            Route::delete('delete_product/{id}', 'delete_product')->name('staff.delete_product');

            Route::get('list', 'list')->name('staff.list');

            Route::get('order', 'order')->name('staff.order');
            Route::post('add_order', 'add_order')->name('staff.add_order');

            Route::get('supplier', 'supplier')->name('staff.supplier');
            Route::post('add_supplier', 'add_supplier')->name('staff.add_supplier');
        });
    });

    // Admin dashboard routes
    Route::middleware(['user-role:admin'])->group(function () {
        Route::prefix('admin')->controller(Admin_dashboard::class)->group(function () {
            Route::get('home', 'home')->name('admin.home');
        });
    });

    // Super Admin dashboard routes
    Route::middleware(['user-role:superadmin'])->group(function () {
        Route::prefix('superadmin')->controller(SuperAdmin_dashboard::class)->group(function () {
            Route::get('home', 'home')->name('superadmin.home');
            Route::get('index', 'index')->name('users.index');
            Route::post('store', 'store')->name('users.store');
            Route::get('/users/{id}/edit', 'edit')->name('users.edit');
            Route::put('/users/{id}', 'update')->name('users.update');
            Route::get('users/{id}', 'show')->name('users.show');    
            Route::delete('users/{id}', 'destroy')->name('users.destroy');
            Route::delete('users/{id}/destroyForever', 'destroyForever')->name('users.destroyForever');
            Route::patch('users/{id}/restore', 'restore')->name('users.restore');
        });
    });

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

 
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

});


Route::get('auth/google/redirect', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');


require __DIR__.'/auth.php';