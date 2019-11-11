<?php

namespace App\Models;

use Carbon\Carbon;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'start_time',
        'end_time',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    protected function data()
    {
        return $data = Carbon::now();
    }

    /**
     * 出社時間登録
     */
    public function saveStartTime()
    {
        return $this->create([
            'user_id' => Auth::id(),
            'start_time' => $this->data()->format('Y-m-d H:m:s'),
            'reporting_time' => $this->data()->format('Y-m-d'),
        ]);
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

        /**
         * 出社していない人の処理
         */
        if (empty($attendanceRecord)) {
            $this->createAttendance($absenceComment);
        }

        /**
         * 出社した人の変更処理
         */
        if (isset($attendanceRecord)) {
            $this->updateAttendance($attendanceRecord, $absenceComment);
        }
    }

    public function createAttendance($data)
    {
        return $this->create([
            'user_id' => Auth::id(),
            'absence_comment' => $data['absence_comment'],
            'reporting_time' => $this->data()->format('Y-m-d'),
        ]);
    }

    public function updateAttendance($data, $comment)
    {
        $id = $data['id'];
        return $this->where('id', $id)->update([
            'absence_comment' => $comment['absence_comment'],
            'start_time' => null,
            'end_time' => null,
        ]);
    }

    /**
     * 自分のレコード全取得
     */
    public function getMyRecords()
    {
        return $this->all();
    }

    /**
     * 累計時間の計算
     * @return 累計時間
     */
    public function getCumulativeTime()
    {
        $dts = $this->where('end_time', '!=', Null)->get();
        $totalTime = 0;

        foreach ($dts as $dt) {
            $endTime = $dt->end_time;
            $startTime = $dt->start_time;
            $totalTime += $endTime->diffInHours($startTime);
        }
        return $totalTime;
    }

    /**
     * 修正データ保存処理
     */
    public function saveCorrectionDate($correctionDate)
    {
        $date = $correctionDate['date'];
        $correctionMyRecord = $this->where('reporting_time', $date)->first();
        $id = $correctionMyRecord['id'];
        $dt = [];
        $dt['correction_comment'] = $correctionDate['correction_comment'];
        $dt['is_request'] = 1;
        return $this->find($id)->fill($dt)->save();
    }

}