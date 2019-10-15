<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuestionsRequest;
use App\Models\Question;
use App\Models\TagCategory;
use App\Models\Comment;


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
     * @return QuestionsRequest
     */
    public function index(QuestionsRequest $request)
    {
        $inputs = $request->all();
        $questions = $this->question->getQuestionRecord($inputs)->paginate(10);
        $request->flashOnly(['search_word']);
        return view('user.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Respons
     */
    public function create()
    {
        return view('user.question.create');
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
        $comments = $this->comment->selectComment($id);
        return view('user.question.show',compact('showQuestion','comments'));
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
        return view('user.question.edit', compact('changeValue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  QuestionsRequest  $request
     * @param  int  $id
     * @return QuestionsRequest
     */
    public function update(QuestionsRequest $request, $id)
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
     * @param  QuestionsRequest;  $request
     * @return QuestionsRequest
     */
    public function confirm(QuestionsRequest $request)
    {
        $inputs = $request->all();
        $tagCategoryName = tagCategory::find($request)->first();//なんでfindの引数に数字じゃなくて＄requestを入れて値が取れるのか
        return view('user.question.confirm', compact('inputs', 'tagCategoryName'));
    }

    /**
     * mypage a newly created resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function mypage($id)
    {
        $myRecords = $this->question->selectMyRecords($id)->paginate(10);
        return view('user.question.mypage', compact('myRecords'));
    }

    /**
     * commentStore a newly created resource in storage.
     *
     * @param  QuestionsRequest;  $request
     * @return QuestionsRequest
     */
    public function commentStore(QuestionsRequest $request ,$id)
    {
        $inputs = $request->all();
        $this->comment->create($inputs);
        return redirect()->to('question/'.$id);
    }
}