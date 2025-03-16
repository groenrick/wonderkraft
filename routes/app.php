<?php

use App\Http\Controllers\App\AppController;
use App\Http\Controllers\App\PageController as AppPageController;
use App\Http\Controllers\App\SiteController;
use App\Http\Controllers\DomainController;
use App\Http\Middleware\ScopeAdminToSite;
use Illuminate\Support\Facades\Route;

route::group([
    'domain' => config('app.domains.app'),
], function () {
    Route::get('/dashboard', function () {
        return redirect()->route('app.dashboard');
    });
    Route::get('/logi', function () {
        return redirect()->route('app.login');
    })->name('login');
});

Route::group([
    'middleware' => [
        'auth',
        ScopeAdminToSite::class,
    ],
    'domain' => config('app.domains.app'),
], function () {

    Route::get('/', [AppController::class, 'index'])
        ->name('app.dashboard');

    Route::get('/pages', [AppPageController::class, 'index'])
        ->name('app.pages.index');

    Route::get('/pages/create', [AppPageController::class, 'create'])
        ->name('app.pages.create');

    Route::post('/pages', [AppPageController::class, 'store'])
        ->name('app.pages.store');

    Route::get('/admin/pages/{page}/edit', [AppPageController::class, 'edit'])
        ->name('app.pages.edit');

    Route::put('/admin/pages/{page}', [AppPageController::class, 'update'])
        ->name('app.pages.update');

    Route::delete('/admin/pages/{page}', [AppPageController::class, 'destroy'])
        ->name('app.pages.destroy');


    Route::get('sites', [SiteController::class, 'index'])->name('app.sites.index');

    Route::get('sites/create', [SiteController::class, 'create'])
        ->withoutMiddleware('scope.admin.site')
        ->name('app.sites.create');

    Route::post('sites', [SiteController::class, 'store'])
        ->withoutMiddleware('scope.admin.site')
        ->name('app.sites.store');
    Route::get('sites/{site}/edit', [SiteController::class, 'edit'])->name('app.sites.edit');
    Route::put('sites/{site}', [SiteController::class, 'update'])->name('app.sites.update');
    Route::delete('sites/{site}', [SiteController::class, 'destroy'])->name('app.sites.destroy');
    Route::get('switch-site/{site}', [SiteController::class, 'switchSite'])->name('app.switch-site');

    Route::get('domains/create', [DomainController::class, 'create'])->name('app.domains.create');
    Route::post('domains', [DomainController::class, 'store'])->name('app.domains.store');
    Route::delete('domains/{domain}', [DomainController::class, 'destroy'])->name('app.domains.destroy');
});

Route::group([
    'domain' => config('app.domains.app'),
], function () {

    Route::post('/logout', [App\Http\Controllers\App\Auth\LoginController::class, 'logout'])
        ->name('app.logout');
    // User Authentication
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [App\Http\Controllers\App\Auth\RegisterController::class, 'showRegistrationForm'])->name('app.register');
        Route::post('/register', [App\Http\Controllers\App\Auth\RegisterController::class, 'register']);
        Route::get('/login', [App\Http\Controllers\App\Auth\LoginController::class, 'showLoginForm'])->name('app.login');
        Route::post('/login', [App\Http\Controllers\App\Auth\LoginController::class, 'login']);
    });

    // Password Reset Routes
    Route::get('/forgot-password', [App\Http\Controllers\App\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('/forgot-password', [App\Http\Controllers\App\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [App\Http\Controllers\App\Auth\ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [App\Http\Controllers\App\Auth\ResetPasswordController::class, 'reset'])
        ->name('password.update');
    //
    //    // Email Verification
    //    Route::get('/email/verify', [App\Http\Controllers\App\Auth\VerificationController::class, 'show'])
    //        ->middleware('auth')
    //        ->name('app.verification.notice');
    //    Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\App\Auth\VerificationController::class, 'verify'])
    //        ->middleware(['auth', 'signed'])
    //        ->name('app.verification.verify');
    //    Route::post('/email/verification-notification', [App\Http\Controllers\App\Auth\VerificationController::class, 'resend'])
    //        ->middleware(['auth', 'throttle:6,1'])
    //        ->name('app.verification.send');

});

