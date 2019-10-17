<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\User\QuestionController;

class TagCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function tagCategories()
    {
        return $this->all();
    }
}

