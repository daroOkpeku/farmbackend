<?php

namespace App\Http\Repository;

use App\Http\Repository\Contracts\TestInterface;

class TestRepository implements TestInterface{

    public function info($request)
    {
        dd($request->all());
    }

}
