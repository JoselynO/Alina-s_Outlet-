<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();

        return [
            'id' => Str::uuid(),
            'sex' => $this->faker->randomElement(['male', 'female', 'unisex']), // Ajusta los valores generados para el campo 'sex'
            'description' => $this->faker->text(),
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'price_before' => $this->faker->randomFloat(2, 1, 100),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fmodels.com%2Fwork%2Fversace-dua-x-donatella&psig=AOvVaw3mSZKTbCMIxh7cHD-vGPrx&ust=1718036313734000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCPDr-JT2zoYDFQAAAAAdAAAAABAK',
            'category_id' => $category->id
        ];
    }
}

