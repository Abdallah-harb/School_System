<?php

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GradeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //when run seed delete old data from blood table , not dublacated it
        Schema::disableForeignKeyConstraints();

        DB::table('grades')->truncate();
        Schema::enableForeignKeyConstraints();

        //insert all blood types when run seeder

        $grades= [
            ['en' => 'primary Stage' , 'ar' => 'المرحله الأبتدائيه'],
            ['en' => 'Middle Stage	' , 'ar' => 'المرحله الأعداديه'],
            ['en' => 'High school	' , 'ar' => 'المرحله الثانويه'],
        ];
        foreach ($grades as $grade){

            Grade::create(['name' => $grade]);
        }
    }
}
