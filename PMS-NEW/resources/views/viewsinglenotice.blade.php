@extends('layouts.start')
@section('content')

<div class="container">
  <div class="col-sm-12">
      <h6 class="pull-right"><i class="far fa-clock"></i> {{$notice->created_at}}</h6>
  </div>
  <div class="well single-notice">
    <div class="container-fluid">
    <div class="col-sm-12">
      <h4 class="text-center" style="font-size: 2em;letter-spacing: 1px;line-height: 30px;color: #2bbbad">{{$notice->subject}}</h4>
    </div>
    <div class="col-sm-12">
      <p>
      	{{$notice->description}}
      </p>
    </div>
  </div>
</div>

@if($notice->attachment!='')
<p style="font-size: 24px;font-weight: bold;color: red;">Attachment</p>
<a href="{{asset('/img/notice/'.$notice->attachment)}}" target="_blank">
<img src="/attachment.png" class="img-responsive" style="height: 100px;">
<p>{{$notice->attachment}}</p>
</a>
@endif
</div>

@endsection