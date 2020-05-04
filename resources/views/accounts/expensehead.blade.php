@extends('layouts.account')
@section('content')

@if(Session::has('msg'))
   <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
   @endif
<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr class="bg-navy">
	 	<td class="text-center">Enter Expense Head Here</td>
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
<form action="/saveexpensehead" method="post">
	{{csrf_field()}}

	<table class="table table-responsive table-hover table-bordered table-striped">
	 <tr>
	 	 <td><strong>Enter Expense Head Name<span style="color: red"> *</span></strong></td>
	 	 <td><input type="text" name="expenseheadname" placeholder="Enter Expense Head Name" class="form-control" autocomplete="off"></td>
	 
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
			<td>EXPENSE HEAD NAME</td>
			<td>CREATED AT</td>
			<td>EDIT</td>
			<!-- <td>DELETE</td>
 -->
		</tr>
	</thead>
		<tbody>
		@foreach($expenseheads as $expensehead)
			<tr>
			  <td>{{$expensehead->id}}</td> 
			  <td>{{$expensehead->expenseheadname}}</td> 
			  <td>{{$expensehead->created_at}}</td>
			  <td><button type="button" class="btn btn-primary" onclick="openexpensehead('{{$expensehead->id}}','{{$expensehead->expenseheadname}}');">EDIT</button></td>
			 <!--  <td>
			  	<form action="/deleteexpensehead/{{$expensehead->id}}" method="post">
			  		{{csrf_field()}}
			  		{{method_field('DELETE')}}
			  		<button type="submit" onclick="return confirm('Dou You  want to delete this expense Head?');" class="btn btn-danger">DELETE</button>
			  		
			  	</form>
			  </td> -->
			  		
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
        <h4 class="modal-title">EDIT EXPENSE HEAD</h4>
      </div>
      <div class="modal-body">

     <form action="/updateexpensehead" method="post">
     	{{csrf_field()}}
       <table class="table table-responsive table-hover table-bordered table-striped">
       	<input type="hidden" name="eid" id="eid">
	 <tr>
	 	 <td><strong>Enter Expense Head Name<span style="color: red"> *</span></strong></td>
	 	 <td><input type="text" name="expenseheadname" id="expenseheadname" placeholder="Enter Expense Head Name" class="form-control"></td>
	 
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
	function openexpensehead(id,expenseheadname) {

        $("#eid").val(id);
        $("#expenseheadname").val(expenseheadname);
		$("#myModal").modal('show');


		
	}
</script>
@endsection