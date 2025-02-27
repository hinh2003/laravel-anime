<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Status;
use Carbon\Carbon;
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
        View::composer('Client/Banner/index', function ($view) {
            $now = Carbon::now();

            $banners = Banner::where('status', 1)
                ->where('start_date', '<=', $now)
                ->where('end_date', '>=', $now)
                ->orderBy('priority', 'asc')
                ->take(10)->get();
            $view->with(compact('banners'));

        });
    }
}
