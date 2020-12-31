@extends('layouts.hr')

@section('content')
@inject('provider', 'App\Http\Controllers\AccountController')

<style type="text/css">
  .status{
    cursor: pointer;
  }
</style>
<div class="box">
@if(Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif
@if(Session::has('error'))
<p class="alert alert-danger">{{ Session::get('error') }}</p>
@endif

<div class="row">
 <div class="col-md-12">
  <div class="box">
    <div class="box-header bg-gray">
    <div class="form-group">
      <label  class="col-sm-1 control-label">Select A Group</label>
      <div class="col-sm-2">
        <select class="form-control" required="" name="group" id="group">
            <option value="">Select A Group</option>
            @foreach($addgroups as $addgroup)
            <option value="{{$addgroup->id}}" {{ Request::get('group')==$addgroup->id ? 'selected' : '' }}>{{$addgroup->groupname}}</option>
            @endforeach
        </select>
      </div>
      <label  class="col-sm-1 control-label">From Date</label>
       <div class="col-sm-2">
        <input type="text" class="attfromdate form-control readonly" placeholder="Enter From Date" name="fromdate" id="fromdate" autocomplete="off">
      </div>
      <label  class="col-sm-1 control-label">To Date</label>
       <div class="col-sm-2">
        <input type="text" class="atttodate form-control readonly" placeholder="Enter To Date" name="todate" id="todate" autocomplete="off">
      </div>
      <div class="col-sm-1">
        <button type="button" onclick="filter()" class="btn  btn-primary">Filter</button>
      </div>
      <div class="col-sm-1">
        <button type="button" onclick="hello()" class="btn  btn-danger">Clear</button>
      </div>
    </div>
  </div>
</div>

<button type="button" onclick="exportTable()" class="btn btn-success pull-right">EXPORT</button>
</div>
</div>

      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped yajratable">
        <thead>
          <tr class="bg-navy">
            <td>Id</td>
            <td>GROUP NAME</td>
            <td>ENTRY TIME</td>
            <td>DEPARTURE TIME</td>
            <td>NUMBER OF WORKERS</td>
            <td>WAGES</td>
            <td>OT HOUR</td>
            <td>OT</td>
            <td>TOTAL AMOUNT</td>
            <td>REMARKS</td>
            <td>WORK ASSIGNMENT</td>
            <td>ITEM DESCRIPTION</td>
            <td>UNIT</td>
            <td>QUANTITY</td>
            <td>AMOUNT</td>
            <td>CREATED AT</td>
            <!-- <td>GROUP PHOTO</td> -->
            <td>EDIT</td>
            <td>VIEW</td>
          </tr>
        </thead>
        <tbody>
         
        </tbody>
            <tfoot>
              <tr style="background-color: gray;">
                <td></td>
                <td></td>
                <td></td>
                <td><strong>TOTAL</strong></td>
                <td id="noofworker" style="text-align: right;"></td>
                <td id="totalwages" style="text-align: right;"></td>
                <td id="tothour" style="text-align: right;"></td>
                <td id="totalotamt" style="text-align: right;"></td>
                <td id="totalamt" style="text-align: right;"></td>
                <td></td>
                <td></td>
                <td></td>
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

</div>

<div class="modal fade in" id="importemployee">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<form method="post" enctype="multipart/form-data" action="/importemployee">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
        <h4 class="modal-title text-center">Upload Employee Excel</h4>
      </div>
      <div class="modal-body">
      	
			  
			    {{ csrf_field() }}
			    <div class="form-group">
				<label>Select File for Upload Employee</label>
			        <input type="file" name="select_file" />
					<span class="text-muted">.xls, .xslx</span>
			    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-flat">Upload</button>
      </div>
      	</form>
    </div>
  </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>EDIT ATTENDANCE</b></h4>
      </div>
      <div class="modal-body">

    <form action="/updateattendance" method="post" enctype="multipart/form-data"> 
    {{csrf_field()}}
<table class="table table-responsive table-hover table-bordered table-striped">
<input type="hidden" id="uid" name="uid">

    <tr>
      <td><strong>ITEM DESCRIPTION</strong></td>
      <td><textarea class="form-control" id="itemdescription" name="itemdescription"></textarea></td>
    </tr>
    <tr>
      <td><strong>UNIT(KG/NO.)</strong></td>
      <td><input type="text" name="unit" id="unit" class="form-control" placeholder="Enter Unit"></td>
    </tr>
    <tr>
      <td><strong>QUANTITY</strong></td>
      <td><input type="text" name="quantity" id="quantity" class="form-control" placeholder="Enter QUANTITY"></td>
    </tr>
    <tr>
      <td><strong>AMOUNT</strong></td>
      <td><input type="text" name="amount" id="amount" class="form-control" placeholder="Enter AMOUNT"></td>
    </tr>
    <tr>
      <td><strong>WORK ASSIGNMENT</strong></td>
      <td><textarea class="form-control" id="workassignment" name="workassignment"></textarea></td>
    </tr>
    <tr>
      <td><strong>REMARKS</strong></td>
      <td><textarea class="form-control" id="remarks" name="remarks"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: right;"><button class="btn btn-success" type="submit">UPDATE</button></td>
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
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script>
  function hello(){
    $('#group').prop('selectedIndex',0)
    $('#fromdate').val('');
    $('#todate').val('');
    table.draw(true);
  }
  function exportTable(){
    var grp=$('#group').val();
    var fromdate=$('#fromdate').val();
    var todate=$('#todate').val();
    var url='/labourattendanceexport?group='+grp+'&fromdate='+fromdate+'&todate='+todate;
    //alert(url);
  window.open(
  url,
  '_blank' // <- This is what makes it open in a new window.
);
  }
  function edit(id,itemdescription,unit,quantity,amount,workassignment,remarks){
       //alert(itemdescription);
        $("#uid").val(id);
        $("#itemdescription").val(itemdescription);
        $("#unit").val(unit);
        $("#quantity").val(quantity);
        $("#amount").val(amount);
        $("#workassignment").val(workassignment);
        $("#remarks").val(remarks);
        $("#myModal").modal('show');
  }
  var table = $('.yajratable').DataTable({
        order: [[ 0, "asc" ]],
        processing: true, 
        serverSide: true,
        "iDisplayLength": 10,
          ajax: {
            url: '{{ url("getviewallattendancelist")  }}',
            data: function (d) {
                d.group = $('#group').val();
                d.fromdate=$('#fromdate').val();
                d.todate=$('#todate').val();
               
            }
        },
        columns: [

            {data: 'idbtn', name: 'id'},
            {data: 'groupname',name: 'addgroups.groupname'},    
            {data: 'entrytime',name: 'entrytime'},    
            {data: 'departuretime',name: 'departuretime'},    
            {data: 'noofworkerspresent',name: 'noofworkerspresent'},    
            {data: 'twages',name: 'twages'},    
            {data: 'tothour',name: 'tothour'},    
            {data: 'tot',name: 'tot'},    
            {data: 'tamt',name: 'tamt'},    
            {data: 'remarks',name: 'remarks'},    
            {data: 'workassignment',name: 'workassignment'},    
            {data: 'itemdescription',name: 'itemdescription'},    
            {data: 'unit',name: 'unit'},    
            {data: 'quantity',name: 'quantity'},    
            {data: 'amount',name: 'amount'},    
            {data: 'created_at',name: 'created_at'},
            {data: 'edit', name: 'edit'},    
            {data: 'view', name: 'view'},
                      

          

        ],
        drawCallback: function( settings ) {                        
        console.log(settings.json);
        $("#totalotamt").html(settings.json.totalotamt);
        $("#noofworker").html(settings.json.noofworker);
        $("#totalwages").html(settings.json.totalwages);
        $("#tothour").html(settings.json.tothour);
        //alert(settings.json.totalotamt);
        $("#totalamt").html(settings.json.totalamt);
      }

    });
   table.on( 'xhr', function () {
    var json = table.ajax.json();
    console.log(json.data);
   } );
  function filter(){
       table.draw(true);
  }

  
</script>

@endsection