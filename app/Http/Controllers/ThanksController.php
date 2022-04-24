<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThanksController extends Controller
{
    public function __invoke()
    {
        return view('thanks');
    }
}
