<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Success</title>
</head>

<body style="text-align: center;">
    <h1 style="text-align: center; color:black; font-family: 'Questrial', sans-serif;">Order #{{ $data['order_id'] }} Confirmed</h1>
    <h2 style="text-align: center; color:black; font-family: 'Questrial', sans-serif; margin-top: 2%;">Thank you for your purchase!</h2>
    <p style="text-align: center; color:black; font-family: 'Questrial', sans-serif; margin-top: 2%;">We're getting your order ready to be shipped. We will notify you when it has been sent.</p>
    <h2 style="margin-top: 10%;">Order Summary</h2>
    @foreach ($data['order_items'] as $item )
    <div class="product-container">
        <img src="{{ asset('images/products' . $item->product->image) }}" alt="{{ $item->product->name }}" />
        <p>{{ $item->product->name }}</p>
        <p>x{{ $item->quantity }}</p>
        <p>£{{ $item->price }}</p>
    </div>
    @endforeach
</body>

</html>


<style>
    body {
        font-family: "Questrial", sans-serif;
        overflow-x: hidden;
        --font-weight-extrablack: 1000;

    }

    img {
        justify-content: center;
        height: 75px;
        width: 75px;
        object-fit: contain;
    }

    .product-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2px;
        font-size: 12px;
    }
</style>