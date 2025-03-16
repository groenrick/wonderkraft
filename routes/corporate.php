<?php

use App\Http\Controllers\Corporate\ContactController;
use App\Http\Controllers\Corporate\HomeController;
use App\Http\Controllers\Corporate\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Corporate/Marketing Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'as' => 'corporate.',
    'domain' => config('app.domains.corporate'),
], function () {
    // Main Pages
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');

    // Product Information
    Route::get('/features', [PageController::class, 'features'])->name('features');
    Route::get('/solutions', [PageController::class, 'solutions'])->name('solutions');
    Route::get('/roadmap', [PageController::class, 'roadmap'])->name('roadmap');
    Route::get('/changelog', [PageController::class, 'changelog'])->name('changelog');

    // Resources
    //    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    //    Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/blog', function () {
        return '';
    })->name('blog');
    Route::get('/blog/{post:slug}', function () {
        return '';
    })->name('blog.show');
    Route::get('/docs', [PageController::class, 'docs'])->name('docs');
    Route::get('/tutorials', [PageController::class, 'tutorials'])->name('tutorials');
    Route::get('/api', [PageController::class, 'api'])->name('api');

    // Company
    Route::get('/careers', [PageController::class, 'careers'])->name('careers');
    Route::get('/security', [PageController::class, 'security'])->name('security');

    // Legal
    Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [PageController::class, 'terms'])->name('terms');

    // Forms
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
    Route::post('/newsletter', [ContactController::class, 'newsletter'])->name('newsletter.submit');

    // Support & Documentation
    Route::get('/support', [PageController::class, 'support'])->name('support');
    Route::get('/docs', [PageController::class, 'docs'])->name('docs');
    //    Route::get('/api-docs', [PageController::class, 'apiDocs'])->name('api');

    // Tutorials & Resources
    Route::get('/tutorials', [PageController::class, 'tutorials'])->name('tutorials');
    Route::get('/resources', [PageController::class, 'resources'])->name('resources');

    // Updates & News
    Route::get('/updates', [PageController::class, 'updates'])->name('updates');
    Route::get('/news', [PageController::class, 'news'])->name('news');

    // Partners & Integrations
    Route::get('/partners', [PageController::class, 'partners'])->name('partners');
    Route::get('/integrations', [PageController::class, 'integrations'])->name('integrations');

    // Demo
    Route::get('/demo', [PageController::class, 'demo'])->name('demo');
    Route::post('/request-demo', [PageController::class, 'requestDemo'])->name('demo.request');
});
