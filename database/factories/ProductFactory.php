<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => function () {
            return Category::inRandomOrder()->first()->id;
        },
        'name'          => $faker->name,
        'description'   => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
        'policy'        => 'Los aceros prepintados de Ternium Siderar responden a las normas IRAM-IAS U 500-72 Los aceros prepintados de Ternium Siderar responden a las normas IRAM-IAS U 500-72'
    ];
});
