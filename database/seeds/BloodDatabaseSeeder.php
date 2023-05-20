<?php

use App\Models\Blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BloodDatabaseSeeder extends Seeder
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
        DB::table('bloods')->truncate();
        Schema::enableForeignKeyConstraints();
        //insert all blood types when run seeder

        $bloodTypes = ['O-','O+','A+','A-','B+','B-','AB-','AB+'];
        foreach ($bloodTypes as $bloodType){

            BLood::create(['blood_name' => $bloodType]);
        }
    }
}
