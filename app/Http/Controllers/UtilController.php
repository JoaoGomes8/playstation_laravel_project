<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function home(\Illuminate\Http\Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            $studios = Studio::where('name', 'LIKE', '%' . $search . '%')->paginate(6);

            // garante que a página 2 ou 3 não "esquece" a pesquisa
            $studios->appends(['search' => $search]);
        } else {
            $studios = Studio::paginate(6);
        }

        return view('utils.home', compact('studios'));
    }

    public function fallback()
    {
        return view('utils.fallback');
    }
}
