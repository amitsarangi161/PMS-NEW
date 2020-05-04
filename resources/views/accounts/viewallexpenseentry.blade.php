@extends('layouts.account')
@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')

<style type="text/css">


       .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   

}
</style>

<table  class="table table-responsive table-hover table-bordered table-striped">
  <form method="POST" id="search-form" class="form-inline" role="form">
  <tr>
    <td width="10%"><strong>Select a Users</strong></td>
    <td width="30%">

      <select class="form-control select2" name="user" id="name">
        <option value="">Select a User</option>
        @foreach($users as $user)
        <option value="{{$user->id}}" {{ ( $user->id == Request::get('user')) ? 'selected' : '' }}>{{$user->name}}</option>
        @endforeach
        
      </select>
    </td>
    <td width="10%"><strong>Select a Expense Head</strong></td>
    <td width="30%">

      <select class="form-control select2" name="expensehead" id="expensehead">
        <option value="">Select a Expense Head</option>
        @foreach($expenseheads as $expensehead)
        <option value="{{$expensehead->id}}" {{ ( $expensehead->id == Request::get('expensehead')) ? 'selected' : '' }}>{{$expensehead->expenseheadname}}</option>
        @endforeach
        
      </select>
    </td>
   
  
    <td width="10%"><button type="submit" class="btn btn-info">FETCH</button></td>
  </tr>
  </form>
  
</table>
<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped yajratable">
	<thead>
		<tr class="bg-navy" style="font-size: 10px;">
			<th>ID</th>
			<th>EMPLOYEE</th>
			<th>PROJECT</th>
			<th>EXPENSE HEAD</th>
      <th>PARTICULAR</th>
      <th>VENDOR</th>
			<th>STATUS</th>
      <th>AMOUNT</th>
      <th>APPROVAL AMOUNT</th>
			<th>APPROVED BY</th>
			<th>ADDED BY</th>
			<th>FROM-TO</th>
      <th>UPLOADED FILE</th>
      <th>VIEW</th>
			<th class="noprint">DELETE</th>

		</tr>
	</thead>
	<tbody>
   
	</tbody>

     <tfoot>
    <tr style="background-color: gray;">
      <td colspan="6"></td>
      <td><strong>TOTAL</strong></td>
      <td id="sumamt" style="text-align: right;"></td>
      <td id="sumapproveamt" style="text-align: right;"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tfoot>

	
</table>
</div>

<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

  $(function () {

    

    var table = $('.yajratable').DataTable({

        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("getaccountexpenseentrylist")  }}',
            data: function (d) {
                d.name = $('#name').val();
                d.expensehead = $('#expensehead').val();
               
            }
        },
        order: [[ 0, "desc" ]],

        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columns: [
            {data: 'idbtn', name: 'expenseentries.id'},
            {data: 'for',name: 'u1.name'},
            {data: 'pro',name: 'projects.projectname'},
            {data: 'expenseheadname',name: 'expenseheads.expenseheadname'},
            {data: 'particularname',name: 'particulars.particularname'},
            {data: 'vendorname',name: 'vendors.vendorname'},
            {data: 'sta',name: 'expenseentries.status'},
            {data: 'amount',name: 'expenseentries.amount'},
            {data: 'approvalamount',name: 'expenseentries.approvalamount'},
            {data: 'approvedbyname',name: 'u3.name'},
            {data: 'by',name: 'u2.name'},
            {data: 'dates',name: 'dates'},
            {data: 'images',name: 'images'},
            {data: 'view',name: 'view'},
            {data: 'delete',name: 'delete'}, 
        ],

        drawCallback: function( settings ) {
                                 
        console.log(settings.json);
        $("#sumamt").text(settings.json.sumamt);
        $("#sumapproveamt").text(settings.json.sumapproveamt);
      }


       

    });

      table.on( 'xhr', function () {
    var json = table.ajax.json();
    console.log(json.data);
} );
  $('#search-form').on('submit', function(e) {
        e.preventDefault();
       
       table.draw(true);
       
    });
    
  });

  


  </script>
@endsection