<?php

namespace App\Repository\StudentPattern;

use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Section;
use App\Models\Students;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class studentRepository implements StudentInterface
{
    //all students
    public function all_students(){

        $students = Students::all();
        return view('pages.Students.index',compact('students'));
    }

    //create new students
    public function createStudent(){

        $data['grades']        = Grade::all();
        $data['classrooms']    = Classroom::all();
        $data['sections']      = Section::all();
        $data['My_Parents']    = My_Parent::all();
        $data['genders']       = Gender::all();
        $data['nationalities'] = Nationalitie::all();
        $data['bloods']        = Blood::all();

        return view('pages.Students.create',$data);
    }

    //get classroom and assigin it before choose garde
    public function getclassroom($id){

        $classromms = Classroom::where('grade_id',$id)->pluck('class_name','id');
        return $classromms;
    }

    //get section and assigin it before choose classroom
    public function Get_Section($id){

        $sections = Section::where('classroom_id',$id)->pluck('section_name','id');
        return $sections;
    }
    //store student
    public function storestudent($request){

       // DB::beginTransaction();
        try {
            $students = new Students();
            $students
                    ->setTranslation('name','en',$request->name_en)
                    ->setTranslation('name','ar',$request->name_ar);
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();

            // insert img
            if($request->hasfile('photos'))
            {
                foreach($request->file('photos') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('students/'.$students->name, $file->getClientOriginalName(),'students');

                    // insert in image_table
                    $images= new Image();
                    $images->filename=$name;
                    $images->imageable_id= $students->id;
                    $images->imageable_type = 'App\Models\Students';
                    $images->save();
                }
            }

            //DB::commit(); // insert data
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.create');

        }catch (\Exception $e){

           // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
        //show more student show
    public function showmorinfo_student($id){

        $student = Students::findOrFail($id);
        return view('pages.Students.show',compact('student'));
    }

    //edit Student
    public function edit_student($id){
        $student = Students::findOrFail($id);
        $data['grades']        = Grade::all();
        $data['classrooms']    = Classroom::all();
        $data['sections']      = Section::all();
        $data['My_Parents']    = My_Parent::all();
        $data['genders']       = Gender::all();
        $data['nationalities'] = Nationalitie::all();
        $data['bloods']        = Blood::all();

        return view('pages.Students.edit',$data,compact('student'));

    }

    public function update_student($request)
    {
        $student = Students::findOrFail($request->id);
        $student
            ->setTranslation('name','en',$request->name_en)
            ->setTranslation('name','ar',$request->name_ar);
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->gender_id = $request->gender_id;
        $student->nationalitie_id = $request->nationalitie_id;
        $student->blood_id = $request->blood_id;
        $student->Date_Birth = $request->Date_Birth;
        $student->Grade_id = $request->Grade_id;
        $student->Classroom_id = $request->classroom_id;
        $student->section_id = $request->section_id;
        $student->parent_id = $request->parent_id;
        $student->academic_year = $request->academic_year;
        $student->save();

        toastr()->success(trans('messages.Update'));
        return redirect()->route('students.index');

    }

    public function delete_student($request)
    {
        Students::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.delete'));
        return redirect()->route('students.index');
    }

    public function upload_more_image($request)
    {
        foreach($request->file('photos') as $file)
        {
            $name = $file->getClientOriginalName();
            $file->storeAs('students/'.$request->student_name, $file->getClientOriginalName(),'students');

            // insert in image_table
            $images= new image();
            $images->filename=$name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Students';
            $images->save();
        }

        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }
        //download image
    public function Download_attachment($studentsname, $filename)
    {
        return response()->download(public_path('assets/images/students/'.$studentsname.'/'.$filename));
    }

    public function Delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('students')->delete('assets/images/students/'.$request->student_name.'/'.$request->filename);

        // Delete in data
        image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(trans('messages.warning'));
        return redirect()->back();
    }
}
