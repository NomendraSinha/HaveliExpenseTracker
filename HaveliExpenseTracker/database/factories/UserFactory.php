<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Expense::class, function (Faker $faker) {
	$dates = ['15/02/2018','14/02/208','12/02/2018','10/02/2018','22/01/2018','24/01/2018','28/01/2018'];
    return [
        'user_id' => App\User::all()->random()->id,
        'date' => $dates[rand(0, 5)],
        'amount' => rand(100,10000),
        'purpose' => $faker->text(100),
    ];
});
