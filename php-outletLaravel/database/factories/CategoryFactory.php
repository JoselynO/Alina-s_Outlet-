<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fmodels.com%2Fwork%2Fversace-dua-x-donatella&psig=AOvVaw3mSZKTbCMIxh7cHD-vGPrx&ust=1718036313734000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCPDr-JT2zoYDFQAAAAAdAAAAABAK',
            'isDeleted' => false,
        ];
    }
}
