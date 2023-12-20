<?php

namespace Database\Seeders;

use App\Models\Instansi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_instansi' => 'UNS'],
        ];

        foreach ($data as $value) {
            Instansi::insert([
                'nama_instansi' => $value ['nama_instansi'],
            ]);
        }
    }
}
