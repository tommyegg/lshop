<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $url = 'lshop.test/storage/images/example-img';
        $image = $this->faker->randomElement([
            "http://{$url}/1.jpeg",
            "http://{$url}/2.jpeg",
            "http://{$url}/3.jpeg",
            "http://{$url}/4.jpeg",
            "http://{$url}/5.jpeg",
            "http://{$url}/6.jpeg",
            "http://{$url}/7.jpeg",
            "http://{$url}/8.jpeg",
            "http://{$url}/9.jpeg",
        ]);

        return [
            'title'        => $this->faker->word,
            'description'  => $this->faker->sentence,
            'image'        => $image,
            'on_sale'      => true,
            'rating'       => $this->faker->numberBetween(0, 5),
            'sold_count'   => 0,
            'review_count' => 0,
            'price'        => 0,
        ];
    }
}
