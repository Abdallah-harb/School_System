<?php

use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClassroomDatabaseSeeder extends Seeder
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

        DB::table('classrooms')->truncate();
        Schema::enableForeignKeyConstraints();

        //insert all blood types when run seeder

        $classrooms = [
            [
                'class_name' => [
                    'en' => 'First grade',
                    'ar' => 'الصف الأول الابتدائي',
                ],
                'grade_id' => 1,
            ],
            [
                'class_name' => [
                    'en' => 'Second grade',
                    'ar' => 'الصف الثاني الابتدائي',
                ],
                'grade_id' => 1,
            ],
            [
                'class_name' => [
                    'en' => 'Third grade',
                    'ar' => 'الصف الثالث الابتدائي',
                ],
                'grade_id' => 1,
            ],
            [
                'class_name' => [
                    'en' => 'Fourth grade',
                    'ar' => 'الصف الرابع الابتدائي',
                ],
                'grade_id' => 1,
            ],
            [
                'class_name' => [
                    'en' => 'Fifth grade',
                    'ar' => 'الصف الخامس الابتدائي',
                ],
                'grade_id' => 1,
            ],
            [
                'class_name' => [
                    'en' => 'Sixth grade',
                    'ar' => 'الصف السادس الابتدائي',
                ],
                'grade_id' => 1,
            ],
            [
                'class_name' => [
                    'en' => 'First grade middle school',
                    'ar' => 'الصف الأول الأعدادى',
                ],
                'grade_id' => 2,
            ],
            [
                'class_name' => [
                    'en' => 'Second grade middle school',
                    'ar' => 'الصف الثاني الأعدادى',
                ],
                'grade_id' => 2,
            ],
            [
                'class_name' => [
                    'en' => 'Third grade middle school',
                    'ar' => 'الصف الثالث الأعدادى',
                ],
                'grade_id' => 2,
            ],
            [
                'class_name' => [
                    'en' => 'First grade of secondary school',
                    'ar' => 'الصف الأول الثانوي',
                ],
                'grade_id' => 3,
            ],
            [
                'class_name' => [
                    'en' => 'Second grade of secondary school',
                    'ar' => 'الصف الثاني الثانوي',
                ],
                'grade_id' => 3,
            ],
            [
                'class_name' => [
                    'en' => 'Third grade of secondary school',
                    'ar' => 'الصف الثالث الثانوي',
                ],
                'grade_id' => 3,
            ],
        ];


        foreach ($classrooms as $classroom) {
            Classroom::create([
                'class_name' => $classroom['class_name'],
                'grade_id' => $classroom['grade_id'],
            ]);
        }

    }
}
