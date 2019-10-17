<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
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
    public function getQuestions($data)
    {
            return $this->searchTitle(Arr::get($data,'search_word'))
                        ->searchTagCategoryId(Arr::get($data, 'search_category_id'))
                        ->orderBy('updated_at', 'desc')
                        ->with(['tagCategory', 'user', 'comments'])
                        ->paginate(10);
    }

    /**
     * mypageにて自分が投稿したquestionのレコード取得。
     */
    public function selectMyRecords($userId)
    {
        return $this->where('user_id', $userId)
                    ->with(['tagCategory', 'comments'])
                    ->paginate(10);
    }

    /**
     * 変更したいquestionのレコードを１つ取得。
     */
    public function selectMyRecord($id)
    {
        return $this->with(['tagCategory', 'user'])->find($id);
    }

    /**
     * ワード検索時、検索の値とtitleの値で当てはまるワードだけレコードを取得。
     */
    public function scopeSearchTitle($query, $searchWord)
    {
        if (!empty($searchWord)) {
            return $query->where('title', 'LIKE', '%'.$searchWord.'%');
        }
    }

    /**
     * カテゴリー検索時に値がnullじゃなかったら引数に渡されたtag_category_idと同じレコードを取得。
     */
    public function scopeSearchTagCategoryId($query, $tagCategoryId)
    {
        if (!empty($tagCategoryId)) {
            return $query->where('tag_category_id', $tagCategoryId);
        }
    }

}