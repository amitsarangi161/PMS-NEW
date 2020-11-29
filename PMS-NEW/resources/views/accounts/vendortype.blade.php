@extends('layouts.account')
@section('content')

@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
   @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">Enter Vendor Type</td>
	 </tr>
</table>

@if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div><br />
      @endif
<div class="well" style="background-color: cadetblue;">
<form action="/savevendortype" method="post">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	 <td><strong>Enter Vendor Type Name<span style="color: red"> *</span></strong></td>
	 	 <td><input type="text" name="vendortype" placeholder="Enter Vendor Type Name" class="form-control" autocomplete="off"></td>
	 
	 	<td colspan="2"><button type="submit" class="btn btn-success">ADD</button></td>
	 </tr>
</table>
</form>
</div>
<div class="table-responsive">
<table class="table table-hover table-bordered table-striped datatable">
	<thead>
		<tr class="bg-navy">
			<td>ID</td>
			<td>VENDORTYPE</td>
			<td>EDIT</td>
			<!-- <td>DELETE</td>
 -->
		</tr>
	</thead>
		<tbody>
		@foreach($vendortypes as $vendortype)
			<tr>
			  <td>{{$vendortype->id}}</td> 
			  <td>{{$vendortype->vendortype}}</td>
			  <td><button type="button" class="btn btn-primary" onclick="openvendortype('{{$vendortype->id}}','{{$vendortype->vendortype}}');">EDIT</button></td>
			  		
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
        <h4 class="modal-title">EDIT VENDOR TYPE</h4>
      </div>
      <div class="modal-body">

     <form action="/updatvendortype" method="post">
     	{{csrf_field()}}
       <table class="table table-responsive table-hover table-bordered table-striped">
       	<input type="hidden" name="eid" id="eid">
	 <tr>
	 	 <td><strong>Enter Vendor Type<span style="color: red"> *</span></strong></td>
	 	 <td><input type="text" name="vendortype" id="vendortype" placeholder="Enter Expense Head Name" class="form-control"></td>
	 
	 	<td colspan="2"><button type="submit" class="btn btn-success">UPDATE</button></td>
	 </tr>
      </table>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">
	function openvendortype(id,vendortype) {

        $("#eid").val(id);
        $("#vendortype").val(vendortype);
		$("#myModal").modal('show');


		
	}
</script>
@endsection