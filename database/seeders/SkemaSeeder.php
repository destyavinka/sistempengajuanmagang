<?php

namespace Database\Seeders;

use App\Models\Skema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_skema' => 'Programming'],
        ];

        foreach ($data as $value) {
            Skema::insert([
                'nama_skema' => $value ['nama_skema'],
            ]);
        }
    }
}
