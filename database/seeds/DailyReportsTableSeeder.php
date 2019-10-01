<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DailyReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daily_reports')->truncate();
        DB::table('daily_reports')->insert([
            [
                'id'             => 1,
                'user_id'        => 1,
                'title'          => '日報のタイトル',
                'content'        => '日報の内容',
                'reporting_time' => Carbon::create(2017, 12, 2),
                'created_at'     => Carbon::create(2017, 12, 3),
                'updated_at'     => Carbon::create(2017, 12, 4),
                'deleted_at'     => null,
            ],
            [
                'id'             => 2,
                'user_id'        => 4,
                'title'          => '日報のタイトル2',
                'content'        => '日報の内容2',
                'reporting_time' => Carbon::create(2019, 9, 2),
                'created_at'     => Carbon::create(2019, 8, 3),
                'updated_at'     => Carbon::create(2019, 8, 4),
                'deleted_at'     => null,
            ],
            [
                'id'             => 3,
                'user_id'        => 4,
                'title'          => '日報のタイトル3',
                'content'        => '日報の内容3',
                'reporting_time' => Carbon::create(2019, 9, 3),
                'created_at'     => Carbon::create(2019, 8, 4),
                'updated_at'     => Carbon::create(2019, 8, 5),
                'deleted_at'     => null,
            ],
            [
                'id'             => 4,
                'user_id'        => 4,
                'title'          => '日報のタイトル4',
                'content'        => '日報の内容4',
                'reporting_time' => Carbon::create(2019, 9, 4),
                'created_at'     => Carbon::create(2019, 8, 5),
                'updated_at'     => Carbon::create(2019, 8, 6),
                'deleted_at'     => null,
            ],
            [
                'id'             => 5,
                'user_id'        => 4,
                'title'          => '日報のタイトル5',
                'content'        => '日報の内容5',
                'reporting_time' => Carbon::create(2019, 9, 5),
                'created_at'     => Carbon::create(2019, 8, 6),
                'updated_at'     => Carbon::create(2019, 8, 7),
                'deleted_at'     => null,
            ],
        ]);
    }
}
