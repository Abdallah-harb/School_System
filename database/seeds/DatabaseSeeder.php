<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserDatabaseSeeder::class);
         $this->call(GradeDatabaseSeeder::class);
         $this->call(ClassroomDatabaseSeeder::class);
         $this->call(BloodDatabaseSeeder::class);
         $this->call(NationalitieDatabaseSeeder::class);
         $this->call(ReligionDatabaseSeeder::class);
         $this->call(GenderDBSeeder::class);
         $this->call(SpecalizeDBSeeder::class);
         $this->call(TeacherDataBaseSeeder::class);
         $this->call(MyParentDataBaseSeeder::class);
         $this->call(SectionDataBaseseeder::class);
    }
}
