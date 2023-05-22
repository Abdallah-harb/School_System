<?php

use App\Models\My_Parent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MyParentDataBaseSeeder extends Seeder
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
        DB::table('my__parents')->truncate();
        Schema::enableForeignKeyConstraints();

        factory(My_Parent::class ,10)->create();
    }
}
