<?php

namespace App\Repository\Library;

use App\Models\Grade;
use App\Models\Library;
use App\Models\Teacher;
use App\Http\Traits\Helper;
use http\Env\Response;

class LibraryRepository implements LibraryInterface
{
    use Helper;

    public function index()
    {
        $libraries = Library::all();

        return view('pages.Library.index',compact('libraries'));
    }

    public function create()
    {
       $grades = Grade::all();
       $teachers = Teacher::all();
       return view('pages.Library.create',compact('grades','teachers'));
    }

    public function store($request)
    {

        try{
            $library = new Library();
            $library->book_name = $request->book_name;
           $library->file_book =  $request->file_book->getClientOriginalName();
            $library->grade_id = $request->grade_id;
            $library->Classroom_id = $request->Classroom_id;
            $library->teacher_id = $request->teacher_id;
            $library->save();


            //save file on disk


            // Save file on disk
            $request->file('file_book')->storeAs('assets/library', $library->file_book, 'Library');

            toastr()->success(trans('messages.success'));

            return redirect()->route('library.index');
        }catch (\Exception $e){
            return  redirect()->back()->with(['error' => $e]);
        }

    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }



    private function uploadImage($folder, $image){

        $image->store('/',$folder);
        $fileName  = $image->hashName();
        return $fileName;
    }
    public function download($filename){

        return \response()->download(public_path('assets\library'.$filename));

    }


}
