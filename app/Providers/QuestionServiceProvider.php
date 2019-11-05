<?php

namespace App\Providers;

use App\Models\Question;
use App\Models\TagCategory;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class QuestionServiceProvider extends ServiceProvider
{

    public function __construct(Question $question,  Comment $comment, TagCategory $tagCategory)
    {
        $this->question = $question;
        $this->comment = $comment;
        $this->tagCategory = $tagCategory;
    }

    public function selectTagCategoryName($tagCategoryId)
    {
        return $this->tagCategory->find($tagCategoryId)->name;
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
