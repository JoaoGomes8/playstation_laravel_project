<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('utils.home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->user_type != \App\Models\User::TYPE_ADMIN) {
            return redirect()->route('utils.home')->with('message', 'Acesso Negado!');
        }


        return view('studios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->user_type != \App\Models\User::TYPE_ADMIN) {
            return redirect()->route('utils.home')->with('message', 'Acesso Negado!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $studio = Studio::findOrFail($id);


        $games = $studio->games()->paginate(4);

        return view('studios.show', compact('studio', 'games'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        if (Auth::user()->user_type != \App\Models\User::TYPE_ADMIN) {
            return redirect()->route('utils.home')->with('message', 'Acesso Negado!');
        }


        $studio = Studio::findOrFail($id);

        return view('studios.edit', compact('studio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (Auth::user()->user_type != \App\Models\User::TYPE_ADMIN) {
            return redirect()->route('utils.home')->with('message', 'Acesso Negado!');
        }

        $studio = Studio::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            if ($studio->logo_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($studio->logo_path);
            }
            $studio->logo_path = $request->file('logo')->store('logos', 'public');
        }

        $studio->name = $request->name;
        $studio->save();

        return redirect()->route('studios.show', $studio->id)
            ->with('message', 'Estúdio atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if (Auth::user()->user_type != \App\Models\User::TYPE_ADMIN) {
            return redirect()->route('utils.home')->with('message', 'Acesso Negado!');
        }

        $studio = Studio::findOrFail($id);

        foreach ($studio->games as $game) {
            // Apaga a imagem da storage. Assim quando se apaga um studio tbm apaga a imagem da storage.
            if ($game->cover_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($game->cover_path);
            }
            $game->delete();
        }

        // Apaga a imagem da pasta storage para não ocupar espaço
        if ($studio->logo_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($studio->logo_path);
        }

        $studio->delete();


        return redirect()->route('utils.home')->with('message', 'Estúdio e respetivos jogos apagados com sucesso!');
    }
}
