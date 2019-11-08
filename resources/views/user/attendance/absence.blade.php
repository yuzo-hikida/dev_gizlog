@extends ('common.user')
@section ('content')

<h2 class="brand-header">欠席登録</h2>
<div class="main-wrap">
  <div class="container">
    <!-- <form> -->
      {!! Form::open(['route' => ['attendance.absenceRegistration']]) !!}
      <div class="form-group @if(!empty($errors->first('absence_comment'))) has-error @endif">
        <!-- <textarea class="form-control" placeholder="欠席理由を入力してください。" name="" cols="50" rows="10"></textarea> -->
        {!! Form::textarea('absence_comment', null, ['class' => 'form-control', 'placeholder' => '欠席理由を入力してください。']) !!}
        <span class='help-block'>{{ $errors->first('absence_comment') }}</span>
      </div>
      <!-- <input name="confirm" class="btn btn-success pull-right" type="submit" value="登録"> -->
      {!! Form::submit('登録', ['name' => 'confirm', 'class' => 'btn btn-success pull-right'])!!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

