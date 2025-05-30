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
        Product::factory(20)->create(new Sequence(
            [
                'category_id' => 1,
                'sub_category_id' => 1
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 2
            ],
            [
                'category_id' => 2,
                'sub_category_id' => 3
            ],
            [
                'category_id' => 2,
                'sub_category_id' => 4
            ],
            [
                'category_id' => 3,
                'sub_category_id' => 5
            ],
            [
                'category_id' => 4,
                'sub_category_id' => 6
            ],
            [
                'category_id' => 5,
                'sub_category_id' => 7
            ],
            [
                'category_id' => 6,
                'sub_category_id' => 8
            ]

        ));
    }
}
