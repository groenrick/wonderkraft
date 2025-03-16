<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PageController as PublicPageController;

Route::get('/{slug}', [PublicPageController::class, 'show'])
    ->domain('{sub}.'.config('app.domains.customer'))
    ->where('slug', '.*')
    ->middleware([
        \App\Http\Middleware\ResolveCustomerDomain::class,
    ])
    ->name('pages.show');
