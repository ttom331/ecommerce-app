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
            'Sideboard', 'TV stand', 'Double Bed', 'Mirror']),    
            'category_id' => Category::factory(),        
            'price' => fake()->randomFloat(2, 50, 1000),
            'description' => fake()->sentence(100),
            'image' => 'sofa1.png',
            'image2' => 'sofa2.jpg',
            'featured' => fake()->boolean(50),
            'stock' => fake()->numberBetween(0, 30),
        ];
    }
}
