<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Instansi;
use App\Models\Penyelenggara;
use App\Models\Periode;
use App\Models\Skema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
  
        $this->call([
            UnitSeeder::class,
            InstansiSeeder::class,
            RoleSeeder::class,
            SkemaSeeder::class,
            // PeriodeSeeder::class,
            UserSeeder::class,
            // Penyelenggara::class,
        ]);

        
    }
}
