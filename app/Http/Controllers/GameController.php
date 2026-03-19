<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        if (Auth::user()->user_type != \App\Models\User::TYPE_ADMIN) {
            return redirect()->route('utils.home')->with('message', 'Acesso Negado!');
        }

        $studios = Studio::all();

        $selectedStudio = $request->query('studio_id');

        return view('games.create', compact('studios', 'selectedStudio'));
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
            'release_date' => 'nullable|date',
            'studio_id' => 'required|exists:studios,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        Game::create([
            'name' => $request->name,
            'release_date' => $request->release_date,
            'studio_id' => $request->studio_id,
            'cover_path' => $coverPath,
        ]);

        return redirect()->route('studios.show', $request->studio_id)
            ->with('message', 'Jogo adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {



        $game = Game::findOrFail($id);
        $studios = Studio::all();

        return view('games.edit', compact('game', 'studios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {



        $game = Game::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'release_date' => 'nullable|date',
            'studio_id' => 'required|exists:studios,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('cover')) {
            // Apaga a imagem antiga do disco se ela existir
            if ($game->cover_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($game->cover_path);
            }
            // Guarda a nova imagem
            $game->cover_path = $request->file('cover')->store('covers', 'public');
        }

        $game->name = $request->name;
        $game->release_date = $request->release_date;
        $game->studio_id = $request->studio_id;
        $game->save();

        return redirect()->route('studios.show', $game->studio_id)
            ->with('message', 'Jogo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if (Auth::user()->user_type != \App\Models\User::TYPE_ADMIN) {
            return redirect()->route('utils.home')->with('message', 'Acesso Negado!');
        }

        $game = Game::findOrFail($id);

        // Apaga a imagem da pasta storage para não ocupar espaço
        if ($game->cover_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($game->cover_path);
        }

        $game->delete();

        return url()->previous()
            ? redirect(url()->previous())->with('message', 'Jogo apagado com sucesso!')
            : redirect()->route('utils.home')->with('message', 'Jogo apagado com sucesso!');
    }
}
