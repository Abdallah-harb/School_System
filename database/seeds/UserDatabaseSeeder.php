<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //when run seed delete old data from blood table , not dublacated it
        Schema::disableForeignKeyConstraints();

        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();


        $user = new User([
            'name' => "Abdallah",
            'email' => 'abdallah@gmail.com',
            'password' => Hash::make('Abdallah15'),
        ]);
        $user->save();
    }
}
