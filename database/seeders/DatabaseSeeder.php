<?php

namespace Database\Seeders;

use App\Models\Signup;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Signup::factory()->count(50)->create();
    }
}
