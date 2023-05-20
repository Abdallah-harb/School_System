<?php

use App\Models\Spechalization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SpecalizeDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('spechalizations')->truncate();
        Schema::enableForeignKeyConstraints();


        $specilazes = [
            ['en' => 'Arabic teacher' , 'ar' => 'مدرس عربى'],
            ['en' => 'Math teacher' , 'ar' => 'مدرس حساب'],
            ['en' => 'computer teacher' , 'ar' => 'مدرس حاسب ألى'],
            ['en' => 'English teacher' , 'ar' => 'مدرس لغه انجليزيه'],
            ['en' => 'Geography teacher' , 'ar' => 'مدرس دراسات'],
            ['en' => 'Sport teacher' , 'ar' => 'مدرس العاب رياضيه'],
        ];

        foreach ($specilazes as $specilaze){

            Spechalization::create(['name' => $specilaze]);
        }
    }
}
