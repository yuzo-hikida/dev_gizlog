@extends ('common.user')
@section ('content')
<h1 class="brand-header">質問編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['question.confirm'], 'method' => 'GET']) !!}
      <div class="form-group @if(!empty($errors->first('tag_category_id'))) has-error @endif">
      {!! Form::select('tag_category_id', $pluckedCategories, $changeValue->tag_category_id, ['class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id']) !!}
        <span class="help-block">{{ $errors->first('tag_category_id')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('title'))) has-error @endif">
        {!! Form::text('title', $changeValue->title , ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block">{{ $errors->first('title')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('content'))) has-error @endif">
        {!! Form::textarea('content', $changeValue->content, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {!! Form::hidden('id', $changeValue->id) !!}
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="update">
    {!! Form::close()!!}
  </div>
</div>

@endsection

