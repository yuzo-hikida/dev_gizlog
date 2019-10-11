@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問詳細</h1>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      <img src="@if(empty($showQuestion->user->avatar)) http://acbio2.acbio.u-fukui.ac.jp/gousei/img/image5.png @endif {{$showQuestion->user->avatar}}" class="avatar-img">
      <p>{{ $showQuestion->user->name }}&nbsp;さんの質問&nbsp;&nbsp;({{ $tagCategoryName->name }}&nbsp;&nbsp;)&nbsp;&nbsp;{{ $showQuestion->updated_at->format('Y-m-d H:i') }}</p>
      <p class="question-date"></p>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $showQuestion->title }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{{ $showQuestion->content }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  @foreach($comments as $comment)
    <div class="comment-list">
        <div class="comment-wrap">
          <div class="comment-title">
            <img src="@if(empty($showQuestion->user->avatar)) http://acbio2.acbio.u-fukui.ac.jp/gousei/img/image5.png @endif {{$showQuestion->user->avatar}}" class="avatar-img">
            <p>{{ $showQuestion->user->name }}</p>
            <p class="comment-date">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
          </div>
          <div class="comment-body">{{ $comment->comment }}</div>
        </div>
    </div>
    @endforeach
  <div class="comment-box">
    {!! Form::open(['route' => ['question.commentStore', $showQuestion->id]]) !!}
      {!! Form::hidden('user_id', Auth::id()) !!}
      {!! Form::hidden('question_id', $showQuestion->id) !!}
      <div class="comment-title">
        <img src="{{ Auth::user()->avatar }}" class="avatar-img"><p>コメントを投稿する</p>
      </div>
      <div class="comment-body @if(!empty($errors->first('comment'))) has-error @endif">
        {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Add your comment...']) !!}
        <span class="help-block">{{ $errors->first('comment') }}</span>
      </div>
      <div class="comment-bottom">
        <button type="submit" class="btn btn-success">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </button>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection