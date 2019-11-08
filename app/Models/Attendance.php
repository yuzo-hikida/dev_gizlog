<?php

namespace App\Models;

use Carbon\Carbon;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'is_request',
        'absence_comment',
        'correction_comment',
        'start_time',
        'end_time',
        'reporting_time',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected function data()
    {
        return $data = Carbon::now();
    }

    public function saveStartTime()
    {
        $dt = [];
        $dt['user_id'] = Auth::id();
        $dt['start_time'] = $this->data()->format('Y-m-d H:m:s');
        $dt['reporting_time'] = $this->data()->format('Y-m-d');
        return $this->create($dt);;
    }

    public function saveEndTime($id)
    {
        $dt = [];
        $dt['user_id'] = Auth::id();
        $dt['end_time'] = $this->data()->format('Y-m-d H:m:s');
        return $this->find($id)->fill($dt)->save();
    }

    /**
     * 出社しているかの有無を確認する。
     */
    public function discriminationAttend()
    {
        $dt = $this->data()->format('Y-m-d');
        return $attendance = $this->where('reporting_time', $dt)->first();
    }
}