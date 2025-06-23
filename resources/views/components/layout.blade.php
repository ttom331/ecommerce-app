<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;900&display=swap" rel="stylesheet">
    <title>InSofa</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-[#F8F8F8]">
    <div id="basketOverlay" class="fixed w-full h-full right-500 bg-black opacity-0 z-2501 transition-opacity duration-1000 ease-in-out"></div>
    <div class="">
        <nav class="flex justify-between items-center py-5 px-4 md:px-12 fixed top-0 left-0 w-full z-1000 bg-white shadow">
            <div class="font-bold text-xl">
                <a href="/" class="hidden md:block text-3xl">
                    <h1>InSofa</h1>
                </a>
                <a id="menu-button" class="md:hidden cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="28" height="28" viewBox="0 0 50 50">
                        <path d="M 0 9 L 0 11 L 50 11 L 50 9 Z M 0 24 L 0 26 L 50 26 L 50 24 Z M 0 39 L 0 41 L 50 41 L 50 39 Z"></path>
                    </svg>
                </a>
            </div>

            <div>
                <div class="space-x-10 hidden md:flex text-sm uppercase font-extrabold">
                    <a href="/">Furniture</a>
                    <a href="/">Shop</a>
                    <a href="/">About Us</a>
                    <a href="/">Contact</a>
                </div>
            </div>

            <!--The logo shows in center of nav on small screens -->
            <div class="absolute md:hidden left-1/2 transform -translate-x-1/2">
                <a href="/" class="font-bold text-xl">InSofa</a>
            </div>

            <div class="flex space-x-4">
                <!-- profile sends user to login if a guest -->
                @guest
                <a href="/login">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </a>
                @endguest
                <!-- if authorised, the user will have a profile dropdown on click to vie waccount of signout-->
                @auth
                <div class="relative group">
                    <div id="profile-icon" class="p-0 m-0 border-0 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <div id="profile-menu" class="absolute hidden bg-white px-2 z-1 w-25 right-0 top-10 space-y-2 outline-2 outline-gray-50 text-end shadow-xl/90 py-3 ">
                        <a class="block hover:bg-gray-200 text-xs px-2 cursor-pointer mx-auto">My Account</a>
                        <form method="POST" action="/logout">
                            @csrf
                            @method('DELETE')
                            <button class="block hover:bg-gray-200 text-xs px-2 cursor-pointer text-end justify-end mx-auto">Log Out</button>
                        </form>
                    </div>
                </div>
                @endauth
                <!-- basket/shopping bag-->
                <div id="basket" class="relative cursor-pointer">
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </a>
                    @guest
                    @if ($guestBasketCount > 0)
                    <div class="absolute {{ $guestBasketCount > 9 ? 'top-[44%] left-[27%]' : 'top-[44%] left-[40%]' }} rounded-4xl text-xs text-black">
                        <p>{{ $guestBasketCount }}</p>
                    </div>
                    @endguest
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <div id="mobile-menu" class="md:hidden hidden flex-col space-y-2 text-xl transition-all duration-500 ease-in-out mt-16 fixed bg-white z-10001 w-full h-full">
        <ul>
            <li class="border-t-1 border-gray-300 py-5 px-10 font-extrabold "><a href="/">InSofa</a></li>
            <li class="border-y-1 border-gray-200 py-5 px-10"><a href="/">Furniture</a></li>
            <li class="border-b-1 border-gray-200 py-5 px-10"><a href="/">Shop</a></li>
            <li class="border-b-1 border-gray-200 py-5 px-10"><a href="/">About Us</a></li>
            <li class="border-b-1 border-gray-200 px-10 py-5"><a href="/">Contact</a></li>
        </ul>
    </div>
    @guest
    <x-guest-basket/>
    @endguest
    <main class="pt-15 px-2">
        {{ $slot }}
    </main>
@vite('resources/js/app.js')
</body>

</html>