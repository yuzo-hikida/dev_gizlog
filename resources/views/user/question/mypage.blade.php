@extends ('common.user')
@section ('content')
<h2 class="brand-header">
  <img src="{{ $user->avatar }}" class="avatar-img">&nbsp;&nbsp;My page
</h2>
<div class="main-wrap">
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">date</th>
          <th class="col-xs-1">category</th>
          <th class="col-xs-5">title</th>
          <th class="col-xs-2">comments</th>
          <th class="col-xs-1"></th>
          <th class="col-xs-1"></th>
        </tr>
      </thead>
      <tbody>
      @foreach($myRecords as $myRecord)
        <tr class="row">
          <td class="col-xs-2">{{ $myRecord->updated_at->format('Y-m-d') }}</td>
          <td class="col-xs-1">{{ $myRecord->tagcategory->name }}</td>
          <td class="col-xs-5">{{ mb_strimwidth($myRecord->title, 0, 50, '...', 'UTF-8') }}</td>
          <td class="col-xs-2"><span class="point-color">{{ $myRecord->comments->count() }}</span></td>
          <td class="col-xs-1">
            <a class="btn btn-success" href="{{ route('question.edit', $myRecord->id) }}">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
          </td>
          <td class="col-xs-1">
            {!! Form::open(['route' => ['question.destroy', $myRecord->id], 'method' => 'DELETE']) !!}
              <button class="btn btn-danger" type="submit">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </button>
            {!! form::close() !!}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

