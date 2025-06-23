<?php

namespace App\Services;

use App\Models\Product;

class BasketService
{
    public static function getGuestBasket()
    {
        $guestBasketSession = session('basket', []);
        return collect($guestBasketSession)->map(function ($item) { //collection so i can access product informatiom, display name etc,
            $product = Product::with('colors')->find($item['product_id']);
            if (!empty($item['color_id'])) {
                $selectedColor = $product->colors->find($item['color_id']);
            } else {
                $selectedColor = null;
            }

            $basket = session('basket', []);
            $basket_total = collect($basket)->reduce(function ($carry, $item){
                return $carry + ($item['price'] * (int) $item['quantity']);
            }, 0);

            $percentage = round(($basket_total / 500) * 100);
            $percentage = $percentage > 100 ? 100 : $percentage; //ensure it doesnt go past 100% 

            return [
                'product' => $product,
                'color' => $selectedColor,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'deal_price' => $item['deal_price'] ?? null,
                'percentage' => $percentage,
            ];
        });
    }
}