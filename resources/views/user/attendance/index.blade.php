@extends ('common.user')
@section ('content')

<h2 class="brand-header">勤怠登録</h2>

<div class="main-wrap">

  <div id="clock" class="light">
    <div class="display">
      <div class="weekdays"></div>
      <div class="today"></div>
      <div class="digits"></div>
    </div>
  </div>
  <div class="button-holder">
      <a class="button
        @if (empty($attendanceStatus))
          start-btn
        @elseif (empty($attendanceStatus['start_time']))
          disabled
        @elseif (empty($attendanceStatus['end_time']))
          end-btn
        @else
          disabled
        @endif" id="register-attendance" href=#openModal>
        @if (empty($attendanceStatus))
            {{ '出社時間登録' }}
          @elseif (empty($attendanceStatus['start_time']))
            {{'欠席'}}
          @elseif (empty($attendanceStatus['end_time']))
            {{'退勤時間登録'}}
          @else
            {{'退社済み'}}
          @endif
      </a>
  </div>
  <ul class="button-wrap">
    <li>
      <a class="at-btn absence" href="{{ route('attendance.absence') }}">欠席登録</a>
    </li>
    <li>
      <a class="at-btn modify" href="{{ route('attendance.modify') }}">修正申請</a>
    </li>
    <li>
      <a class="at-btn my-list" href="{{ route('attendance.mypage') }}">マイページ</a>
    </li>
  </ul>
</div>

<div id="openModal" class="modalDialog">
  <div>
    <div class="register-text-wrap"><p>12:38 で出社時間を登録しますか？</p></div>
    <div class="register-btn-wrap">
      @if (empty($attendanceStatus))
        {!! Form::open(['route' => 'attendance.store']) !!}
      @elseif (isset($attendanceStatus['start_time']) && empty($attendanceStatus['end_time']))
        {!! Form::open(['route' => ['attendance.update', $attendanceStatus['id']], 'method' => 'PUT']) !!}
      @endif
          <a href="#close" class="cancel-btn">Cancel</a>
          {!! Form::submit('Yes', ['class' => 'yes-btn'])!!}
        {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection

