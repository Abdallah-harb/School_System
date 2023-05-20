<?php

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GenderDBSeeder extends Seeder
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

        DB::table('genders')->truncate();
        Schema::enableForeignKeyConstraints();

        //insert all blood types when run seeder

        $genders= [
            ['en' => 'male' , 'ar' => 'ذكر'],
            ['en' => 'female' , 'ar' => 'أنثى'],
        ];
        foreach ($genders as $gender){

           Gender::create(['name' => $gender]);
        }
    }
}
