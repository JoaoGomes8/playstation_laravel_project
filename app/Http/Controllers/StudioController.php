<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function create()
    {
        return view('studios.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // max 2MB
        ]);

        // Tratar o Upload da Imagem
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Studio::create([
            'name' => $request->name,
            'logo_path' => $logoPath,
        ]);

        return redirect()->route('utils.home')->with('message', 'Estúdio criado com sucesso!');
    }
}
