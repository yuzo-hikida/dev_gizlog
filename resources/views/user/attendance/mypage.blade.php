@extends ('common.user')
@section ('content')

<h2 class="brand-header">マイページ</h2>
<div class="main-wrap">
  <div class="btn-wrapper">
    <div class="my-info day-info">
      <p>学習経過日数</p>
      <div class="study-hour-box clearfix">
        <div class="userinfo-box"><img src= "{{$myRecords->first()->user->avatar ?? 'https://c.tipsfound.com/windows10/02014/8.png'}}"></div>
        <p class="study-hour"><span>{{ $myRecords->where('end_time','!=',  Null)->count() }}</span>{{'日'}}</p>
      </div>
    </div>
    <div class="my-info">
      <p>累計学習時間</p>
      <div class="study-hour-box clearfix">
        <div class="userinfo-box"><img src="{{$myRecords->first()->user->avatar ?? 'https://c.tipsfound.com/windows10/02014/8.png'}}"></div>
        <p class="study-hour"><span>{{ $cumulativeTime }}</span>{{'時間'}}</p>
      </div>
    </div>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table">
      <thead>
        <tr class="row">
          <th class="col-xs-2">date</th>
          <th class="col-xs-3">start time</th>
          <th class="col-xs-3">end time</th>
          <th class="col-xs-2">state</th>
          <th class="col-xs-2">request</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($myRecords as $myRecord)
      <tr class="row @if (empty($myRecord->start_time)) absent-row @endif">
        <td class="col-xs-2">{{ $myRecord->created_at->format('m/d(D)') }}</td>
        <td class="col-xs-3">{{ $myRecord->start_time ? $myRecord->start_time->format('H:m') : '-' }}</td>
        <td class="col-xs-3">{{ $myRecord->end_time ? $myRecord->end_time->format('H:m') : '-' }}</td>
        <td class="col-xs-2">@if (empty($myRecord->start_time)) {{ '欠席' }} @elseif (empty($myRecord->end_time)) {{ '研修中' }} @else {{  '出社' }} @endif</td>
        <td class="col-xs-2">@if (!empty($myRecord->is_request)) {{'申請中'}} @else {{'-'}} @endif</td>
      </tr>
      @endforeach
      <!-- <tr class="row absent-row">
        <td class="col-xs-2">07/02 (Tue)</td>
        <td class="col-xs-3">-</td>
        <td class="col-xs-3">-</td>
        <td class="col-xs-2">欠席</td>
        <td class="col-xs-2">-</td>
      </tr>
      <tr class="row">
        <td class="col-xs-2">07/03 (Wed)</td>
        <td class="col-xs-3">10:44</td>
        <td class="col-xs-3">19:37</td>
        <td class="col-xs-2">出社</td>
        <td class="col-xs-2">申請中</td>
      </tr>
      <tr class="row">
        <td class="col-xs-2">07/04 (Thr)</td>
        <td class="col-xs-3">08:52</td>
        <td class="col-xs-3">-</td>
        <td class="col-xs-2">研修中</td>
        <td class="col-xs-2">-</td>
      </tr> -->
      </tbody>
    </table>
  </div>
</div>

@endsection

