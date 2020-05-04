@extends('layouts.account')

@section('content')
   @if(Session::has('msg'))
   <p class="alert alert-info text-center">{{ Session::get('msg') }}</p>
   @endif
  <form action="/savehsncode" method="post">
    {{csrf_field()}}
    <table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">DEFINE HSN CODE/SAC</td>
        </tr>
        <tr>
            <td>HSN CODE:<span style="color: red"> *</span></td>
            <td><input type="text" class="form-control" autocomplete="off" name="hsncode" placeholder="ENTER HSN CODE" required></td>
        </tr>
        <tr>
            <td>DESCRIPTION <span style="color: red"> *</span></td>
            <td><textarea name="description" class="form-control" autocomplete="off" placeholder="ENTER DESCRIPTION"></textarea></td>
            
        </tr>
        
        <tr>
            <td></td>
<td colspan="3"><input type="submit" value="Submit" class="btn btn-success" style="float: right ;"></td>
</tr>
</table>
</form>
@if(count($hsncodes)>0)
<div class="table-responsive">
<table class="table  table-hover table-bordered table-striped" >
    <thead>
        <tr class="bg-navy">
            <th class="text-center">SL.NO</th>
            <th class="text-center">HSN CODE/SAC</th>
            <th class="text-center">DESCRIPTION</th>
            <th class="text-center">EDIT</th>
            <!-- <th class="text-center">DELETE</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($hsncodes as $key=>$hsncode)
            <tr>
                <td class="text-center">{{$key+1}}</td>
                <td class="text-center">{{$hsncode->hsncode}}</td>
                <td class="text-center">{{$hsncode->description}}</td>
                <td class="text-center"><button onclick="editactivity('{{$hsncode->id}}','{{$hsncode->hsncode}}','{{$hsncode->description}}');" class="btn btn-info">EDIT</button></td>
              

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
        <h4 class="modal-title"><b>EDIT ACTIVITY</b></h4>
      </div>
      <div class="modal-body">
        <form action="/updatehsncodes" method="POST">
            {{csrf_field()}}
            <table class="table table-responsive table-hover table-bordered table-striped" >
           <input type="hidden" name="hsnid" id="hsnid">
        <tr>
            <td colspan="4" class="text-center bg-navy">EDIT HSN/SAC</td>
        </tr>
        <tr>
            <td>HSN CODE<span style="color: red"> *</span></td>
            <td><input type="text" class="form-control" autocomplete="off" name="hsncode" placeholder="ENTER HSN CODE" id="hsncode" required></td>
        </tr>
        <tr>
            <td>DESCRIPTION <span style="color: red"> *</span></td>
            <td><textarea name="description" id="description" class="form-control" autocomplete="off" placeholder="ENTER DESCRIPTION"></textarea></td>
            
        </tr>
        
        <tr>
            <td></td>
<td colspan="3"><input type="submit" value="Submit" class="btn btn-success" style="float: right ;"></td>
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
{{$hsncodes->links()}}
@endif

<script type="text/javascript">
    function editactivity(id,hsncode,description) {
        $('#hsnid').val(id);
        $('#hsncode').val(hsncode);
        $('#description').val(description);
        $("#myModal").modal('show');
    }
</script>
@endsection
