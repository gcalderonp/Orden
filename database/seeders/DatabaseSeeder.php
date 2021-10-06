<?php

namespace Database\Seeders;

use App\Models\Orden;
use App\Models\OrdenDet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Orden::factory(2)->create();
        OrdenDet::factory(7)->create();
    }
}
