<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Studio;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudios = Studio::count();
        $totalGames = Game::count();

        return view('dashboard.index', compact('totalStudios', 'totalGames'));
    }
}
