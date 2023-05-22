<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\My_Parent;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(My_Parent::class, function (Faker $faker) {
    return [

        'Email' => $faker->unique()->safeEmail,
        'Password' => Hash::make('password'),
        'Name_Father' => $faker->name,
        'National_ID_Father' => $faker->numberBetween(1000000000, 9999999999),
        'Passport_ID_Father' => $faker->numberBetween(1000000000, 9999999999),
        'Phone_Father' =>$faker->numberBetween(1000000000, 9999999999),
        'Job_Father' => $faker->jobTitle,
        'Nationality_Father_id' => 1,
        'Blood_Type_Father_id' => $faker->randomElement([1, 2,3,4,5,6,7,8]),
        'Religion_Father_id' => $faker->randomElement([1, 2]),
        'Address_Father' => $faker->address,
        'Name_Mother' => $faker->name,
        'National_ID_Mother' =>$faker->numberBetween(1000000000, 9999999999),
        'Passport_ID_Mother' => $faker->numberBetween(1000000000, 9999999999),
        'Phone_Mother' => $faker->numberBetween(1000000000, 9999999999),
        'Job_Mother' => $faker->jobTitle,
        'Nationality_Mother_id' => 1,
        'Blood_Type_Mother_id' => $faker->randomElement([1, 2,3,4,5,6,7,8]),
        'Religion_Mother_id' => $faker->randomElement([1, 2]),
        'Address_Mother' => $faker->address,

    ];
});
