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
            ['nama_unit' => 'Sekolah Vokasi'],
            ['nama_unit' => 'D4 Keselamatan dan Kesehatan Kerja'],
            ['nama_unit' => 'D4 Demografi dan Pencatatan Sipil'],
            ['nama_unit' => 'D3 Teknik Informatika'],
            ['nama_unit' => 'D3 Kebidanan'],
            ['nama_unit' => 'D3 Perpustakaan'],
            ['nama_unit' => 'D3 Farmasi'],
            ['nama_unit' => 'D3 Agribisnis'],
            ['nama_unit' => 'D3 Akutansi'],
            ['nama_unit' => 'D3 Teknologi Hasil Pertanian'],
            ['nama_unit' => 'D3 Usaha Perjalanan Wisata'],
            ['nama_unit' => 'D3 Keuangan Perbankan'],
            ['nama_unit' => 'D3 Budidaya Ternak'],
            ['nama_unit' => 'D3 Komunikasi Terapan'],
            ['nama_unit' => 'D3 Manajemen Bisnis'],
            ['nama_unit' => 'D3 Teknik Mesin'],
            ['nama_unit' => 'D3 Desain Komunikasi Visual'],
            ['nama_unit' => 'D3 Manajemen Pemasaran'],
            ['nama_unit' => 'D3 Bahasa Mandarin'],
            ['nama_unit' => 'D3 Manajemen Perdagangan'],
            ['nama_unit' => 'D3 Teknik Sipil'],
            ['nama_unit' => 'D3 Bahasa Inggris'],
            ['nama_unit' => 'D3 Perpajakan'],
            ['nama_unit' => 'D3 Teknik Kimia'],
            ['nama_unit' => 'D3 Manajemen Administrasi'],
        ];


       foreach ($data as $value) {
        Unit::insert([
             'nama_unit' => $value ['nama_unit'],
            //  'nomor_telepon' => $value ['nomor_telepon'],
            //  'email' => $value ['email'],
         ]);
    }
    }}
