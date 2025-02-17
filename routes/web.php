<?php

use App\Http\Controllers\App\AppController;
use App\Http\Controllers\App\PageController as AppPageController;
use App\Http\Controllers\Public\PageController as PublicPageController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/app',
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
});

// This goes AFTER your admin routes
Route::get('/{slug}', [PublicPageController::class, 'show'])
    ->where('slug', '.*') // Allows for nested slugs like "about/team"
    ->name('pages.show');
