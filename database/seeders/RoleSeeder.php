<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name'=> 'Quản trị viên',
                'description' => 'Toàn quyền',
                'alias'=> 'quantrivien'
            ],
            [
                'id' => 2,
                'name'=> 'Ứng viên',
                'description' => 'Tìm việc',
                'alias'=> 'ungvien'
            ]
        ]);
    }
}
