<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use App\Models\TagCategory;
use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\User\QuestionController;

class Question extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'tag_category_id',
        'title',
        'content',
        'user_id',
    ];

    public function tagCategory()
    {
        return $this->belongsTo('App\Models\TagCategory');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Commen');
    }

    public function getQuestionRecord($questions)
    {
        if (empty($questions)) {
            $questionRecords = Question::orderBy('updated_at', 'desc')->get();
            return $questionRecords;
        }
    }
}