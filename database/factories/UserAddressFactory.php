<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Sodium\add;

class UserAddressFactory extends Factory
{
    protected $model = UserAddress::class;

    public function definition()
    {
        $addresses = [
            ['台灣','台灣省',"台中市", "南區"],
            ['台灣','台灣省',"新北市", "中和區"],
            ['台灣','台灣省',"台北市", "大安區"],
            ['台灣','台灣省',"台南市", "安平區"],
        ];
        $address   = $this->faker->randomElement($addresses);

        return [
            'country'        => $address[0],
            'province'      => $address[1],
            'city'          => $address[2],
            'district'      => $address[3],
            'address'       => sprintf('%d号', $this->faker->randomNumber(3)),
            'zip'           => $this->faker->postcode,
            'contact_name'  => $this->faker->name,
            'contact_phone' => $this->faker->phoneNumber,
        ];
    }
}
