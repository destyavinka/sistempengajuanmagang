<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['role' => 'Tenaga Pendidik'],
            ['role' => 'Tenaga Kependidikan'],
            ['role' => 'Kaprodi'],
            ['role' => 'Admin Sekolah Vokasi'],
            ['role' => 'Dekan'],
            ['role' => 'Super Admin'],
        ];
    
        foreach ($data as $value) {
            Role::insert([
                'role' => $value ['role'],
            ]);
        }
    }
}
