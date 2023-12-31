<?php

namespace App\Providers;

use App\Models\Album;
use App\Models\Component\Component;
use App\Models\Contact;
use App\Models\MetaData\MetaTagsNameVariants;
use App\Models\MetaData\MetaTagsPropertyVariants;
use App\Models\MetaData\MetaTegType;
use App\Models\Page;
use App\Services\SessionMessageService;
use DateTime;
use Exception;
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

        view()->composer(['includes.footer', 'sectionComponents.frontend.contacts_component', 'layouts.app'], function ($view) {
            $contact = Contact::find(1);

            $getSeoDate = function (string $sqlDate) {
                // Assuming you have a timestamp or date string
                $time = strtotime($sqlDate);

                // Create a DateTime object
                $date = new DateTime("@$time");

                // Format the date in ISO 8601
                return $date->format("Y-m-d\TH:i:sP");
            };

            if ($contact) {
                $view->with(['contact' => $contact, 'getSeoDate' => $getSeoDate]);
            } else {
                $view->with(['contact' => [], 'getSeoDate' => $getSeoDate]);
            }
        });

        view()->composer([
            'includes.header',
            'sectionComponents.frontend.section_page_thumbnail',
            'includes.admin.*'
        ], function ($view) {
            $view->with('pages', Page::all());
        });

        view()->composer([
            'includes.admin.*'
        ], function ($view) {
            $view->with('albums', Album::all());
        });

        view()->composer([
            'includes.admin.*'
        ], function ($view) {
            $view->with('components', Component::all());
        });

        view()->composer([
            'includes.admin.*'
        ], function ($view) {
            $view->with('metaTagTypes', MetaTegType::all());
            $view->with('meta_tags_properties', MetaTagsPropertyVariants::all());
            $view->with('meta_tags_names', MetaTagsNameVariants::all());
        });

        view()->composer(['includes.header'], function ($view) {
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
