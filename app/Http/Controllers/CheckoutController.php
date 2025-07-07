<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function checkout()
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $basket = session('basket', []);
        $lineItems = [];

        foreach ($basket as $item) { //this adds every item in the current basket to the line items 
            $product = Product::findOrFail($item['product_id']);
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'gbp',
                    'product_data' => [
                        'name' => $product->name,
                        'metadata' => [ //had to add some meta data so i can store the product id in the order items in future 
                            'product_id' => $product->id,
                            'color' => $item['color'],
                        ]
                    ],
                    'unit_amount' => (int) ($item['price'] * 100),
                ],
                'quantity' => (int) $item['quantity'],
            ];
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',

            'shipping_address_collection' => [
                'allowed_countries' => ['GB'],
            ],

            'billing_address_collection' => 'required',


            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('home'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        session()->forget('basket'); //this empties the basket after checkout
        $products = Product::with(['category'])->where('featured', true)->latest()->take(8)->get(); //simplePaginate(8); //need to add checks, error if there are no products with or without feautred.
        $category = Category::get();
        return view('index', [
            'featuredProducts' => $products,
            'categories' => $category,
        ]);
    }




    public function webhook(Request $request)
    {
        Log::info('Stripe webhook called');

        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            Log::error('Invalid payload');
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Invalid signature');
            return response('Invalid signature', 400);
        }

        Log::info('Stripe event type: ' . $event->type);

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            Log::info('Checkout session ID: ' . $session->id);
            Log::info('Customer email: ' . $session->customer_details->email ?? 'No email');
            try {
                $order = Order::create([ //create the order
                    'guest_email' => $session->customer_details->email,
                    'total_amount' => $session->amount_total / 100,
                ]);
                Log::info('Order created with ID: ' . $order->id);

                OrderAddress::create([ //order addresses is created
                    'order_id' => $order->id, //using id from the order just created
                    'shipping_name' => $session->customer_details->name ?? 'N/A', 
                    'shipping_address1' => $session->customer_details->address->line1 ?? '',
                    'shipping_address2' => $session->customer_details->address->line2 ?? '',
                    'shipping_city' => $session->customer_details->address->city ?? '',
                    'shipping_code' => $session->customer_details->address->postal_code ?? '',
                ]);
                Log::info('OrderAddress created for order ID: ' . $order->id);

                $stripe = new \Stripe\StripeClient((config('stripe.sk')));
                $lineItems = $stripe->checkout->sessions->allLineItems($session->id, []);
                foreach ($lineItems->data as $item) { 
                    $stripeProductId = $item->price->product; //retrieve stripe product id e.g. "product": "prod_SYGQiazGHaw2qG",
                    $stripeProduct = $stripe->products->retrieve($stripeProductId); 
                    $dbProductId = $stripeProduct->metadata->product_id ?? null; //this get the id from the db, that I added as meta data earlier
                    Log::info($dbProductId);
                    OrderItem::create([ //Creates the order item for each item in the checkout line items (basket)
                        'product_id' => $dbProductId,
                        'order_id' => $order->id,
                        'product_name' => $item->description,
                        'quantity' => $item->quantity,
                        'price' => (int) ($item->amount_subtotal / 100)
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Order creation failed: ' . $e->getMessage());
            }
        }

        return response('Webhook received', 200);
    }
}
