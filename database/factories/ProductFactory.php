<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use function Symfony\Component\Translation\t;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        return [
            "name" => $name,
            "slug" => Str::slug($name),
            "price" => random_int(100, 1000),
            "thumbnail" => "ace/img/product/product-".random_int(1, 12).".jpg",
            "quantity" => random_int(5, 100),
            "description" => $this->faker->text(1000),
            "category_id" => random_int(1, 10)
        ];
    }
}
