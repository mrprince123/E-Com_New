<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $product = new Product;
        // $product->name = 'Samsung Galaxy Max 14 Pro Plus';
        // $product->description = 'This is the best and top notch samsung phone - Samusng Galaxy Note 14 Pro Max';
        // $product->price = '99999';
        // $product->product_pic = 'https://www.gizmochina.com/wp-content/uploads/2023/08/Samsung-Galaxy-S24-Ultra-453x453.jpg';
        // $product->detail_description = 'This is the Brand new Phone from the Samsung Brand, which is directly imported from the market of the china and korea.';
        // $product->category_id = '1';
        // $product->save();


        $faker = Faker::create();

        for ($i = 0; $i <= 120; $i++) {
            $product = new Product;
            $product->name = $faker->name;
            $product->description = $faker->realText;
            $product->price = $faker->numberBetween(10, 99999);
            $product->product_pic = $faker->imageUrl();
            $product->detail_description = $faker->realText(200);
            $product->category_id = $faker->randomElement([5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]);
            $product->save();
        }

    }
}
