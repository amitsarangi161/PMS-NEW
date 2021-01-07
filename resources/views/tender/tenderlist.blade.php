@extends('layouts.tender')
@section('content')
@inject('provider', 'App\Http\Controllers\TenderController')
   @if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
   @endif
   @if(Session::has('status'))
   <p class="alert alert-success text-center">{{ Session::get('status') }}</p>
   @endif
   @if(Session::has('error'))
    <p class="alert alert-danger text-center">{{ Session::get('error') }}</p>
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
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}


.blink {
   background-color:#ddf0a7bd !important;
}
table {
    width: 100%;
}

</style>
<table class="table">
    <tr class="bg-navy">
        <td class="text-center">CURRENT TENDER LIST</td>
        
    </tr>
</table>
 <form method="POST" id="search-form" class="form-inline" role="form">
<table class="table">
    <tr>
        <td>Select A Status</td>
        <td>
            <select name="status" id="status" class="form-control select2" required="">
            <option value="">Select A Status</option>
            @foreach($statuses as $status)
             <option value="{{$status->status}}">{{$status->status}}</option>

             @endforeach   
            </select>
        </td>
        <td>
            <button type="submit" class="btn btn-primary">FILTER</button>
        </td>
    </tr>
    
</table>
</form>
<div class="box-header">
    <div class="row">
        <p>
            <span class="pull-right"><button type="submit" class="btn bg-navy btn-flat margin" data-toggle="modal" data-target="#importsavetender" onclick="importsavetender();"><i class="fa fa-file-excel-o"></i> Import Trender</button>
                <a href="/TendorImportSample.xlsx" download="/tendersample.xlsx" class="btn bg-orange btn-flat margin"><i class="fa fa-download"></i> Sample</a>
          </span>
          
        </p>
    </div>
  </div>
<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped yajratable">
    <thead>
        <tr class="bg-blue">
            <td>ID</td>
            <td>NAME OF WORK</td>
            <td>CLIENT</td>
            <td>LOCATION</td>
            <td>TENDER REF NO</td>
            <td>WORK VALUE</td>
            <td>PAPER AMOUNT</td>
            <td>GST AMOUNT</td>
            <td>LAST DATE OF SUB.</td>
            <td>EMD Amount</td>
            <td>STATUS</td>
            <td>AUTHOR</td>
            <td>VIEW</td>
            <td>EDIT</td>
            <td>CREATED AT</td>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
</div>
@if(Auth::user()->usertype=='MASTER ADMIN')
<div id="revokeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CHANGE STATUS</h4>
      </div>
      <div class="modal-body">
        <form action="/revokestatus" method="POST">
          {{csrf_field()}}
        <table class="table">
          <input type="hidden" name="tid" id="tid" required="">
          <tr>
          <td><strong>Select a Status</strong></td>
          <td>
         <select class="form-control" name="status" required="">
              <option value="">Select a Status</option>
                              <option value="ASSIGNED TO USER">ASSIGNED TO USER</option>
                              <option value="ELLIGIBLE">TO COMMITTEE</option>
                              
                            
            </select>
          </td>
          </tr>
          <tr>
            <td><strong>REMARKS</strong></td>
            <td>
              <textarea name="remarks" class="form-control" required=""></textarea>
            </td>
          </tr>
          <td>
            <button type="submit" class="btn btn-success" onclick="confirm('Do You want to change this ?')">CHANGE</button>
          </td>
          
        </table>
        </form>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endif
<div class="modal fade in" id="importsavetender">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data" action="/importsavetender">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
        <h4 class="modal-title text-center">Upload Tender Excel</h4>
      </div>
      <div class="modal-body">
        
        
          {{ csrf_field() }}
          <div class="form-group">
        <label>Select File for Upload Tender</label>
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

<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

function importsavetender(){
        alert("Do You Want To Upload Tender Excel");
      }

 $('#search-form').on('submit', function(e) {
        e.preventDefault();
       
       table.draw(true);
       
    });


    

    var table = $('.yajratable').DataTable({
        order: [[ 5, "asc" ]],
        processing: true, 
        serverSide: true,
        "scrollY": 450,
        "scrollX": true,
        "iDisplayLength": 25,
          ajax: {
            url: '{{ url("gettenderlist")  }}',
            data: function (d) {
                d.status = $('#status').val();
               
            }
        },
        columns: [

            {data: 'idbtn', name: 'id'},
            {data: 'now',name: 'nameofthework'},
            {data: 'clientname', name: 'clientname'},
            {data: 'location', name: 'location'},
            {data: 'tenderrefno', name: 'tenderrefno'},
            {data: 'workvalue', name: 'workvalue'},
            {data: 'paperamount', name: 'paperamount'},
            {data: 'gstamount', name: 'gstamount'},
            {data: 'ldos', name: 'lastdateofsubmisssion'},    
            {data: 'emdamount', name:'emdamount'},    
            {data: 'sta', name: 'sta'},
            {data: 'name', name: 'users.name'},
            {data: 'view', name: 'view'},
            {data: 'edit', name: 'edit'},
            {name: 'created_at',data: 'created_at'},
            

          

        ]

    });

function revokestatus(id)
  {
       $("#tid").val(id);
       $('#revokeModal').modal('show');
  }


function changestatus(value,id)
    { 
var r = confirm("Do You Want to chnage status to "+ value +"?");
if (r == true) {

   $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxchangetenderstatus")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     status:value,
                     id:id,
                     
                     },

               success:function(data) { 
                    table.ajax.reload();
               }
               
             });
       
    }
else {
  
} 
}
      
           
function revokestatus(id)
  {
       $("#tid").val(id);
       $('#revokeModal').modal('show');
  }
  
 
  </script>
@endsection