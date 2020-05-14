@extends('layouts.app')
@section('content')
<style type="text/css">
  .box{border-radius: 0px!important;}
}
</style>    
@if(Session::has('msg'))
   <p class="alert alert-success text-center">{{ Session::get('msg') }}</p>
@endif
<div class="row">
	<div class="col-md-12">
	  @if(Session::has('error'))
	  <div class="alert alert-danger text-center"><span class="glyphicon glyphicon-ok"></span> {!! session('error') !!}</div>
	  @endif
	   @if(Session::has('message'))
	  <div class="alert alert-success text-center"><span class="glyphicon glyphicon-ok"></span> {!! session('message') !!}</div>
	  @endif
	</div>
</div>

<div class="box box-info box-solid">
     <div class="box-header bg-navy with-border text-center" style="margin-bottom: 10px;">
              <h3 class="box-title">UPDATE PROJECT</h3>
      </div>
    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="/updateproject/{{$project->id}}">
 		{{ csrf_field() }}
 	<div class="form-horizontal">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info  box-solid">
	            	<div class="box-header with-border">
	              		<h3 class="box-title">PROJECT DETAILS</h3>
	            	</div>
	        	</div>
	        	<div class="box-body">
	        	<div class="row">
		        		<div class="col-md-6">
			        	 <div class="form-group">
			                <label class="col-sm-5">
			                  	Work Order Number<span style="color: red"> *</span>
			                </label>
			                <div class="col-sm-7">
			                    <input class="form-control" name="workorderno" value="{{$project->workorderno}}" required="" placeholder="Enter Work Order Number">
			                </div>
		                 </div>
	                 	</div>
	             		<div class="col-md-6">
		                 <div class="form-group">
			                <label class="col-sm-5">
			                  	Estimate Number<span style="color: red"> *</span>
			                </label>
			                <div class="col-sm-7">
			                    <input class="form-control" name="estimateno" value="{{$project->estimateno}}" required placeholder="Enter Estimate Number">
			                </div>
		                 </div>
		             	</div>
					</div>
	        	<div class="row">
	        		<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	FOR CLIENT<span style="color: red"> *</span>
		                </label>
		                <div class="col-sm-7">
		                    <select type="text" name="clientid" id="clientid" onchange="changeclientname();fetchdistrict();" class="form-control select2" > 
							<option value="">SELECT A CLIENT</option>
							 @foreach($clients as $key => $client)
							 <option value="{{$client->id}}" title="{{$client->clientname}}" {{ ( $client->id == $project->clientid) ? 'selected' : '' }}>{{$client->clientname}}</option>
							 @endforeach
						</select>
		                </div>
	                 </div>
                 	</div>
             		<!-- <div class="col-md-6">
	                 <div class="form-group">
		                <label class="col-sm-5">
		                  	CLIENT NAME
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control" name="clientname" id="clientname" disabled="">
		                </div>
	                 </div>
	             	</div> -->
	             <div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	PROJECT COST<span style="color: red"> *</span>
	                </label>
	                <div class="col-sm-7">
	                    <input type="text" name="cost" value="{{$project->cost}}" id="cost"  class="form-control">
	                </div>
                 </div>
             </div>
				</div>
             	<div class="row">
             	<div class="col-md-6">
	        	 <div class="form-group">
	                <label class=" col-sm-5">
	                  	DISTRICT<span style="color: red"> *</span>
	                </label>
	                <div class="col-sm-7">
	                    <select type="text" name="district_id" id="district"  class="form-control select2"  onchange="fetchdivision();" data-placeholder="Select a District"> 
						<option value="">SELECT A DISTRICT</option>
							 @foreach($districts as $key => $district)
							 <option value="{{$district->id}}" title="{{$district->districtname}}" {{ ( $district->id == $project->district_id) ? 'selected' : '' }}>{{$district->districtname}}</option>
							 @endforeach
					    </select>
	                </div>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	DIVISION
	                </label>
	                <div class="col-sm-7">
	                    <select type="text" name="division_id" id="division"   class="form-control select2"  data-placeholder="Select a Division">
	                    <option value="">SELECT A DIVISION</option>
							 @foreach($divisions as $key => $division)
							 <option value="{{$division->id}}" title="{{$division->divisionname}}" {{ ( $division->id == $project->division_id) ? 'selected' : '' }}>{{$division->divisionname}}</option>
							 @endforeach
					    </select>
	                </div>
                 </div>
             </div>
             	</div>
<div class="row">
	<div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	SCHEME
	                </label>
	                <div class="col-sm-7">
	                    <select type="text" name="scheme_id" id="schemename" onchange="changeschemename();"  class="form-control select2"  data-placeholder="Select a Schele">
	                    <option value="">SELECT A SCHEME</option>
							 @foreach($schemes as $key => $scheme)
							 <option value="{{$scheme->id}}" title="{{$scheme->schemename}}" {{ ( $scheme->id == $project->scheme_id) ? 'selected' : '' }}>{{$scheme->schemename}}</option>
							 @endforeach
					    </select>
	                </div>
                 </div>
             </div>
             <!-- <div class="col-md-6">
	                 <div class="form-group">
		                <label class="col-sm-5">
		                  	SCHEME NAME
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control"  id="fschemename" disabled="">
		                </div>
	                 </div>
	             	</div> -->
</div>
             	<div class="row">
             		<div class="col-md-6">
	        	 <div class="form-group">
	                <label class=" col-sm-5">
	                  	PROJECT NAME<span style="color: red"> *</span>
	                </label>
	                <div class="col-sm-7">
	                    <input type="text" value="{{$project->projectname}}" name="projectname" id="projectname" class="form-control">
	                </div>
                 </div>
             </div>
            <div class="col-md-6">
	        	 <div class="form-group">
	                <label class=" col-sm-5">
	                  	PAPER COST<span style="color: red"> * </span>

	                </label>
	                <div class="col-sm-7">
	                  <input type="text" value="{{$project->papercost}}" class="form-control" name="papercost" placeholder="Paper Cost" >
	                  <b style="color: red">Non Refundable</b>
	                </div>
                 </div>
             	</div>
             	</div>

             	<div class="row">
             	<div class="col-md-6">
	        	 <div class="form-group">
	                <label class=" col-sm-5">
	                  	EMAIL
	                </label>
	                <div class="col-sm-7">
	                   <input type="email" value="{{$project->email}}" name="email" class="form-control">
	                </div>
                 </div>
             	</div>
             	<div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	ATTACH ORDER FORM
	                </label>
	                <div class="col-sm-4">
	                    <input type="file"  name="orderform" onchange="readURL(this);" >
	                    <span style="color: red">(please upload .jpg or .pdf file)</span>
	                </div>
	                <div class="col-sm-3">
					 <img id="imgshow1" src="/img/orderform/{{$project->orderform}}" style="height: 70px;width: 70px;">
					 
					</div>
	                </div>
                 </div>
             	</div>

             	<div class="row">
             	<div class="col-md-6">
	        	 <div class="form-group">
	                <label class=" col-sm-5">
	                  	<strong>LOA NO</strong>
	                </label>
	                <div class="col-sm-7">
	                   <input type="text" value="{{$project->loano}}" class="form-control" name="loano" placeholder="Enter LOA NO" >
	                </div>
                 </div>
             	</div>
             	<div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	<strong>AGREEMENT NO</strong>
	                </label>
	                <div class="col-sm-7">
	                    <input type="text" value="{{$project->agreementno}}" class="form-control" name="agreementno" placeholder="Enter AGREEMENT NO">
	                </div>
	                </div>
                 </div>
             	</div>

             	<div class="row">
             	<div class="col-md-6">
	        	 <div class="form-group">
	                <label class=" col-sm-5">
	                  	DATE OF COMMENCEMENT
	                </label>
	                <div class="col-sm-7">
	                   <input type="text" value="{{$project->startdate}}" name="startdate" id="sdate" class="form-control datepicker getdays" readonly="">
	                </div>
                 </div>
             	</div>
             	<div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	DATE OF COMPLETION 
	                </label>
	                <div class="col-sm-7">
	                    <input type="text" value="{{$project->enddate}}" name="enddate"  id="edate" class="form-control datepicker getdays" readonly="">
	                </div>
	                </div>
                 </div>
             	</div>

             	<div class="row">
             	
             <!-- 	<div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	TOTAL PROJECT TIME(IN DAYS)
	                </label>
	                <div class="col-sm-7">
	                    <input type="text" value="{{$project->totprojectdays}}" name="totprojectdays" id="totprojectdays" autocomplete="off" class="form-control caldate">
	                </div>
	                </div>
                 </div> -->
             	</div>

             	<div class="row">
             	<div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	PAPER COST ATTACH
	                </label>
	                <div class="col-sm-4">
	                    <input type="file"  name="papercostattach" onchange="paper(this);" >
	                    <span style="color: red">(please upload .jpg or .pdf file)</span>
	                </div>
	                <div class="col-sm-3">
					 <img id="paperimgshow1" src="/img/papercost/{{$project->papercostattachment}}" style="height: 70px;width: 70px;">

					 
					</div>

	                </div>
                 </div>
                 <div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	MOM ATTACH
	                </label>
	                <div class="col-sm-4">
	                    <input type="file"  name="momattach" onchange="mom(this);" >
	                    <span style="color: red">(please upload .jpg or .pdf file)</span>
	                </div>
	                <div class="col-sm-3">
					 <img id="momimgshow1" src="/img/momattach/{{$project->momattach}}" style="height: 70px;width: 70px;">

					 
					</div>

	                </div>
                 </div>
             	</div>
             	<div class="row">
             	<div class="col-md-6">
	        	 <div class="form-group">
	                <label class=" col-sm-5">
	                  	PRIORITY
	                </label>
	                <div class="col-sm-7">
				      <select name="priority" class="form-control">
						<option value="">SELECT</option>
						<option value="NORMAL" {{ ( $project->priority == "NORMAL") ? 'selected' : '' }}>NORMAL</option>

						<option value="HIGH" {{ ( $project->priority == "HIGH") ? 'selected' : '' }}>HIGH</option>

						<option value="MEDIUM" {{ ( $project->priority == "MEDIUM") ? 'selected' : '' }}>MEDIUM</option>

						<option value="LOW" {{ ( $project->priority == "LOW") ? 'selected' : '' }}>LOW</option>
						
					</select>
	                </div>
                 </div>
             	</div>
             	</div>
             	</div>
	        	</div>
	     

			</div>

		<div class="row">
			<div class="col-md-12">
				<div class="box box-info  box-solid">
	            	<div class="box-header with-border">
	              		<h3 class="box-title">PO DETAILS</h3>
	            	</div>
	        	</div>
	        	<div class="box-body">
	        	<div class="row">
	        		<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	PO DATE
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control datepicker" value="{{$project->poddate}}" name="poddate" readonly>
		                </div>
	                 </div>
                 	</div>
                 	<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	PO NUMBER
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control" value="{{$project->ponumber}}" name="ponumber">
		                </div>
	                 </div>
                 	</div>
             		
				</div>
				<div class="row">
					 <div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	ATTACH ORDER FORM
	                </label>
	                <div class="col-sm-4">
	                    <input type="file"  name="podattach" onchange="po(this);" >
	                    <span style="color: red">(please upload .jpg or .pdf file)</span>
	                </div>
	                <div class="col-sm-3">
					 <img id="poimgshow1" src="/img/podattach/{{$project->podattach}}" style="height: 70px;width: 70px;">

					 
					</div>

	                </div>
                 </div>
				</div>
			</div>
		</div>
	</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info  box-solid">
	            	<div class="box-header with-border">
	              		<h3 class="box-title">ISD DETAILS</h3>
	            	</div>
	        	</div>
	        	<div class="box-body">
	        	<div class="row">
	        		<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	ISD DATE
		                </label>
		                <div class="col-sm-7">
		                    <input value="{{$project->isddate}}" class="form-control datepicker" name="isddate" id="isddate" readonly>
		                </div>
	                 </div>
                 	</div>
             		<div class="col-md-6">
	                 <div class="form-group">
		                <label class="col-sm-5">
		                  	VALID UP TO
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control datepicker" name="isdvalidupto" value="{{$project->isdvalidupto}}" id="isdvalidupto" readonly>
		                </div>
	                 </div>
	             	</div>
				</div>
				<div class="row">
	        		<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	AMOUNT
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control" value="{{$project->isdamount}}" name="isdamount">
		                </div>
	                 </div>
                 	</div>
             		<div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	ATTACH ORDER FORM
	                </label>
	                <div class="col-sm-4">
	                    <input type="file"  name="isdattach" onchange="isddoc(this);">
	                    <span style="color: red">(please upload .jpg or .pdf file)</span>
	                </div>
	                <div class="col-sm-3">
					 <img id="isdimgshow1" src="/img/isdattach/{{$project->isdattachment}}" style="height: 70px;width: 70px;">
					 
					</div>
	                </div>
                 </div>
				</div>
			</div>
		</div>
	</div>

		<div class="row">
			<div class="col-md-12">
				<div class="box box-info  box-solid">
	            	<div class="box-header with-border">
	              		<h3 class="box-title">EMD DETAILS</h3>
	            	</div>
	        	</div>
	        	<div class="box-body">
	        	<div class="row">
	        		<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	EMD DATE
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control datepicker" name="emddate" id="emddate" value="{{$project->emddate}}" readonly>
		                </div>
	                 </div>
                 	</div>
             		<div class="col-md-6">
	                 <div class="form-group">
		                <label class="col-sm-5">
		                  	VALID UP TO
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control datepicker" name="emdvalidupto" value="{{$project->emddate}}" id="emdvalidupto" readonly>
		                </div>
	                 </div>
	             	</div>
				</div>
				<div class="row">
	        		<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	AMOUNT
		                </label>
		                <div class="col-sm-7">
		                    <input value="{{$project->emdamount}}" class="form-control" name="emdamount">
		                </div>
	                 </div>
                 	</div>
             		<div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	ATTACH ORDER FORM
	                </label>
	                <div class="col-sm-4">
	                    <input type="file"  name="emdattach" onchange="emddoc(this);">
	                    <span style="color: red">(please upload .jpg or .pdf file)</span>
	                </div>
	                <div class="col-sm-3">
					 <img id="emdimgshow1" src="/img/emdattach/{{$project->emdattachment}}" style="height: 70px;width: 70px;">

					 
					</div>
	                </div>
                 </div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
			<div class="col-md-12">
				<div class="box box-info  box-solid">
	            	<div class="box-header with-border">
	              		<h3 class="box-title">APS DETAILS</h3>
	            	</div>
	        	</div>
	        	<div class="box-body">
	        	<div class="row">
	        		<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	APS DATE
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control datepicker" name="apsdate" id="apsdate" value="{{$project->apsdate}}" readonly>
		                </div>
	                 </div>
                 	</div>
             		<div class="col-md-6">
	                 <div class="form-group">
		                <label class="col-sm-5">
		                  	VALID UP TO
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control datepicker" name="apsvalidupto" value="{{$project->apsvalidupto}}" id="apsvalidupto" readonly>
		                </div>
	                 </div>
	             	</div>
				</div>
				<div class="row">
	        		<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	AMOUNT
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control" value="{{$project->apsamount}}" name="apsamount" id="apsdate">
		                </div>
	                 </div>
                 	</div>
             		<div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	ATTACH ORDER FORM
	                </label>
	                <div class="col-sm-4">
	                    <input type="file"  name="apsattach" onchange="apsdoc(this);">
	                    <span style="color: red">(please upload .jpg or .pdf file)</span>
	                </div>
	                <div class="col-sm-3">
					 <img id="apsimgshow1" src="/img/apsattach/{{$project->apsattachment}}" style="height: 70px;width: 70px;">
					 
					</div>
	                </div>
                 </div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
			<div class="col-md-12">
				<div class="box box-info  box-solid">
	            	<div class="box-header with-border">
	              		<h3 class="box-title">BANK GUARANTEE DETAILS</h3>
	            	</div>
	        	</div>
	        	<div class="box-body">
	        	<div class="row">
	        		<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	BG DATE
		                </label>
		                <div class="col-sm-7">
		                    <input value="{{$project->bgdate}}" class="form-control datepicker" name="bgdate" id="bgdate" readonly>
		                </div>
	                 </div>
                 	</div>
             		<div class="col-md-6">
	                 <div class="form-group">
		                <label class="col-sm-5">
		                  	VALID UP TO
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control datepicker" name="bgvalidupto" value="{{$project->bgvalidupto}}" id="bgvalidupto" readonly>
		                </div>
	                 </div>
	             	</div>
				</div>
				<div class="row">
	        		<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	AMOUNT
		                </label>
		                <div class="col-sm-7">
		                    <input class="form-control" value="{{$project->bgamount}}" name="bgamount" id="bgdate">
		                </div>
	                 </div>
                 	</div>
             		<div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	ATTACH ORDER FORM
	                </label>
	                <div class="col-sm-4">
	                    <input type="file"  name="bgattach" onchange="bgdoc(this);">
	                    <span style="color: red">(please upload .jpg or .pdf file)</span>
	                </div>
	                <div class="col-sm-3">
					 <img id="bgimgshow1" src="/img/bgattach/{{$project->bgattachment}}" style="height: 70px;width: 70px;">
					 
					</div>
	                </div>
                 </div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
				<div class="box box-info  box-solid">
	            	<div class="box-header with-border">
	              		<h3 class="box-title">DEMAND DRAFT</h3>
	            	</div>
	        	</div>
	        	<div class="box-body">
	        	<div class="row">
	        		<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	DD DATE
		                </label>
		                <div class="col-sm-7">
		                    <input value="{{$project->dddate}}" class="form-control datepicker" name="dddate" id="dddate" readonly>
		                </div>
	                 </div>
                 	</div>
             		<div class="col-md-6">
	                 <div class="form-group">
		                <label class="col-sm-5">
		                  	VALID UP TO
		                </label>
		                <div class="col-sm-7">
		                    <input value="{{$project->ddvalidupto}}" class="form-control datepicker" name="ddvalidupto" id="ddvalidupto" readonly>
		                </div>
	                 </div>
	             	</div>
				</div>
				<div class="row">
	        		<div class="col-md-6">
		        	 <div class="form-group">
		                <label class="col-sm-5">
		                  	AMOUNT
		                </label>
		                <div class="col-sm-7">
		                    <input value="{{$project->ddamount}}" class="form-control" name="ddamount" id="dddate">
		                </div>
	                 </div>
                 	</div>
             		<div class="col-md-6">
                 <div class="form-group">
	                <label class=" col-sm-5">
	                  	ATTACH ORDER FORM
	                </label>
	                <div class="col-sm-4">
	                    <input type="file"  name="ddattach" onchange="dddoc(this);">
	                    <span style="color: red">(please upload .jpg or .pdf file)</span>
	                </div>
	                <div class="col-sm-3">
					 <img id="ddimgshow1" src="/img/ddattach/{{$project->ddattachment}}" style="height: 70px;width: 70px;">
					 
					</div>
	                </div>
                 </div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<button type="submit"class="btn btn-flat pull-right btn-success">Update Project</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
	<div class="row">
		<div class="col-md-12">
				<div class="box box-info  box-solid">
	            	<div class="box-header with-border">
	              		<h3 class="box-title">Project Other Documents</h3>
	            	</div>
	        	</div>
	        	<div class="box-body">
	        		<div class="form-horizontal">
              <div class="box-body">
                <table class="table table-bordered">
                  <thead>
                    <tr class="bg-navy">
                      <th>Sl.No</th>
                      <th>Document Name</th>
                      <th>Document</th>
                      @if(Auth::user()->usertype=='MASTER ADMIN')
                      <th>Delete</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($projectotherdocuments as $key=>$projectotherdocument)
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$projectotherdocument->documentname}}</td>
                    <td><a href="{{asset('/image/projectotherdocument/'.$projectotherdocument->document)}}" target="_blank">
              <img style="height: 70px;width: 70px;" src="{{asset('/image/projectotherdocument/'.$projectotherdocument->document)}}" alt="click to view" id="imgshow">
            </a>
              <a href="{{asset('/image/projectotherdocument/'.$projectotherdocument->document)}}" class="btn btn-primary btn-sm" download>
               <span class="glyphicon glyphicon-download-alt"></span> Download
               </a></td>

                      @if(Auth::user()->usertype=='MASTER ADMIN')
                      <td><form action="/deleteprojectotherdoc/{{$projectotherdocument->id}}"  method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger" onclick="return confirm('Do You want to Delete this Document?')">DELETE</button>
            
          </form></td>
          @endif
                    </tr>
                   @endforeach
                    
                  </tbody>
                </table>
                
              </div>
            </div>
		        	<div class="row">
		        		<form action="/saveprojectotherdoc/{{$project->id}}" method="post" enctype="multipart/form-data" class="form-horizontal">
				          {{csrf_field()}}
				            <div class="form-horizontal">
				              <div class="box-body">
				                <div class="form-group col-sm-12">
				                  <label  class="col-sm-2">Document Name</label>
				                  <div class="col-sm-3">
				                    <input type="text" class="form-control" name="documentname" placeholder="Enter Document Name" required="">
				                  </div>
				                  <div class="col-sm-3">
				                    <input name="document"  type="file" onchange="otherdoc(this)" required="">
				                  </div>
				                  <div class="col-sm-2">
				                  <img id="otherdocshow" src="#" style="height: 70px;width: 70px;">
				                  </div>
				                  <div class="col-sm-2">
				                  <button type="submit"class="btn btn-info btn-flat"> Save Document</button>
				                  </div>
				                </div>
				              </div>
				            </div>
				        </form>
		        	</div>
				</div>
		</div>
	</div>

	</div>
	
</div>



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CHANGE START DATE</h4>
      </div>
      <div class="modal-body">
        <table class="table table-responsive table-hover table-bordered table-striped">
        	<tr>
        		<input type="hidden" id="stchngid">
        		<td>ENTER START DATE</td>
        		<td><input type="text" class="form-control datepicker" id="modifiedstdate"></td>
        	</tr>
        	<tr>
        		<td><button type="button" onclick="confirmchangestdate();" class="btn btn-success">CHANGE</button></td>
        		
        	</tr>


        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CHANGE END DATE</h4>
      </div>
      <div class="modal-body">
        <table class="table table-responsive table-hover table-bordered table-striped">
        	<tr>
        		<input type="hidden" id="enchngid">
        		<td>ENTER END DATE</td>
        		<td><input type="text" class="form-control datepicker" id="modifiedendate"></td>
        	</tr>
        	<tr>
        		<td><button type="button" onclick="confirmchangeendate();" class="btn btn-success">CHANGE</button></td>
        		
        	</tr>


        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


  

<script type="text/javascript">
	function changeschemename()
	{
		
	var cn=$( "#schemename option:selected" ).attr("title");
	//alert(cn);
	$("#fschemename").val(cn);

	}
	$(".alert-success").delay(8000).fadeOut(800); 
    $(".alert-danger").delay(8000).fadeOut(800);
 function otherdoc(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#otherdocshow')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
	$("#cost").on("keypress",function(e){
  console.log("Entered Key is " + e.key);
  switch (e.key)
     {
         case "1":
         case "2":
         case "3":
         case "4":
         case "5":
         case "6":
         case "7":
         case "8":
         case "9":
         case "0":
         case "Backspace":
             return true;
             break;

         case ".":
             if ($(this).val().indexOf(".") == -1) //Checking if it already contains decimal. You can Remove this condition if you do not want to include decimals in your input box.
             {
                 return true;
             }
             else
             {
                 return false;
             }
             break;

         default:
             return false;
     }
});
	
	function changeclientname()
	{
	var cn=$( "#clientid option:selected" ).attr("title");
	$("#clientname").val(cn);

	}

$( ".chng" ).change(function() {

var start = $("#startdate").val();
var end = $("#enddate").val();

if(start!='' && end!='')
{
	var startDate = Date.parse(start);
var endDate = Date.parse(end);


var diff = new Date(endDate - startDate);

var days = diff/1000/60/60/24;
$("#duration").val(days);
}


	});

	$( ".getdays" ).change(function() {

var start = $("#sdate").val();
var end = $("#edate").val();

if(start!='' && end!='')
{
	var startDate = Date.parse(start);
var endDate = Date.parse(end);


var diff = new Date(endDate - startDate);

var days = diff/1000/60/60/24;
$("#totprojectdays").val(days);
}


	});




$(".chngdate").bind("keyup change", function(e) {
    // do stuff!
          
           var myDate = $("#startdate").val();
          var days=parseInt($("#duration").val());

          if(myDate!='' && days!='' && days>=0)
          {
          	 date = new Date(myDate);
            next_date = new Date(date.setDate(date.getDate() + days));
            formatted = next_date.getUTCFullYear() + '-' + padNumber(next_date.getUTCMonth() + 1) + '-' + padNumber(next_date.getUTCDate())
            $("#enddate").val(formatted);
          }
          else
          {
          	 $("#enddate").val('');


          }
           
            
       
});
$(".caldate").bind("keyup change", function(e) {
    // do stuff!
          
           var myDate = $("#sdate").val();
          var days=parseInt($("#totprojectdays").val());

          if(myDate!='' && days!='' && days>=0)
          {
          	 date = new Date(myDate);
            next_date = new Date(date.setDate(date.getDate() + days));
            formatted = next_date.getUTCFullYear() + '-' + padNumber(next_date.getUTCMonth() + 1) + '-' + padNumber(next_date.getUTCDate())
            $("#edate").val(formatted);
          }
          else
          {
          	 $("#edate").val('');


          }
           
            
       
});
          

	        
              
           
 function padNumber(number) {
                var string  = '' + number;
                string      = string.length < 2 ? '0' + string : string;
                return string;
            }       


var counter = 0;
var gdtotal = 0;


var count=0;
jQuery('#addnew').click(function(event){
   
	var activityid = jQuery('#activityid').val();
	var activityname=$( "#activityid option:selected" ).text();
	var startdate=$("#startdate").val();
	var enddate=$("#enddate").val();
	var duration=$("#duration").val();
	if(activityid!='' && startdate!='' && enddate!='' && duration!='')
	{
		  
		  event.preventDefault();
    counter++;
    var newRow = jQuery('<tr>'+
    	  
    	'<td>'+activityname+'<input type="hidden" name="activityid[]" value="'+activityid+'"></td>'+
    	  '<td id="st'+(count+1)+'" ondblclick="startdatechange('+(count+1)+')">'+startdate+'<input type="hidden" name="activitystartdate[]" id="s'+(count+1)+'" value="'+startdate+'" class="calcin"/></td>'+
    	  '<td id="en'+(count+1)+'" ondblclick="enddatechange('+(count+1)+')">'+enddate+'<input type="hidden" name="activityenddate[]" id="e'+(count+1)+'" value="'+enddate+'"/></td>'+
    	  '<td id="du'+(count+1)+'">'+duration+'<input type="hidden" name="duration[]" class="countable" value="'+duration+'" class="calcin"/></td>'+
    	  '<td><button type="button" class="btn btn-danger remove_field" onclick="negatefunction('+duration+')" id="'+counter+'">X</button></td></tr>');
    jQuery('.addnewrow').append(newRow);
    count++;
    sumofduration();
   
   
	}
	else
	{
		alert("please add all the Above Detail Correctly")
	}
	
	
}); 
	
 function startdatechange(id)
 {
 	 
    $("#stchngid").val(id);
   
    $("#myModal").modal('show');

 }
 function enddatechange(id)
 {
      $("#enchngid").val(id);
   
    $("#myModal1").modal('show');
 }


jQuery(".addnewrow").on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault();
jQuery(this).parent('td').parent('tr').remove(); counter--;
	
sumofduration();

});




function confirmchangestdate()
{  
    var stchngid=$("#stchngid").val();
	var modifiedstdate=$("#modifiedstdate").val();

	
	if(stchngid!='' && modifiedstdate!='')
	{
		  var x=modifiedstdate+'<input type="hidden" name="activitystartdate[]" value="'+modifiedstdate+'" id="s'+stchngid+'"class="calcin"/>';
     $("#st"+stchngid).html(x);
        calculateduration(stchngid);
	}
    
	
	$("#myModal").modal('hide');

	
}

function confirmchangeendate()
{
	var enchngid=$("#enchngid").val();
	var modifiedendate=$("#modifiedendate").val();
   
   if(enchngid!='' && modifiedendate!='')
	{
		  var x=modifiedendate+'<input type="hidden" name="activityenddate[]" value="'+modifiedendate+'" id="e'+enchngid+'"class="calcin"/>';
     $("#en"+enchngid).html(x);
        calculateduration(enchngid);
	}
    
	
	$("#myModal1").modal('hide');


}

function calculateduration(id)
 {
 	  
 	
var start = $("#s"+id).val();
var end = $("#e"+id).val();



if(start!='' && end!='')
{
	var startDate = Date.parse(start);
var endDate = Date.parse(end);


var diff = new Date(endDate - startDate);

var days = diff/1000/60/60/24;
$("#du"+id).html(days+'<input type="hidden" name="duration[]" class="countable" value="'+days+'" class="calcin"/>');
 }
 sumofduration();
}


function sumofduration()
{

     var totals = 0;
    $('.countable').each(function (index, element) {
        totals = totals + parseFloat($(element).val());
    });
   
    $("#totdays").val(totals);

   
}
function readURL(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#imgshow')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };
            reader.onload = function (e) {
                $('#imgshow1')
                    .attr('src', e.target.result)
                    .width(70)
                    .height(70);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
function isddoc(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#isdimgshow')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };
            reader.onload = function (e) {
                $('#isdimgshow1')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
function emddoc(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#emdimgshow')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };
            reader.onload = function (e) {
                $('#emdimgshow1')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function apsdoc(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#apsimgshow')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };
             reader.onload = function (e) {
                $('#apsimgshow1')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function bgdoc(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#bgimgshow')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };
           reader.onload = function (e) {
                $('#bgimgshow1')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    function paper(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#paperimgshow')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };
            reader.onload = function (e) {
                $('#paperimgshow1')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };


            reader.readAsDataURL(input.files[0]);

        }
    }
    function mom(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#momimgshow')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };
            reader.onload = function (e) {
                $('#momimgshow1')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };


            reader.readAsDataURL(input.files[0]);

        }
    }
    function po(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#poimgshow')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };
            reader.onload = function (e) {
                $('#poimgshow1')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };


            reader.readAsDataURL(input.files[0]);

        }
    }
 function dddoc(input) {
        

       if (input.files && input.files[0]) {
            var reader = new FileReader();
              
            reader.onload = function (e) {
                $('#ddimgshow')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };
            reader.onload = function (e) {
                $('#ddimgshow1')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);        
            };
            reader.readAsDataURL(input.files[0]);

        }
    }

function fetchdivision(){
	var districtid=$("#district").val();
		 $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
        $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxfetchdivision")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      districtid: districtid,
                     },

               success:function(data) { 
               		var x='<option value="">Select Division</option>';  
                            $.each(data,function(key,value){
                                  

                               x=x+'<option value="'+value.id+'">'+value.divisionname+'</option>';

                            })
                            $('#division').html(x);
                }
		});
}

function fetchdistrict(){
	$('#division').html('');
	var clientid=$("#clientid").val();
	 $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
        $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxfetchdistrict")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      clientid: clientid,
                     },

               success:function(data) { 
               		var district='<option value="">Select Division</option>';  
                            $.each(data,function(key,value){
                                  

                               district=district+'<option value="'+value.district_id+'">'+value.districtname+'</option>';

                            })
                            $('#district').html(district);
                }
		});
	
}

</script>
@endsection


