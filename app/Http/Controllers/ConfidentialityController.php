<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfidentialityController extends Controller
{
    public function __invoke()
    {
        return view('confidentiality');
    }
}
