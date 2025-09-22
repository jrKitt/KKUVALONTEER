<?php

use Illuminate\Database\Seeder;
use App\Models\VolunteerHour;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        VolunteerHour::factory(15)->create(['user_id' => 1]);
    }
}
