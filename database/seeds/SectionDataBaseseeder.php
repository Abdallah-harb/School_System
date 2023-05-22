<?php

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SectionDataBaseseeder extends Seeder
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

        DB::table('sections')->truncate();
        Schema::enableForeignKeyConstraints();

        $sections = [
            [
                'section_name' => [
                    'en' => 'First ',
                    'ar' => 'الفصل الاول',
                ],
                'status' => 1,
                'grade_id' => 1,
                'classroom_id' => 1,
            ],
            [
                'section_name' => [
                    'en' => 'Second ',
                    'ar' => 'الفصل الثانى',
                ],
                'status' => 1,
                'grade_id' => 1,
                'classroom_id' => 1,
            ],
            [
                'section_name' => [
                    'en' => 'First ',
                    'ar' => 'الفصل الاول',
                ],
                'status' => 1,
                'grade_id' => 1,
                'classroom_id' => 2,
            ],
            [
                'section_name' => [
                    'en' => 'Second ',
                    'ar' => 'الفصل الثانى',
                ],
                'status' => 1,
                'grade_id' => 1,
                'classroom_id' =>2,
            ],
            [
                'section_name' => [
                    'en' => 'First ',
                    'ar' => 'الفصل الاول',
                ],
                'status' => 1,
                'grade_id' => 2,
                'classroom_id' => 1,
            ],
            [
                'section_name' => [
                    'en' => 'Second ',
                    'ar' => 'الفصل الثانى',
                ],
                'status' => 1,
                'grade_id' => 2,
                'classroom_id' => 1,
            ],
            [
                'section_name' => [
                    'en' => 'First ',
                    'ar' => 'الفصل الاول',
                ],
                'status' => 1,
                'grade_id' => 2,
                'classroom_id' => 2,
            ],
            [
                'section_name' => [
                    'en' => 'Second ',
                    'ar' => 'الفصل الثانى',
                ],
                'status' => 1,
                'grade_id' => 2,
                'classroom_id' => 2,
            ],
            [
                'section_name' => [
                    'en' => 'First ',
                    'ar' => 'الفصل الاول',
                ],
                'status' => 1,
                'grade_id' => 3,
                'classroom_id' => 1,
            ],
            [
                'section_name' => [
                    'en' => 'Second ',
                    'ar' => 'الفصل الثانى',
                ],
                'status' => 1,
                'grade_id' => 3,
                'classroom_id' => 1,
            ],
            [
                'section_name' => [
                    'en' => 'First ',
                    'ar' => 'الفصل الاول',
                ],
                'status' => 1,
                'grade_id' => 3,
                'classroom_id' => 2,
            ],
            [
                'section_name' => [
                    'en' => 'Second ',
                    'ar' => 'الفصل الثانى',
                ],
                'status' => 1,
                'grade_id' => 3,
                'classroom_id' => 2,
            ],
        ];


        foreach ($sections as $section) {
            Section::create([
                'section_name' => $section['section_name'],
                'status' => $section['status'],
                'grade_id' => $section['grade_id'],
                'classroom_id' => $section['classroom_id'],
            ]);
        }

    }
}
