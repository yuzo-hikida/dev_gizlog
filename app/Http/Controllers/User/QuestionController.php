<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuestionsRequest;
use App\Models\Question;
use App\Models\TagCategory;
use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
{
    protected $question;
    protected $tagCategory;

    public function __construct(Question $question,  TagCategory $tagCategory)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->tagCategory = $tagCategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $userId = Auth::id();
        $inputs = $request->all();
        $questions = $this->question->getQuestionRecord($inputs);
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
        return view('user.question.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function edit($id)
    {
        $changeValue = $this->question->selectMyRecord($id);
        // dd($changeValue);
        // $change = $changeValue->find($id);
        // dd($change);
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
        //
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
        // dd($tagCategoryName);
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

}