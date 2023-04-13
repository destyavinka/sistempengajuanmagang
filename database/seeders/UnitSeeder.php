<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data = [
            ['nama_unit' => 'Sekolah Vokasi','nomor_telepon'=>'0271664126','email' => 'vokasi@unit.uns.ac.idvokasi@unit.uns.ac.id'],
            ['nama_unit' => 'D-3 Teknik Kimia','nomor_telepon'=>'0271664126','email' => 'vokasi@unit.uns.ac.idvokasi@unit.uns.ac.id'],
            
        ];


       foreach ($data as $value) {
        Unit::insert([
             'nama_unit' => $value ['nama_unit'],
             'nomor_telepon' => $value ['nomor_telepon'],
             'email' => $value ['email'],
         ]);
    }
    }}
