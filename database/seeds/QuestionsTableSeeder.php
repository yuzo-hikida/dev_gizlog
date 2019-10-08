<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();
        DB::table('questions')->insert([
            [
                'user_id' => '1',
                'tag_category_id' => '1',
                'title' => 'HTMLについて',
                'content' => 'テスト内容テスト内容テスト内容テスト内容テスト内容テスト内容テスト内容テスト内容テスト内容テスト内容テスト内容テスト内容',
                'created_at' => Carbon::create(2019,9,3),
                'updated_at' => Carbon::create(2019,9,4),
            ],
            [
                'user_id' => '2',
                'tag_category_id' => '2',
                'title' => 'PHPのLaravelについて',
                'content' => 'フレームワークフレームワークフレームワークフレームワークフレームワークフレームワークフレームワークフレームワークフレームワーク',
                'creatyed_at' => Carbon::create(2019,9,2),
                'updated_at' => Carbon::create(2019,9,3),
            ],
            [
                'user_id' => '3',
                'tag_category_id' => '3',
                'title' => 'infraについて',
                'content' => '基盤です基盤です基盤です基盤です基盤です',
                'created_at' => Carbon::create(2019,9,1),
                'updated_at' => Carbon::create(2019,9,2),
            ]
        ]);
    }
}
