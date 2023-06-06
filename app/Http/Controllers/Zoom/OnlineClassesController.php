<?php

namespace App\Http\Controllers\Zoom;

use App\Http\Controllers\Controller;
use App\Repository\Zoom\OnlineClassesInterface;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class OnlineClassesController extends Controller
{
    public $onlineClasses;
    public function __construct(OnlineClassesInterface $onlineClasses){

        $this->onlineClasses = $onlineClasses;
    }

    public function index()
    {
        return $this->onlineClasses->index();
    }


    public function create()
    {
        return $this->onlineClasses->create();
    }

         //offline classes
    public function indirectCreate()
    {
        return $this->onlineClasses->indirectCreate();
    }


    public function store(Request $request)
    {
        return $this->onlineClasses->store($request);
    }

            //offline classes

    public function storeIndirect(Request $request)
    {
        return $this->onlineClasses->storeIndirect($request);
    }



    public function destroy($id)
    {
       return $this->onlineClasses->delete($id);
    }

}
