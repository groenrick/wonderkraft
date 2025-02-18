<?php

namespace App\Providers;

use App\ContentBlocks\CtaBlock;
use App\ContentBlocks\FeaturesGridBlock;
use App\ContentBlocks\GalleryBlock;
use App\ContentBlocks\HeroBlock;
use App\ContentBlocks\StatsBlock;
use App\ContentBlocks\TestimonialsBlock;
use App\ContentBlocks\TitleParagraphBlock;
use App\Services\ContentBlockService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory as ViewFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ContentBlockService::class, function ($app) {
            $service = new ContentBlockService($app->make(ViewFactory::class));

            // Register blocks
            $service->register(TitleParagraphBlock::class);
            $service->register(HeroBlock::class);
            $service->register(CtaBlock::class);
            $service->register(FeaturesGridBlock::class);
            $service->register(GalleryBlock::class);
            $service->register(StatsBlock::class);
            $service->register(TestimonialsBlock::class);

            return $service;
        });

        View::composer('*', function ($view) {
            $view->with('currentSite', app('site'));
            $view->with('currentDomain', app('domain'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
