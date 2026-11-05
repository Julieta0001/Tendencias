<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Traveler;
use App\Models\Destination;
use App\Models\TravelerDestination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* User::factory(10)->create();

       /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com', 
        ]);*/
        Traveler::factory(20)->create();
        Destination::factory(20)->create();
        TravelerDestination::factory(100)->create(); 

    }
}
