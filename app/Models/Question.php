<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\User\QuestionController;

class Question extends Model
{
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
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * 質問一覧で表示するために、それぞれ絞り込みをしてレコードを取得。
     */
    public function getQuestionRecord($request)
    {
        return $this->searchTitle($request)
                    ->searchTagCategoryId($request)
                    ->orderBy('updated_at', 'desc')
                    ->with(['tagCategory', 'user', 'comments']);
    }

    /**
     * mypageにて自分が投稿したquestionのレコード取得。
     */
    public function selectMyRecords($id)
    {
        if (!empty($id)) {
            return $this->where('user_id', $id)
                        ->with(['tagCategory', 'comments']);
        }
    }

    /**
     * 変更したいquestionのレコードを１つ取得。
     */
    public function selectMyRecord($id)
    {
        if (!empty($id)) {
            return $this->where('id', $id)
                        ->with(['tagCategory', 'user', 'comments'])
                        ->first();
        }
    }

    /**
     * ワード検索時、検索の値とtitleの値で当てはまるワードだけレコードを取得。
     */
    public function scopeSearchTitle($query, $id)
    {
        if (!empty($id['search_word'])) {
            return $query->where('title', 'LIKE', '%'.$id['search_word'].'%');
        }
    }

    /**
     * カテゴリー検索時に値がnullじゃなかったら引数に渡されたtag_category_idと同じレコードを取得。
     */
    public function scopeSearchTagCategoryId($query, $id)
    {
        if (!empty($id['tag_category_id'])) {
            return $query->where('tag_category_id', 'LIKE', '%'.$id['tag_category_id'].'%');
        }
    }

}