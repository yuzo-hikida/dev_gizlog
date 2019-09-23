@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
  <div class="main-wrap">
    <div class="container">
    {!! Form::open(['route' => 'report.store']) !!}
        <!-- <input class="form-control" name="user_id" type="hidden"> -->
        {!! Form::hidden('user_id', 'null', ['class' => 'form-control']) !!}
        <div class="form-group form-size-small">
      <!-- <input class="form-control" name="reporting_time" type="date"> -->
      {!! Form::date('reporting_time', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
      <span class="help-block"></span>
      </div>
      <div class="form-group">
        <!-- <input class="form-control" placeholder="Title" name="title" type="text"> -->
        {!! Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        <!-- <textarea class="form-control" placeholder="Content" name="contents" cols="50" rows="10"></textarea> -->
        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'content']) !!}
        <span class="help-block"></span>
      </div>
      <!-- <button type="submit" class="btn btn-success pull-right">Add</button> -->
      {!! Form::submit('Add', ['class' => 'btn btn-success pull-right']) !!}
      {!! Form::close() !!}
    </div>
  </div>

@endsection

