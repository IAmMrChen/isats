<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class DemoController extends BaseController
{
    public function Index () {
        return view("demo.index");
    }
}
