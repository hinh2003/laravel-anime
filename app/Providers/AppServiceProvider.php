<?php

namespace App\Providers;

use App\Models\Status;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category ;
use App\Models\Country ;
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
        View::composer('header', function ($view) {
            $categories = Category::all();
            $status = Status::all();
            $countries = Country::all();

            $view->with(compact('categories', 'status', 'countries'));
        });
    }
}
