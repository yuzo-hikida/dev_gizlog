<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuestionsRequest;
use App\Models\Question;
use App\Models\TagCategory;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
{
    protected $question;
    protected $comment;

    public function __construct(Question $question,  Comment $comment)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs = $request->all();
        $questions = $this->question->getQuestionRecord($inputs);
        $request->flashOnly(['search_word']);
        return view('user.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $this->question->create($inputs);
        return redirect()->to('question');
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
        $tagCategoryId = $showQuestion['tag_category_id'];
        $tagCategoryName = tagCategory::find($tagCategoryId);
        $comments = $this->comment->selectComment($id);
        return view('user.question.show',compact('showQuestion', 'tagCategoryName','comments'));
    }

    /**
     * edit the form for editing the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function edit($id)
    {
        $changeValue = $this->question->selectMyRecord($id);
        return view('user.question.edit', compact('changeValue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $editRecord = $request->all();
        $this->question->find($id)->fill($editRecord)->save();
        return redirect()->to('question');
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
        return redirect()->to('question');
    }

    /**
     * confirm a newly created resource in storage.
     *
     * @param  app\Http\Requests\User\QuestionsRequest;  $request
     * @return app\Http\Requests\User\QuestionsRequest
     */
    public function confirm(QuestionsRequest $request)
    {
        $inputs = $request->all();
        $input = $inputs['tag_category_id'];
        $confirm = $inputs['confirm'];
        $tagCategoryName = tagCategory::find($input);
        return view('user.question.confirm', compact('inputs', 'tagCategoryName', 'confirm'));
    }

    /**
     * mypage a newly created resource in storage.
     *
     * @param
     * @return
     */
    public function mypage($id)
    {
        $user = Auth::user();
        $myRecords = $this->question->selectMyRecords($id);
        return view('user.question.mypage', compact('myRecords', 'user'));
    }

    /**
     * commentStore a newly created resource in storage.
     *
     * @param  app\Http\Requests\User\QuestionsRequest;  $request
     * @return app\Http\Requests\User\QuestionsRequest
     */
    public function commentStore(QuestionsRequest $request ,$id)
    {
        $inputs = $request->all();
        $this->comment->create($inputs);
        return redirect()->to('question/'.$id);
    }
}