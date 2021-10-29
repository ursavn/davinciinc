<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
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
                'img_url' => 'template-1.png',
                'url' => 'template-1.html',
                'description' => '迷子ペット用チラシ作成',
                'category_id' => 1,
                'created_by' => 1,
            ], [
                'name' => '迷子ペット',
                'img_url' => 'template-2.png',
                'url' => 'template-2.html',
                'description' => '迷子ペット用チラシ作成',
                'category_id' => 1,
                'created_by' => 1,
            ], [
                'name' => '迷子ペット',
                'img_url' => 'template-3.png',
                'url' => 'template-3.html',
                'description' => '迷子ペット用チラシ作成',
                'category_id' => 1,
                'created_by' => 1,
            ]
        ];

        DB::table('template')->insert($data);
    }
}
