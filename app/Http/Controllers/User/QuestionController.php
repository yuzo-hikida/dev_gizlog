<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CommentRequest;
use App\Http\Requests\User\QuestionsRequest;
use App\Http\Requests\User\QuestionSearchRequest;
use App\Models\Question;
use App\Models\TagCategory;
use App\Models\Comment;
use App\Providers\QuestionServiceProvider;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    protected $question;
    protected $comment;
    protected $tagCategory;

    public function __construct(Question $question,  Comment $comment, TagCategory $tagCategory)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->comment = $comment;
        $this->tagCategory = $tagCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return QuestionSearchRequest
     */
    public function index(QuestionSearchRequest $request)
    {
        $inputs = $request->all();
        $questions = $this->question->getQuestions($inputs);
        $tagCategories = $this->tagCategory->tagCategories();
        return view('user.question.index', compact('questions', 'tagCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Respons
     */
    public function create()
    {
        $pluckedCategories = $this->tagCategory->tagCategories()->pluck('name', 'id')->prepend('select Category', '');
        return view('user.question.create', compact('pluckedCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  QuestionsRequest  $request
     * @return QuestionsRequest
     */
    public function store(QuestionsRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $this->question->create($inputs);
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showQuestion = $this->question->selectMyRecord($id);
        return view('user.question.show',compact('showQuestion'));
    }

    /**
     * edit the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $changeValue = $this->question->selectMyRecord($id);
        $pluckedCategories = $this->tagCategory->tagCategories()->pluck('name', 'id')->prepend('select Category', '');
        return view('user.question.edit', compact('changeValue', 'pluckedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  QuestionsRequest  $request
     * @return QuestionsRequest
     */
    public function update(QuestionsRequest $request, $id)
    {
        $editRecord = $request->all();
        $editRecord['user_id'] = Auth::id();
        $this->question->find($id)->fill($editRecord)->save();
        return redirect()->route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->comment->searchCommentsOfQuestion($id)->delete();
        $this->question->find($id)->delete();
        return redirect()->route('question.index');
    }

    /**
     * confirm a newly created resource in storage.
     *
     * @param  QuestionsRequest  $request
     * @return QuestionsRequest
     */
    public function confirm(QuestionsRequest $request)
    {
        $inputs = $request->all();
        $serviceClass = app()->make(QuestionServiceProvider::class);
        $tagCategoryName = $serviceClass->selectTagCategoryName($request->tag_category_id);
        return view('user.question.confirm', compact('inputs', 'tagCategoryName'));
    }

    /**
     * mypage a newly created resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function mypage($userId)
    {
        $myRecords = $this->question->selectMyRecords($userId);
        return view('user.question.mypage', compact('myRecords'));
    }

    /**
     * commentStore a newly created resource in storage.
     *
     * @param  int $id
     * @param  CommentRequest $request
     * @return CommentRequest
     */
    public function storeComment(CommentRequest $request ,$id)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $this->comment->create($inputs);
        return redirect()->route('question.show',$id);
    }
}