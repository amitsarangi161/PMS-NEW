@extends('layouts.app')
@section('content')
<style type="text/css">
	.select2-container--default .select2-selection--multiple .select2-selection__choice {

    background-color: #3c8dbc!important;
    border: 1px solid #3c8dbc!important;
  

}
</style>
<div class="well">
	<table class="table">
		<tr class="bg-blue">
			<td class="text-center">CREATE A NOTIFICATION</td>
		</tr>
		
	</table>
<form action="/savenotification" method="post">
	{{csrf_field()}}
<table class="table">
	<tr>
		<td><strong>DESCRIPTION *</strong></td>
		<td>
			<textarea name="description" class="form-control" required=""></textarea>
		</td>
	</tr>
	<tr>
	   <td><strong>ALERT TYPE *(monthly/daily)</strong></td>
	   <td>
	   	<select class="form-control" name="type" required="">
	   		<option value="">select a type</option>
	   		<option value="DAILY">DAILY</option>
	   		<option value="MONTHLY">MONTHLY</option>
	   		
	   	</select>
	   </td>
	</tr>

	<tr>
		<td><strong>Select Users</strong></td>
		<td>
			<select class="form-control select2" name="users[]" multiple="multiple" data-placeholder="Select users"
                        style="width: 100%;" required="">
            @foreach($users as $user)
                   <option value="{{$user->id}}">{{$user->name}}</option>

            @endforeach
                        	
        </select>
    </td>
	</tr>
	<tr>
		<td><strong>If it is a Payment Alert?</strong></td>
		<td>
			<select name="paymentalert" class="form-control">
				<option value="NO">NO</option>
				<option value="YES">YES</option>
				 
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="4" style="text-align: right;"><button class="btn btn-success" type="submit">Submit</button></td>
	</tr>
	
</table>
</form>
	
</div>


@endsection