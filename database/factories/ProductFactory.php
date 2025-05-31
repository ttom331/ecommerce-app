<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'name' => fake()->randomElement(['Chair', 'Armchair', 'Sofa', 'Recliner', 'Bench', 'Stool', 'Ottoman', 'Bean bag',
            'Cupboard', 'Wardrobe', 'Dresser', 'Chest of drawers', 'Bookshelf', 'Cabinet',
            'Sideboard', 'TV stand']),    
            'category_id' => Category::factory(),        
            'price' => fake()->randomFloat(2, 50, 1000),
            'description' => fake()->sentence(15),
            'image' => 'http://ecommerce-app.test/storage/images/products/sofa1.png',
            'image2' => 'http://ecommerce-app.test/storage/images/products/sofa2.jpg',
            'featured' => fake()->boolean(50),
        ];
    }
}
