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

}
