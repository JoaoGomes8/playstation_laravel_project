<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function home()
    {
        $studios = Studio::all();
        return view('utils.home', compact('studios'));
    }


    public function fallback()
    {
        return view('utils.fallback');
    }
}
