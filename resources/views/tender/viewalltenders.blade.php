@extends('layouts.tender')
@section('content')
@inject('provider', 'App\Http\Controllers\TenderController')
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
.greenRow{
    background-color: #8eff8e !important;
}
.yellowRow{
    background-color: #ffcb00!important;
}
.lightRow{
    background-color: #d2d2d2!important;
}

</style>

<table class="table">
    <tr class="bg-navy">
        <td class="text-center">VIEW ALL TENDERS</td>
        
    </tr>
</table>
<table class="table">
    <tr>
      <form method="POST" id="search-form1" class="form-inline" role="form">
        <td>
         
          <button type="submit" value="" name="all" id="all" class="btn btn-primary">ALL</button>
        </td>
      </form>
      <form method="POST" id="search-form2" class="form-inline" role="form">
        <td><button type="submit" value="" name="live" id="live" class="btn btn-success">LIVE</button></td>
      </form>
      <form method="POST" id="search-form3" class="form-inline" role="form">
        <td><button type="submit" value="" name="expired" id="expired" class="btn btn-danger">EXPIRED</button></td>
      </form>
      <form method="POST" id="search-form4" class="form-inline" role="form">
        <td><button type="submit" value="" name="applied" id="applied" class="btn btn-warning">APPLIED</button></td>
      </form>
      <form method="POST" id="search-form7" class="form-inline" role="form">
        <td><button type="submit" value="" name="ei" id="ei" class="btn btn-success">ELLIGIBLE,INTERESTED</button></td>
      </form>
      <form method="POST" id="search-form8" class="form-inline" role="form">
        <td><button type="submit" value="" name="ni" id="ni" class="btn btn-info">NOT ELLIGIBLE,INTERESTED</button></td>
      </form>
    </tr>
</table>
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
            <td>TENDER REF NO</td>
            <td>NAME OF WORK</td>
            <td>CLIENT</td>
            <td>LOCATION</td>
            <td title="Tender Inviting Authority">TIA</td>
            <td>WORK VALUE</td>
            <td>LAST DATE OF SUB.</td>
            <td>LIVE/EXP</td>
            <td>EMD AMT</td>
            <td>STATUS</td>
            <td>NIT AND RFP</td>
            <td>CORRIGENDUM</td>
            <td>APPLIED AS</td>
            <td>AUTHOR</td>
            <td>VIEW</td>
            <td>EDIT</td>
            <td>CREATED AT</td>
            <td>UPDATED AT</td>
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

     $('#search-form1').on('submit', function(e) {

        e.preventDefault();
         $("#live").val('');
         $("#expired").val('');
        $("#all").val("ALL");
        $("#applied").val('');
        $("#technical").val('');
       $("#financial").val('FE');
       $("#ei").val('');
       $("#ni").val('');
       
       table.draw(true);
       
    }); $('#search-form2').on('submit', function(e) {
        e.preventDefault();
         $("#expired").val('');
        $("#all").val('');
        $("#applied").val('');
       $("#live").val("LIVE");
       $("#technical").val('');
       $("#financial").val('');
       $("#ei").val('');
       $("#ni").val('');

       table.draw(true);
       
    }); $('#search-form3').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#applied").val('');
       $("#expired").val("EXPIRED");
       $("#technical").val('');
       $("#financial").val('');
       $("#ei").val('');
       $("#ni").val('');
     
       table.draw(true);
       
    });
    $('#search-form4').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#expired").val('');
       $("#applied").val('APPLIED');
       $("#technical").val('');
       $("#financial").val('');
       $("#ei").val('');
       $("#ni").val('');
     
       table.draw(true);
       
    });  
    $('#search-form5').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#expired").val('');
       $("#applied").val('');
       $("#technical").val('TE');
       $("#financial").val('');
       $("#ei").val('');
       $("#ni").val('');

     
       table.draw(true);
       
    });
      $('#search-form6').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#expired").val('');
       $("#applied").val('');
       $("#technical").val('');
       $("#financial").val('FE');
       $("#ei").val('');
       $("#ni").val('');
     
       table.draw(true);
       
    });
         $('#search-form7').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#expired").val('');
       $("#applied").val('');
       $("#technical").val('');
       $("#financial").val('');
       $("#ei").val('EI');
       $("#ni").val('');
     
       table.draw(true);
       
    });

  $('#search-form8').on('submit', function(e) {
        e.preventDefault();
        $("#all").val('');
       $("#live").val('');
       $("#expired").val('');
       $("#applied").val('');
       $("#technical").val('');
       $("#financial").val('');
       $("#ei").val('');
       $("#ni").val('NI');
     
       table.draw(true);
       
    });

    

    var table = $('.yajratable').DataTable({
        order: [[ 0, "desc" ]],
        processing: true, 
        serverSide: true,
        "scrollY": 450,
        "scrollX": true,
        "iDisplayLength": 25,
         ajax: {
            url: '{{ url("getviewalltenderlist")  }}',
            data: function (d) {
                d.all = $('#all').val();
                d.live = $('#live').val();
                d.expired = $('#expired').val();
                d.applied = $('#applied').val();
                d.technical = $('#technical').val();
                d.financial = $('#financial').val();
                d.ei = $('#ei').val();
                d.ni = $('#ni').val();
               
            }
        },
        columns: [

            {data: 'idbtn', name: 'id'},
             {data: 'tenderrefnolink', name: 'tenderrefno'},
            {data: 'now',name: 'nameofthework'},
            {data: 'clientname', name: 'clientname'},
            {data: 'location', name: 'location'},
            {data: 'tia', name: 'tia', searchable: false, sortable : false},
            {data: 'workvalue', name: 'workvalue'},
            {data: 'ldos', name: 'lastdateofsubmisssion'},
            {data: 'live', name: 'lastdateofsubmisssion'},
            {data: 'emdamount', name:'emdamount'},
            {data: 'sta', name: 'sta'},
            {data: 'nitandrfp', name: 'nitandrfp',searchable: false, sortable : false},
            {data: 'corrigendum', name: 'corrigendum',searchable: false, sortable : false},
            {data: 'recomended', name: 'recomended'},
            
            {data: 'name', name: 'users.name'},
            {data: 'view', name: 'view'},
            {data: 'edit', name: 'edit'},
            {name: 'created_at',data: 'created_at'},
            {name: 'updated_at',data: 'updated_at'},
            

          

        ],
        "createdRow": function (row, data, index) {
             if (data.status == "ELLIGIBLE,INTERESTED") {
                 $(row).addClass('greenRow');
             }
             if (data.status == "ELLIGIBLE,NOT INTERESTED") {
                 $(row).addClass('yellowRow');
             }
              if (data.status == "NOT ELLIGIBLE,INTERESTED") {
                 $(row).addClass('lightRow');
             }
         }

    });

    




  function revokestatus(id)
  {
       $("#tid").val(id);
       $('#revokeModal').modal('show');
  }
  </script>
@endsection