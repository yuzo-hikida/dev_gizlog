@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['report.update', $report->id], 'method' => 'PUT']) !!}
      {!! Form::hidden('user_id', 4, ['class' => 'form-control'])!!}
      <div class="form-group form-size-small">
        {!! Form::date('reporting_time', $report->reporting_time, ['class' => 'form-control']) !!}
      <span class="help-block"></span>
      </div>
      <div class="form-group @if (!empty($errors->first('title'))) has-error @endif">
        {!! Form::input('text', 'title', $report->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
      <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group @if (!empty($errors->first('content'))) has-error @endif">
        {!! Form::textarea('content', $report->content, ['class' => 'form-control', 'placeholder' => '本文']) !!}
      <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {!! Form::submit('Update', ['class' => 'btn btn-success pull-right'])!!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

