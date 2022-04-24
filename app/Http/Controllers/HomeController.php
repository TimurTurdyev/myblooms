<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome', [
            'products' => Product::orderBy('sort', 'asc')->with('attachment')->get(),
            'groups' => Group::get(),
        ]);
    }
}
