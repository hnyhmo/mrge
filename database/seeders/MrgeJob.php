<?php

namespace Database\Seeders;

use App\Models\MrgeJob as ModelsMrgeJob;
use App\Models\MrgeJobDescription;
use Illuminate\Database\Seeder;

class MrgeJob extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsMrgeJob::factory()->count(10)->create();
        MrgeJobDescription::factory()->count(20)->create();
    }
}
