<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();
        DB::table('comments')->insert([
            [
                'user_id' => '3',
                'question_id' => '1',
                'comment' => 'テストコメントテストコメントテストコメントテストコメントテストコメントテストコメント',
                'created_at' => Carbon::create(2019,10,1),
            ],
            [
                'user_id' => '2',
                'question_id' => '2',
                'comment' => 'テスト',
                'created_at' => Carbon::create(2019,10,2)
            ],
            [
                'user_id' => '1',
                'question_id' => '3',
                'comment' => 'jhdksdbldskfsfskgbfghfghsflghsflshdfgefb',
                'created_at' => Carbon::create(2019,10,3),
            ],
        ]);
    }
}
