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
        //
        DB::table('daily_reports')->truncate();
        DB::table('daily_reports')->insert([
            [
                'id'             => 1,
                'user-id'        => 1,
                'title'          => '日報のタイトル',
                'content'        => '日報の内容',
                'reporting-time' => Carbon::create(2017, 12, 2),
                'created_at'     => Carbon::create(2017, 12, 3),
                'updated_at'     => Carbon::create(2017, 12, 4),
                'deleted_at'     => null,
            ],
        ]);
    }
}
