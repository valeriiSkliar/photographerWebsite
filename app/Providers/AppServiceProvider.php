<?php

namespace App\Providers;

use App\Models\Album;
use App\Models\Contact;
use App\Models\MetaData\MetaTagsNameVariants;
use App\Models\MetaData\MetaTagsPropertyVariants;
use App\Models\MetaData\MetaTegType;
use App\Models\Page;
use App\Services\SessionMessageService;
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
        $this->app->singleton(SessionMessageService::class, function ($app) {
            return new SessionMessageService();
        });

        view()->composer('includes.footer', function ($view) {
            $contact = Contact::find(1);

            if ($contact) {
                $excludedFields = ['id', 'created_at', 'updated_at'];

                $filteredFields = array_filter($contact->toArray(), function ($value, $key) use ($excludedFields) {
                    return $value !== null && !in_array($key, $excludedFields);
                }, ARRAY_FILTER_USE_BOTH);

                $view->with('contact', $contact);
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

        view()->composer([
            'includes.admin.*'
        ], function ($view){
            $view->with('albums', Album::all());
        });

        view()->composer([
            'includes.admin.*'
        ], function ($view){
            $view->with('metaTagTypes', MetaTegType::all());
            $view->with('meta_tags_properties', MetaTagsPropertyVariants::all());
            $view->with('meta_tags_names', MetaTagsNameVariants::all());
        });

        view()->composer(['includes.header'], function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
