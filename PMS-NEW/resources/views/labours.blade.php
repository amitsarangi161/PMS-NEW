@extends('layouts.app')
@section('content')
<table class="table">
	<tr class="bg-blue">
		<td class="text-center">MANAGE LABOURS</td>
	</tr>
	
</table>

<table class="table">
	 @if(Session::has('msg'))
   <p class="alert alert-info text-center">{{ Session::get('msg') }}</p>
   @endif
   @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div><br />
      @endif
	<form  action="/savelabour" method="post">
		{{csrf_field()}}
	<tr>
		<td><strong>LABOUR NAME  *</strong></td>
		<td><input type="text" autocomplete="off" name="labourname" class="form-control" required="" placeholder="Enter Labour Name"></td>

	</tr>
	<tr>
	  <td><strong>ADDRESS *</strong></td>
	  <td>
	  	<textarea name="address" class="form-control" placeholder="Enter Labour Address" required=""></textarea>
	  </td>
	</tr>
	<tr>
		<td><strong>MOBILE</strong></td>
		<td>
			<input type="number" name="mobile" placeholder="Enter Your Mobile" class="form-control" required="">
		</td>
		
	</tr>
	<tr>
		<td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit">SAVE</button></td>
	</tr>
   </form>
</table>
<div class="table-responsive">

<table class="table table-responsive table-hover table-bordered table-striped datatable">
	<thead>
		<tr class="bg-navy">
			<td>ID</td>
			<td>LABOUR NAME</td>
			<td>LABOUR ADDRESS</td>
			<td>MOBILE</td>
			<td>EDIT</td>
		</tr>
	</thead>
	<tbody>
		
			@foreach($labours as $labour)
			<tr>
			<td>{{$labour->id}}</td>
			<td>{{$labour->labourname}}</td>
			<td>{{$labour->address}}</td>
			<td>{{$labour->mobile}}</td>
			<td><button type="button" class="btn btn-primary" onclick="openedit('{{$labour->id}}','{{$labour->labourname}}','{{$labour->address}}','{{$labour->mobile}}')">EDIT</button></a></td>
			</tr>
			@endforeach
	
	</tbody>
</table>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center"><strong>EDIT LABOURS</strong></h4>
      </div>
      <div class="modal-body">
          <table class="table">
  
	<form  action="/updatelabour" method="post">
		{{csrf_field()}}

		<input type="hidden" name="lid" id="lid">
	<tr>
		<td><strong>LABOUR NAME  *</strong></td>
		<td><input type="text" autocomplete="off" name="labourname" id="labourname" class="form-control" required="" placeholder="Enter Labour Name"></td>

	</tr>
	<tr>
	  <td><strong>ADDRESS *</strong></td>
	  <td>
	  	<textarea name="address" class="form-control" id="address" placeholder="Enter Labour Address" required=""></textarea>
	  </td>
	</tr>
	<tr>
		<td><strong>MOBILE</strong></td>
		<td>
			<input type="number" name="mobile" id="mobile" placeholder="Enter Your Mobile" class="form-control" required="">
		</td>
		
	</tr>
	<tr>
		<td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit">SAVE</button></td>
	</tr>
   </form>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
	function openedit(id,labourname,address,mobile)
	{

		    $("#lid").val(id);
		    $("#labourname").val(labourname);
		    $("#address").val(address);
		    $("#mobile").val(mobile);
		   $("#myModal").modal('show');
	}
</script>

@endsection