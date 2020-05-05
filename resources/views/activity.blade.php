@extends('layouts.app')

@section('content')
   @if(Session::has('msg'))
   <p class="alert alert-info text-center">{{ Session::get('msg') }}</p>
   @endif
  <form action="/saveactivity" method="post">
    {{csrf_field()}}
    <table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">DEFINE ACTIVITY</td>
        </tr>
        <tr>
            <td>ACIVITY NAME<span style="color: red"> *</span></td>
            <td><input type="text" class="form-control" autocomplete="off" name="activityname" placeholder="ENTER ACTIVITY NAME" required></td>
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
@if($activites)
<table class="table table-responsive table-hover table-bordered table-striped" >
    <thead>
        <tr class="bg-navy">
            <th class="text-center">SL.NO</th>
            <th class="text-center">ACTIVITY NAME</th>
            <th class="text-center">DESCRIPTION</th>
            <th class="text-center">EDIT</th>
            <!-- <th class="text-center">DELETE</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($activites as $key=>$activity)
            <tr>
                <td class="text-center">{{$key+1}}</td>
                <td class="text-center">{{$activity->activityname}}</td>
                <td class="text-center">{{$activity->description}}</td>
                <td class="text-center"><button onclick="editactivity('{{$activity->id}}','{{$activity->activityname}}','{{$activity->description}}');" class="btn btn-info">EDIT</button></td>
               <!--  <td class="text-center">
                    <form action="/deleteactivity/{{$activity->id}}" method="post">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Do You Want to delete This Activity?')">DELETE</button>
                        
                    </form>
                </td> -->

            </tr>

        @endforeach
    </tbody>
</table>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>EDIT ACTIVITY</b></h4>
      </div>
      <div class="modal-body">
        <form action="/updateactivity" method="POST">
            {{csrf_field()}}
            <table class="table table-responsive table-hover table-bordered table-striped" >
           <input type="hidden" name="activityid" id="activityid">
        <tr>
            <td colspan="4" class="text-center bg-navy">EDIT ACTIVITY</td>
        </tr>
        <tr>
            <td>ACIVITY NAME<span style="color: red"> *</span></td>
            <td><input type="text" class="form-control" autocomplete="off" name="activityname" placeholder="ENTER ACTIVITY NAME" id="activityname" required></td>
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
{{$activites->links()}}
@endif

<script type="text/javascript">
    function editactivity(id,activityname,description) {
        $('#activityid').val(id);
        $('#activityname').val(activityname);
        $('#description').val(description);
        $("#myModal").modal('show');
    }
</script>
@endsection