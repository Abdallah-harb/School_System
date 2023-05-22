<?php

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TeacherDataBaseSeeder extends Seeder
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
        DB::table('teachers')->truncate();
        Schema::enableForeignKeyConstraints();

        factory(Teacher::class ,10)->create();
    }
}
