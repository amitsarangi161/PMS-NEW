@extends('layouts.app')

@section('content')

@foreach($users as $user)
  
   @if($user->isOnline())
      <li class="text-success">
      	{{$user->name}} Online
      </li>
   @else
      <li class="text-muted">
      {{$user->name}}  offline!!
      </li>
   @endif
@endforeach

@endsection