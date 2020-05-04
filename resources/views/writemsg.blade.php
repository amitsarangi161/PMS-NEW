@extends('layouts.app')

@section('content')
<div class="well">
	<form action="/usersendmessage" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
	<table class="table">
		<tr>
			<td width="40%"><strong>TO</strong></td>
			<td>
				<select class="select2 form-control" name="reciver" required="">
					<option>Select a User</option>
					@foreach($users as $user)


                      @if($user->designation=='')
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @else
                      <option value="{{$user->id}}">{{$user->name}}({{$user->designation}})</option>
                    @endif
					@endforeach
					
				</select>
			</td>
		</tr>
		<tr>
			<td width="40%"><strong>YOUR MESSAGE</strong></td>
			<td>
				<textarea class="form-control" name="message"></textarea>
			</td>
		</tr>
		<tr>
			<td><strong>ATTACHMENT</strong></td>
			<td>
				<input type="file" name="attachment" class="form-control">
			</td>
		</tr>

		<tr>
			<td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success btn-lg">SEND</button></td>
		</tr>
		
	</table>
	</form>
</div>



@endsection