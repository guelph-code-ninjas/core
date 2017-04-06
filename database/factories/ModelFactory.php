<?php


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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Course::class, function (Faker\Generator $faker) {

    // Ideally we should be adding adding this as a provider to the faker
    // https://github.com/fzaninotto/Faker/#faker-internals-understanding-providers

    $name = function () use ($faker) {
        $prefix = ['CIS', 'MATH', 'STAT'];
        return $faker->randomElement($prefix) . $faker->randomNumber(4);
    };

    $n = $name();
    return [
        'name'  => $n,
        'slug'  => $n,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Assignment::class, function(Faker\Generator $faker) {
    $name = "A". $faker->randomNumber(1);
    $desc = $faker->sentences($faker->randomNumber(2), true);

    $start = $faker->dateTime();
    $end = $faker->dateTime();

    if ($end < $start) {
        $swap = $end;
        $end = $start;
        $start = $end;
    }

    return [
        'name' => $name,
        'slug' => $name,
        'description' => $desc,
        'start' => $start,
        'due' => $end,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Repository::class, function (Faker\Generator $faker) {
    $name = "A". $faker->randomNumber(1);
    $start = $faker->dateTime();
    $end = $faker->dateTime();

    return [
        'name' => $name,
        'path' => 'repositories/'.$name,
        'backend' => 'git',
    ];
});
