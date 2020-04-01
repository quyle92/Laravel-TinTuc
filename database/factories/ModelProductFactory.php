<?php
use Fake\Generator as Faker;
use App\Model\Product;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */


$factory->define(App\Model\Product::class, function (Fake\Generator $faker) {
    

    return [
        'name' => $faker->word,
        'detail' => $faker->paragraph,
        'price' => $faker->numberBetween(100,1000),
        'stock' => $faker->randomDigit,
        'discount' => $faker->numberBetween(2,30)
    ];
});




