<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(['includes.header', 'sectionComponents.frontend.section_page_thumbnail'], function ($view){
            $view->with('all_pages', Page::all());
        });

        view()->composer(['includes.header'], function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
