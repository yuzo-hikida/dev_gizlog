<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuestionsRequest;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\TagCategory;
use App\Models\Comment;

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
     * @return Request
     */
    public function index(Request $request)
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
        $pluckedCategories = $this->tagCategory->tagCategories();
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
        $this->question->create($inputs);
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        $showQuestion = $this->question->selectMyRecord($userId);
        $comments = $this->comment->selectComment($userId);
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
        $pluckedCategories = $this->tagCategory->tagCategories();
        return view('user.question.edit', compact('changeValue', 'pluckedCategories'));
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
     * @param  QuestionsRequest;  $request
     * @return QuestionsRequest
     */
    public function confirm(QuestionsRequest $request)
    {
        $inputs = $request->all();
        $tagCategoryName = $this->tagCategory->find($request->tag_category_id)->name;
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
        $myRecords = $this->question->selectMyRecords($userId)->paginate(10);
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
        return redirect()->route('question.show',$id);
    }
}