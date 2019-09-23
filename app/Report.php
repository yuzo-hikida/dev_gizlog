<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Report extends Model
{
    //
    use softDeletes;
    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'daily_reports';
    protected $fillable = [
        'title',
        'content',
        'reporting_time',
        'user_id',
    ];

    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }

    public function getByReportingTime($select)
    {
        return $this->whereMonth('reporting_time', '=', '$select')->get();
    }

}
