<?php

use Carbon\Carbon;

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
$factory->define(App\Rental::class, function (Faker\Generator $faker) {
    return [
        'start_date'   => strtotime(str_replace('/', '-', '10/10/1995')),
        'end_date'     => strtotime(str_replace('/', '-', '11/10/1995')),
        'group'        => $faker->name,
        'phone_number' => $faker->phoneNumber,
        'email'        => $faker->email
    ];
});

$factory->define(App\RentalStatus::class, function (Faker\Generator $faker) {
    return [
        'name'   => $faker->word,
        'class'  => $faker->word,
    ];
});

$factory->define(App\Groups::class, function (Faker\Generator $faker) {
    return [
        'selector'    => $faker->word,
        'sub_heading' => $faker->word,
        'heading'     => $faker->word,
        'description' => $faker->word,
    ];
});

$factory->define(App\Mailing::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Activity::class, function (Faker\Generator $faker) {
    // $faker->unixTime($max = 'now')                 -> (timestamp) 58781813
    // $faker->time($format = 'H:i:s', $max = 'now')  -> '20:49:42'

    return [
        'user_id'     => $faker->numberBetween(0, 4),
        'heading'     => $faker->text(200),
        'description' => $faker->text(200),
        'date'        => Carbon::now(),
        'start_time'  => Carbon::now(),
        'end_time'    => Carbon::now(),
        'state'       => 1,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    $themes = [
        'skin-black','skin-black-light',
        'skin-blue','skin-blue-light',
        'skin-green','skin-green-light',
        'skin-purple','skin-purple-light',
        'skin-red','skin-red-light',
        'skin-yellow','skin-yellow-light'
    ];

    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'avatar'         => '/path/to/avatar',
        'theme'          => $themes[array_rand($themes)],
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\NewsLetter::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'code'  => str_random(16),
    ];
});

$factory->define(App\MailingGroups::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->name,
        'class' => $faker->name,
    ];
});

$factory->define(App\Tags::class, function (Faker\Generator $faker) {
    $classes = [
        'label label-default', 'label label-primary',
        'label label-success', 'label label-info',
        'label label-warning', 'label label-danger'
    ];

    return [
        'name'   => $faker->word,
        'class'  => $classes[array_rand($classes)],
    ];
});

$factory->define(App\News::class, function (Faker\Generator $faker) {
    return [
        'state'   => 1,
        'user_id' => 1,
        'heading' => $faker->words(3, true),
        'content' => $faker->text(200),
    ];
});

$factory->define(Chrisbjr\ApiGuard\Models\ApiKey::class, function (Faker\Generator $faker) {
    return [
        'user_id'       => 1,
        'service'       => $faker->word,
        'key'           => str_random(40),
        'level'         => 10,
        'ignore_limits' => 0
    ];
});

$factory->define(Spatie\Permission\Models\Permission::class, function (Faker\Generator $faker) {
    return ['name' => 'active'];
});

$factory->define(Spatie\Permission\Models\Role::class, function (Faker\Generator $faker) {
    return ['name' => $faker->word];
});

$factory->define(App\Country::class, function (Faker\Generator $faker) {
    return [
        'capital'       => 'Brussels',
        'name'          => $faker->country,
        'alpha2code'    => 'BE',
        'alpha3code'    => $faker->countryISOAlpha3,
    ];
});

$factory->define(App\Members::class, function (Faker\Generator $faker) {
    return [
        'firstname'             => '',
        'lastname'              => '',
        'gender'                => '',
        'email'                 => '',
        'birth_date'            => '',
        'bank_number'           => '',
        'country'               => '',
        'street'                => '',
        'house_number'          => '',
        'house_sub_number'      => '',
        'phone_number'          => '',
        'mobile_number'         => '',
        'city'                  => '',
        'description'           => ''
    ];
});