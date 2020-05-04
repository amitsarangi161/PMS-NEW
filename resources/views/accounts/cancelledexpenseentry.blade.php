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
<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped yajratable">
	<thead>
		<tr class="bg-navy" style="font-size: 10px;">
			<th>ID</th>
			<th>EMPLOYEE</th>
			<th>PROJECT</th>
			<th>CLIENT</th>
			<th>EXPENSE HEAD</th>
      <th>PARTICULAR</th>
			<th>VENDOR</th>
      <th>STATUS</th>
      <th>AMOUNT</th>
      <th>APPROVAL AMOUNT</th>
			<th>APPROVED BY</th>
			<th>ADDED BY</th>
			<th>CREATED AT</th>
      <th>UPLOADED FILE</th>
      <th>VIEW</th>
		</tr>
	</thead>
	<tbody>

	</tbody>
   <tfoot>
    <tr style="background-color: gray;">
      <td colspan="7"></td>
      <td><strong>TOTAL</strong></td>
      <td id="sumamt" style="text-align: right;"></td>
      <td id="sumapproveamt" style="text-align: right;"></td>
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
        order: [[ 0, "desc" ]],

        ajax: "{{ route('getaccountcancelledexpenseentry') }}",

        columns: [

         
            {data: 'idbtn', name: 'expenseentries.id'},
            {data: 'for',name: 'u1.name'},
            {data: 'pro',name: 'projects.projectname'},
            {data: 'clientname',name: 'clients.clientname'},
            {data: 'expenseheadname',name: 'expenseheads.expenseheadname'},
            {data: 'particularname',name: 'particulars.particularname'},
            {data: 'vendorname',name: 'vendors.vendorname'},
            {data: 'sta',name: 'expenseentries.status'},
            {data: 'amount',name: 'expenseentries.amount'},
            {data: 'approvalamount',name: 'expenseentries.approvalamount'},
            {data: 'approvedbyname',name: 'u3.name'},
            {data: 'by',name: 'u2.name'},
            {data: 'created_at',name: 'expenseentries.created_at'},
            {data: 'images',name: 'images'},
            {data: 'view',name: 'view'},
           
           
            

          

        ],

        drawCallback: function( settings ) {
                                 
        console.log(settings.json);
        $("#sumamt").text(settings.json.sumamt);
        $("#sumapproveamt").text(settings.json.sumapproveamt);
      }

    });

    

  });
  </script>
@endsection