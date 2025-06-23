<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\BasketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestBasketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'nullable|exists:colors,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'deal_price' => 'nullable|numeric|min:0',
        ]);

        if ($attributes['color_id'] === '') {
            $attributes['color_id'] = null;
        }

        $basket = session()->get('basket', []);
        $product = Product::findOrFail($attributes['product_id']);
        $found = false;
        $message = "Successfully added to basket!";
        $success = true;
        foreach ($basket as &$item) { //& used to directly reference, not a copy, allow to make changes
            if ($attributes['color_id'] === null) {
                if ($attributes['product_id'] == $item['product_id']) {
                    if ($product->stock > ($item['quantity'] + $attributes['quantity'])) {
                        $item['quantity'] += $attributes['quantity'];
                        $found = true;
                        break;
                    } else {
                        $found = true;
                        $message = "Item already in basket, could not add quantity to basket, exceeds stock.";
                        $success = false;
                    }
                }
            } else {
                if ($attributes['product_id'] == $item['product_id'] && $attributes['color_id'] == $item['color_id']) {
                    $color_product = DB::table('color_product')->where('product_id', $attributes['product_id'])->where('color_id', $attributes['color_id'])->firstOrFail();
                    if ($color_product->stock >=  $item['quantity'] + $attributes['quantity']) {
                        $item['quantity'] += $attributes['quantity'];
                        $found = true;
                        break;
                    } else {
                        $found = true;
                        $message = "Item already in basket, could not add quantity to basket, exceeds stock.";
                        $success = false;
                    }
                }
            }
        }

        $found ? session()->put('basket', $basket) :  session()->push('basket', $attributes);

        return back()->with($success ? 'success' : 'error', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $oldbasket = session('basket', []);

        $basket = collect($oldbasket)->map(function ($item) { //collection so i can access product informatiom, display name etc,
            return [
                'product' => Product::find($item['product_id']),
                'color_id' => $item['color_id'] ?? null,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'deal_price' => $item['deal_price'] ?? null
            ];
        });
        return view('basket.show', ['basket' => $basket]);
    }

    public function remove(Request $request)
    {
        $attributes = $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'nullable|exists:colors,id',
        ]);

        if (!isset($attributes['color_id']) || $attributes['color_id'] === '') {
            $attributes['color_id'] = null;
        }


        //getting a reference and then rewrting the actual session with the refernce
        $basket = session()->get('basket', []);
        foreach ($basket as $key => &$item) { //& used to directly reference, not a copy, allow to make changes
            if ($attributes['color_id'] === null) {
                if ($attributes['product_id'] == $item['product_id']) {
                    unset($basket[$key]);
                }
            } else {
                if ($attributes['product_id'] == $item['product_id'] && $attributes['color_id'] == $item['color_id']) {
                    unset($basket[$key]);
                }
            }
        }

        session()->put('basket', $basket);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $attributes = $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'nullable|exists:colors,id',
            'quantity' => 'required',
            'quantity_action' => 'required',
        ]);

        if (!isset($attributes['color_id']) || $attributes['color_id'] === '') {
            $attributes['color_id'] = null;
        }

        $basket = session()->get('basket', []);
        foreach ($basket as $key => $item) {
            if ($attributes['color_id'] === null) {
                if ($attributes['product_id'] == $item['product_id']) {
                    if ($attributes['quantity_action'] === 'decrement') {
                        $basket[$key]['quantity'] = max(1, $basket[$key]['quantity'] - 1); //cant go below zero
                    } else if ($attributes['quantity_action'] === 'increment') {
                        $basket[$key]['quantity'] += 1;
                    }
                }
            } else {
                if ($attributes['product_id'] == $item['product_id'] && $attributes['color_id'] == $item['color_id']) {
                    if ($attributes['quantity_action'] === 'decrement') {
                        $basket[$key]['quantity'] = max(1, $basket[$key]['quantity'] - 1); //cant go below zero
                    } else if ($attributes['quantity_action'] === 'increment') {
                        $basket[$key]['quantity'] += 1;
                    }
                }
            }
        }
        session()->put('basket', $basket);
        $guestBasket = BasketService::getGuestBasket();

        return response()->json([
            'success' => true,
            'guestBasket' => $guestBasket,

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
