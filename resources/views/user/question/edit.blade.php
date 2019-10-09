@extends ('common.user')
@section ('content')
<h1 class="brand-header">質問編集</h1>
<div class="main-wrap">
  <div class="container">
    <!-- <form> -->
    {!! Form::open(['route' => ['question.confirm'], 'method' => 'GET'])!!}
      <div class="form-group @if(!empty($errors->first('tag_category_id'))) has-error @endif">
        <!-- <select name='tag_category_id' class = "form-control selectpicker form-size-small" id ="pref_id"> -->
        {!! Form::select('tag_category_id',[
        '' => 'Select category',
        0 => 'all',
        1 => 'front',
        2 => 'back',
        3 => 'infra',
        4 => 'others',
        ], null, ['class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id']) !!}
          <!-- <option value=""></option>
            <option value= ""></option> -->
        <!-- </select> -->
        <span class="help-block">{{ $errors->first('tag_category_id')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('title'))) has-error @endif">
        <!-- <input class="form-control" placeholder="title" name="title" type="text" value="{{ $changeValue->title }}"> -->
        {!! Form::text('title', $changeValue->title , ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block">{{ $errors->first('title')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('content'))) has-error @endif">
        <!-- <textarea class="form-control" placeholder="Please write down your question here..." name="content" cols="50" rows="10"></textarea> -->
        {!! Form::textarea('content', $changeValue->content, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
        <span class="help-block">{{ $errors->first('content')}}</span>
      </div>
      {!! Form::hidden('id', $changeValue->id) !!}
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="update">
      <!-- {!! Form::submit('update', ['class' => 'btn btn-success pull-right']) !!} -->
    <!-- </form> -->
    {!! Form::close()!!}
  </div>
</div>

@endsection

