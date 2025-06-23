<?php

namespace App\Providers;

use App\Models\Product;
use App\Services\BasketService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Ramsey\Uuid\Type\Decimal;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $basketGuestCount = count(session('basket', []));
            $view->with('guestBasketCount', $basketGuestCount);
        });

        View::composer('*', function ($view) {
            $view->with('guestBasket', BasketService::getGuestBasket());
        });

        View::composer('*', function ($view){
            $basket = session('basket', []);
            $basket_total = collect($basket)->reduce(function ($carry, $item){
                return $carry + ($item['price'] * (int) $item['quantity']);
            }, 0);

            $percentage = round(($basket_total / 500) * 100);
            $percentage = $percentage > 100 ? 100 : $percentage; //ensure it doesnt go past 100% 

            $view->with(['basket_total' => $basket_total, 'percentage' => $percentage]);
        });
    }
}
