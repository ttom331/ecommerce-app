<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Vite;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'sofas', 'img' => "http://ecommerce-app.test/storage/images/categories/sofacat.jpg"]);
        Category::create(['name' => 'living', 'img' => "http://ecommerce-app.test/storage/images/categories/bedroomCat.jpg"]);
        Category::create(['name' => 'bedroom', 'img' => "http://ecommerce-app.test/storage/images/categories/diningroomCat.jpg"]);
        Category::create(['name' => 'dining', 'img' => "http://ecommerce-app.test/storage/images/categories/livingroom.jpg"]);
    }
}
