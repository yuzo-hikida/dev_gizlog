<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('attendance')->truncate();
        DB::table('attendance')->insert([
            [
                'user_id'            => 4,
                'is_request'         => 0,
                'absence_comment'    => '頭痛によりお休みをいただきます。',
                'correction_comment' => null,
                'start_time'         => null,
                'end_time'           => null,
                'reporting_time'     => null,
                'created_at'         => $now->subDay(1),
            ],
            [
                'user_id'            => 4,
                'is_request'         => 0,
                'absence_comment'    => null,
                'correction_comment' => null,
                'start_time'         => $now->addHour(5),
                'end_time'           => $now->addHour(13),
                'reporting_time'     => null,
                'created_at'         => $now->subDay(3),
            ],
            [
                'user_id'            => 4,
                'is_request'         => 0,
                'absence_comment'    => null,
                'correction_comment' => '打刻もれで出勤時間を10:00に変更をお願いいたします。',
                'start_time'         => $now->addHour(5),
                'end_time'           => $now->addHour(13),
                'reporting_time'     => $now->subDay(3),
                'created_at'         => $now->subDay(3),
            ],
        ]);
    }
}
