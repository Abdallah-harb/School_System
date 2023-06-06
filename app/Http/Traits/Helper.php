<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait Helper
{

    public function uploadFile($request,$name)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('assets/library',$file_name,'Library');
    }

    public function deleteFile($name)
    {
        $exists = Storage::disk('Library')->exists('assets/library/'.$name);

        if($exists)
        {
            Storage::disk('Library')->delete('assets/library/'.$name);
        }
    }

}
