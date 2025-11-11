<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_categories')->insert([
            [
                'id' => 1,
                'title' => 'Cẩm nang',
                'description' => 'Cẩm nang là loại bài viết mang đến kiến thức cho người đọc',
                'is_show' => 1,
                'position' => 1,
                'alias' => 'cam-nang',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
