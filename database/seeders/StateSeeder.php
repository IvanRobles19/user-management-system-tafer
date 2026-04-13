<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\Municipality;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jalisco = State::create(['name' => 'Jalisco']);
        $this->createMunicipalities($jalisco, ['Guadalajara', 'Zapopan', 'Puerto Vallarta', 'Tlaquepaque']);

        $bc = State::create(['name' => 'Baja California']);
        $this->createMunicipalities($bc, ['Tijuana', 'Mexicali', 'Ensenada', 'Rosarito']);

        $qr = State::create(['name' => 'Quintana Roo']);
        $this->createMunicipalities($qr, ['Cancún', 'Chetumal', 'Playa del Carmen', 'Tulum']);
    }

    private function createMunicipalities($state, $municipalities)
    {
        foreach ($municipalities as $name) {
            $state->municipalities()->firstOrCreate(['name' => $name]);
        }
    }
}
