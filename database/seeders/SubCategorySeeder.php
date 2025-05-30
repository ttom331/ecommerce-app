<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create(['category_id' => '1', 'name' => 'Arm Chair', 'slug' => 'arm-chair']);
        SubCategory::create(['category_id' => '1', 'name' => 'Wide Sofa', 'slug' => 'wide-sofa']);
        SubCategory::create(['category_id' => '2', 'name' => 'Cabinet', 'slug' => 'cabinet']);
        SubCategory::create(['category_id' => '2', 'name' => 'TV Unit', 'slug' => 'tv-unit']);
        SubCategory::create(['category_id' => '3', 'name' => 'Sofa Bed', 'slug' => 'sofa-bed']);
        SubCategory::create(['category_id' => '3', 'name' => 'Single Bed', 'slug' => 'single-bed']);
        SubCategory::create(['category_id' => '4', 'name' => 'Chair', 'slug' => 'chair']);
        SubCategory::create(['category_id' => '4', 'name' => 'Dining Table', 'slug' => 'dining-table']);


    }
}
