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

    /**
     * 出社時間登録
     */
    public function saveStartTime()
    {
        $dt = [];
        $dt['user_id'] = Auth::id();
        $dt['start_time'] = $this->data()->format('Y-m-d H:m:s');
        $dt['reporting_time'] = $this->data()->format('Y-m-d');
        return $this->create($dt);
    }

    /**
     * 退社時間登録
     */
    public function saveEndTime($id)
    {
        $dt = [];
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

    /**
     * 欠席登録
     */
    public function saveAbsence($absenceComment)
    {
        $dt = $this->data()->format('Y-m-d');
        $attendanceRecord = $this->where('reporting_time', $dt)->first();

        if (empty($attendanceRecord)) {
            $absence = [];
            $absence['user_id'] = Auth::id();
            $absence['absence_comment'] = $absenceComment['absence_comment'];
            $absence['reporting_time'] = $this->data()->format('Y-m-d');
            return $this->create($absence);
        } elseif (isset($attendanceRecord['start_time']) && empty($attendanceRecord['end_time'])) {
            $dt = [];
            $dt['absence_comment'] = $absenceComment['absence_comment'];
            $dt['start_time'] = null;
            $id = $attendanceRecord['id'];
            return $this->find($id)->fill($dt)->save();
        } elseif (isset($attendanceRecord['start_time']) && isset($attendanceRecord['end_time'])) {
            $dt = [];
            $dt['absence_comment'] = $absenceComment['absence_comment'];
            $dt['start_time'] = null;
            $dt['end_time'] = null;
            $id = $attendanceRecord['id'];
            return $this->find($id)->fill($dt)->save();
        }
    }
}