<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Studio;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $naughtyDog = Studio::where('name', 'Naughty Dog')->first();
        $santaMonica = Studio::where('name', 'Santa Monica Studio')->first();
        $guerrilla = Studio::where('name', 'Guerrilla Games')->first();

        if ($santaMonica) {
            Game::create([
                'name' => 'God of War',
                'release_date' => '2018-04-20',
                'studio_id' => $santaMonica->id,
            ]);
        }

        if ($guerrilla) {
            Game::create([
                'name' => 'Horizon Zero Dawn',
                'release_date' => '2017-02-28',
                'studio_id' => $guerrilla->id,
            ]);
        }

        if ($naughtyDog) {
            Game::create([
                'name' => 'Uncharted 4: A Thief\'s End',
                'release_date' => '2016-05-10',
                'studio_id' => $naughtyDog->id,
            ]);
        }
    }
}
