<?php

namespace Database\Seeders;

use App\Models\JobGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobGroup::create([
            'id' => 1,
            'title' => 'Công nghệ thông tin',
            'description' => 'Công nghệ thông tin',
            'is_show' => 1,
            'position' => 1
        ]);
    }
}
