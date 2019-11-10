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
        $now = new Carbon();

        DB::table('attendances')->truncate();
        DB::table('attendances')->insert([
            [
                'user_id'            => 4,
                'is_request'         => 0,
                'absence_comment'    => '頭痛によりお休みをいただきます。',
                'correction_comment' => null,
                'start_time'         => null,
                'end_time'           => null,
                'reporting_time'     => $now->subDay(),
                'created_at'         => $now->subDay(),
            ],
            [
                'user_id'            => 4,
                'is_request'         => 0,
                'absence_comment'    => null,
                'correction_comment' => null,
                'start_time'         => '2019-02-15 11:00:00',
                'end_time'           => '2019-02-15 19:00:00',
                'reporting_time'     => $now->subDay(24) . "\n",
                'created_at'         => $now->subDay() . "\n",
            ],
            [
                'user_id'            => 4,
                'is_request'         => 1,
                'absence_comment'    => null,
                'correction_comment' => '打刻もれで出勤時間を10:00に変更をお願いいたします。',
                'start_time'         => '2019-02-16 11:00:00',
                'end_time'           => '2019-02-16 19:00:00',
                'reporting_time'     => $now->subDay(24) . "\n",
                'created_at'         => $now->subDay() . "\n",
            ],
            [
                'user_id'            => 4,
                'is_request'         => 0,
                'absence_comment'    => null,
                'correction_comment' => null,
                'start_time'         => '2019-02-15 11:00:00',
                'end_time'           => null,
                'reporting_time'     => $now->subDay(24) . "\n",
                'created_at'         => $now->subDay() . "\n",
            ],
        ]);
    }
}
