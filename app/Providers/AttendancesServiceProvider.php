<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models;
use App\Models\Attendance;

class AttendancesServiceProvider extends ServiceProvider
{
    protected $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    /**
     * 出社しているかの有無を確認する。
     */
    public function discriminationAttend()
    {
        $attendance = $this->attendance->get();
        dd($attendance);
        // if (empty($attendance['start_time']) && empty($attendance['end_time'])) {

        // }
    }
}
