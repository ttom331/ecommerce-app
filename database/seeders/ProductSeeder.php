<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(20)->create(new Sequence([
            'category_id' => 1
        ],
        [
            'category_id' => 2
        ],
        [
            'category_id' => 3
        ],
        [
            'category_id' => 4
        ]

        ));
        
    }
}
