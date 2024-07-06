<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $table->string('name');
        // $table->unsignedBigInteger('user_id');
        // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        // $table->decimal('phone', 10, 0);
        // $table->string('locality');
        // $table->string('city');
        // $table->string('state');
        // $table->string('country');
        // $table->decimal('pincode', 6, 0);

        $faker = Faker::create();

        $address = new Address;
        $address->name = $faker->name;
        $address->user_id = "11";
        $address->phone = "1234567890";
        $address->locality = $faker->address;
        $address->city = $faker->city;
        $address->state = $faker->state;
        $address->country = $faker->country;
        $address->pincode = "201231";
        $address->save();

    }
}
