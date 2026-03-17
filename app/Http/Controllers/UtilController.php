<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function home()
    {
        return view('utils.home');
    }


    public function fallback()
    {
        return view('utils.fallback');
    }
}
