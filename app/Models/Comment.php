<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use softDeletes;

    protected $fillable = [
        'user_id',
        'question_id',
        'comment'
    ];

    public function question()
    {
        return belongsTo('App\Models\Question');
    }

    public function selectComment($id)
    {
        if(!empty($id)) {
            $commentRecords = $this->where('question_id', $id)->get();
            return $commentRecords;
        }
    }

    public function scopeSearchCommentsOfQuestion($query, $id)
    {
        return $query->where('question_id', $id);
    }
}