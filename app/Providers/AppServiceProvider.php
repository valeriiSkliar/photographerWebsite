<?php

namespace App\Providers;

use App\Models\Contact;
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
        view()->composer('includes.footer', function ($view) {
            $contact = Contact::find(1);

            if ($contact) {
                $excludedFields = ['id', 'created_at', 'updated_at'];

                $filteredFields = array_filter($contact->toArray(), function ($value, $key) use ($excludedFields) {
                    return $value !== null && !in_array($key, $excludedFields);
                }, ARRAY_FILTER_USE_BOTH);

                $view->with('contact', $filteredFields);
            } else {
                $view->with('contact', []);
            }
        });


        view()->composer([
            'includes.header',
            'sectionComponents.frontend.section_page_thumbnail',
            'includes.admin.*'
        ], function ($view){
            $view->with('pages', Page::all());
        });

        view()->composer(['includes.header'], function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
