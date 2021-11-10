<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => '迷子ペット',
                'img_url' => 'category-1.jpg',
                'description' => '迷子ペット用チラシ作成',
                'created_by' => 1,
            ], [
                'name' => '保護ペット',
                'img_url' => 'category-2.jpg',
                'description' => '保護ペット用チラシ作成',
                'created_by' => 1,
            ], [
                'name' => '里親募集',
                'img_url' => 'category-3.jpg',
                'description' => '里親募集用チラシ作成',
                'created_by' => 1,
            ]
        ];

        DB::table('category')->insert($data);
    }
}
