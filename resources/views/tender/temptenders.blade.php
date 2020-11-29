@extends('layouts.tender')
@section('content')
@inject('provider', 'App\Http\Controllers\TenderController')
@inject('tend', 'App\Http\Controllers\AccountController')
<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}

</style>
<table class="table">
	<tr class="bg-navy">
		<td class="text-center">TEMP TENDERS</td>
		
	</tr>
</table>
 <button class="btn btn-success" type="button" onclick="openimport();">Import</button>
 <a href="/sample-tender.xlsx" download>
 	<button class="btn"><i class="fa fa-download"></i>Sample Download</button>
 </a>

<div class="table-responsive">
<table class="table table-responsive table-hover table-bordered table-striped datatablescroll">
	<thead>
		<tr class="bg-blue">
			<td>ID</td>
			<td>T247ID</td>
			<td>NAME OF WORK</td>
			<td>CLIENT</td>
			<td>LOCATION</td>
			<td>TENDER REF NO</td>
			<td>WORK VALUE</td>
			<td>ACTION</td>
			<td>LAST DATE OF SUB.</td>
			<td>EMD AMT</td>
			<td width="10%">TENDER WEBSITE</td>
			<td width="10%">TENDER REF LINK</td>
			<td>STATUS</td>
			
			
		</tr>
	</thead>
	<tbody>
		@foreach($temptenders as $tender)
		   
           
		   <tr>
		   	<td>{{$tender->id}}</td>
		   	<td>{{$tender->tendersiteid}}</td>
		   	<td><p class="b" title="{{$tender->nameofthework}}">{{$tender->nameofthework}}</p></td>
		   	<td>{{$tender->clientname}}</td>
		  	 <td>{{$tender->location}}</td>
		   	<td>{{$tender->tenderrefno}}</td>
		   	<td>{{$tender->workvalue}}</td>
		   
		   	  <td id="tid{{$tender->id}}">
		    	 <select onchange="changestatus(this.value,'{{$tender->id}}')" class="form-control">
		    	 <option value="">Select a Action</option>
		    	 <option value="ELLIGIBLE,INTERESTED">ELLIGIBLE,INTERESTED</option>
		    	 <option value="ELLIGIBLE,NOT INTERESTED">ELLIGIBLE,NOT INTERESTED</option>
		    	 <option value="NOT ELLIGIBLE,INTERESTED">NOT ELLIGIBLE,INTERESTED</option>
		    	 <option value="NOT ELLIGIBLE,NOT INTERESTED">NOT ELLIGIBLE,NOT INTERESTED</option>
		    	</select>
		    </td>
		   	<td data-sort="{{strtotime($tender->lastdateofsubmisssion)}}"><span class="label label-danger btn btn-lg" style="font-size: 12px;">{{$provider::changedateformat($tender->lastdateofsubmisssion)}}</span>
		   	</td>
		   	<td>{{$tend::moneyFormatIndia($tender->emdamount)}}</td>
		   	<td width="10%"><a href="{{$tender->tender_website}}" target="_blank">{{$tender->tender_website}}</a></td>
		   	<td width="10%"><a href="{{$tender->tender_site_ref}}" target="_blank">{{$tender->tender_site_ref}}</a></td>
		   
		    <td>
		   		<span class="label label-success">{{$tender->status}}</span>
		   	</td>
		  
		   	
		   </tr>

		@endforeach
	</tbody>
</table>
</div>

<div class="modal fade in" id="importmodal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <form method="post" enctype="multipart/form-data" action="/importtender">
      <div class="modal-header bg-navy">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: #fff;">×</span>
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


<script type="text/javascript">

	 function openimport()
    {
        $("#importmodal").modal('show');
    }

	function changestatus(value,id)
    { 
    	


   $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxchangetemptenderstatus")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     status:value,
                     id:id,
                     
                     },

               success:function(data) { 

               	  id='#tid'+data;
               	  
               	  //$(id).html('');
                    
               }
               
             });
       
    }

</script>
@endsection