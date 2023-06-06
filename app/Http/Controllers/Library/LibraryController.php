<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Repository\Library\LibraryInterface;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public $library;
    public function  __construct(LibraryInterface $library)
    {
        $this->library = $library;
    }

    public function index()
    {
        return $this->library->index();
    }

    public function create()
    {
        return $this->library->create();
    }


    public function store(Request $request)
    {
        return $this->library->store($request);
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function download($fileName){
        return $this->download($fileName);
    }
}
