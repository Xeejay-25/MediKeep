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
    if (Auth::check()) {
        $role = Auth::user()->role;

        switch ($role) {
            case 1:
                return redirect()->route('staff.home');
            case 2:
                return redirect()->route('admin.home');
            case 3:
                return redirect()->route('superadmin.home');
        }
    }

    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

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
        Route::patch('/profile/image', 'updateProfileImage')->name('profile.update.image');
        Route::put('/profile/password', 'updatePassword')->name('profile.updatePassword');
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
            Route::post('/set-active-tab', 'setActiveTab')->name('staff.add');
            Route::get('list', 'list')->name('staff.list');
            Route::get('order', 'order')->name('order.order');
            Route::post('add_order', 'add_order')->name('staff.add_order');
            Route::get('orderlist', 'orderlist')->name('order.orderlist');
            Route::get('order/{id}', 'ordershow')->name('order.ordershow');  
            Route::get('/order/{id}/edit', 'orderedit')->name('order.orderedit');
            Route::put('/order/{id}', 'orderupdate')->name('order.orderupdate');
            Route::delete('order/{id}', 'orderdelete')->name('order.orderdelete');
            Route::get('supplier', 'supplier')->name('staff.supplier');
            Route::post('add_supplier', 'add_supplier')->name('staff.add_supplier');
            
        });

    });
    

    // Admin dashboard routes
    Route::middleware(['user-role:admin'])->group(function () {
        Route::prefix('admin')->controller(Admin_dashboard::class)->group(function () {
            Route::get('home', 'home')->name('admin.home');
            Route::get('index', 'index')->name('users.index');
            Route::post('store', 'store')->name('users.store');
            Route::get('/users/{id}/edit', 'edit')->name('users.edit');
            Route::put('/users/{id}', 'update')->name('users.update');
            Route::get('users/{id}', 'show')->name('users.show');    
            Route::delete('users/{id}', 'destroy')->name('users.destroy');
            Route::delete('users/{id}/destroyForever', 'destroyForever')->name('users.destroyForever');
            Route::patch('users/{id}/restore', 'restore')->name('users.restore');
        });

        // Activity logs
        Route::get('activity-logs', [App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity.logs');
    });

    // Super Admin dashboard routes
    Route::middleware(['user-role:superadmin'])->group(function () {
        Route::prefix('superadmin')->controller(SuperAdmin_dashboard::class)->group(function () {
            Route::get('home', 'home')->name('superadmin.home');
            Route::get('add', 'add')->name('superadmin.add');
            Route::post('add_category', 'add_category')->name('superadmin.add_category');
            Route::delete('delete_category/{id}', 'delete_category')->name('superadmin.delete_category');
            Route::get('list', 'list')->name('superadmin.list');
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

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

require __DIR__.'/auth.php';
