<?php

namespace App\Providers;

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
        \Illuminate\Support\Facades\View::composer('frontend.*', function ($view) {
            $view->with('courseCategories', \App\Models\CourseCategory::published()->orderBy('order_position')->get());

            // Share site settings globally — fixes the data-flow bug where many pages
            // referenced $siteSettings in Blade but never received it from their controller.
            $view->with('siteSettings', \App\Models\SiteSetting::pluck('setting_value', 'setting_key')->toArray());
        });
    }
}
