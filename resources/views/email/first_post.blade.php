<p>Hi, a new user has posted a job for the first time, please details below:</p>
<p>Title: {{ $mrgeJob->name }}</p>

@foreach($mrgeJob->descriptions as $description)

  <div style='padding: 10px'>
    <p><b>{{$description->name}}</b></p>
    <p>{!! html_entity_decode($description->value) !!}</p>
  </div>

@endforeach

<a href="{{ $app->make('url')->to('/admin/jobs/'.$mrgeJob->id.'/approve') }}">Approve</a> | <a href="{{ $app->make('url')->to('/admin/jobs/'.$mrgeJob->id.'/mark_as_spam') }}">Mark as Spam</a>