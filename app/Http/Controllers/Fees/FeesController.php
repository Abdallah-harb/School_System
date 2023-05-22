<?php

namespace App\Http\Controllers\Fees;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeesRequest;
use App\Repository\Fees\FeesInterface;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class FeesController extends Controller
{
    public $fees;
    public function __construct(FeesInterface $fees)
    {
        return $this->fees = $fees;

    }

    public function index()
    {

        return $this->fees->index();
    }


    public function create()
    {
        return $this->fees->create();
    }

    public function store(FeesRequest $request)
    {
       return $this->fees->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->fees->edit($id);
    }


    public function update(FeesRequest $request)
    {
        return $this->fees->update($request);
    }


    public function destroy(Request  $request)
    {
        return $this->fees->destroy($request);
    }
}
