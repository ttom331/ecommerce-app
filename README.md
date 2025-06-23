23/06/25

Features Implemented

Basket for guest users only currently.
- Users are able to add, remove and adjust the quantity of items in the basket.
- Some products have different colors and each color has different stock. This was successfull by creating a color and a color_product table. Relationships were created in the model to allow products with different colors to have different stocks. Stock without colors just have their own stock attribute. 
- First time using ajax request for changing the quantity, doesn't require page reload. Basket is still being worked on.
- Integrated Stripe API for adding checkout for guest users only currently. Users can purchase the orders with stripe api integration and use webhooks events (checkout.session.completed) to store orders to database.
- Had to create 3 new Order tables and their relationships. (orders, order_addresses and order_items)


🛒 E-Commerce Portfolio Project
Date: 23/06/25

Features Implemented
🧺 Basket and Checkout Functionality (Guest Users Only — In Progress)
    - Users can add, remove, and adjust item quantities in the basket.
    - AJAX-based quantity updates (no page reload required), First time using ajax, still learning this.
    -Products with color variations are managed via:
        -colors and color_product tables.
        -Each color has its own stock count.
        -Products without colors retain a single stock attribute.
    -Basket integrates with Stripe API for secure Checkout currently only for guest purchases only.
    -Stripe webhooks (checkout.session.completed) store completed orders in the database.

🧾 Orders System
Implemented 3 related tables:
    -orders
    -order_addresses
    -order_items
    -Captures and stores guest order details after successful payment. Will work on authentication users at a later date.


Upcoming and Work in Progress:
🛠️ Admin Panel
Admin dashboard to:
    - Manage products, categories, subcategories, colors, and stock
    - View customer orders and payment statuses

🧺 Basket and Checkout Functionality (For authenticated users)

Allow users to view their orders and order items. 

Continue to develop stock validation before user checkout


Date: 23/06/25

 Features Implemented
🔐 Authentication
- Custom user signup and login system.

- Role-based access control using pivot table:

- Users ↔️ Roles (Admin, Customer)

🗃️ Database & Relationships
- Database migrations created for:

- Products, Colors, Categories, Subcategories, Roles

- Pivot tables for many-to-many relationships:

- Products ↔️ Colors

- Users ↔️ Roles

One-to-many & nested relationships:

- Categories → Subcategories

- Products → Categories

📦 Product Management
Category page built to:

- View all products under a selected category

- Search through categories and subcategories

- Display products in a subcategory using Eloquent relationships


🛠️ Admin Panel
Admin dashboard to:

- Manage products, categories, subcategories, colors, and stock

- View customer orders and payment statuses







<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
