<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Report extends Model
{
    use softDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'daily_reports';
    protected $fillable = [
        'title',
        'content',
        'reporting_time',
        'user_id',
    ];

    /**
     * $requestに値が入っていなかったらuser_idと＄idが一致するレコードを全件取得
     * $request['search_month']に値入っていたら指定された年月が入っているレコードのみ取得
     */
    public function getByUserRecords($allRequest, $id)
    {
        $builder = $this->where('user_id', $id);
        if (!empty($allRequest['search_month'])) {
            $builder->where('reporting_time', 'like', '%'.$allRequest['search_month'].'%');
        }
        return $builder->orderBy('reporting_time', 'desc')->get();
    }
}
