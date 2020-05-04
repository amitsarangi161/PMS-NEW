@extends('layouts.account')

@section('content')
   @if(Session::has('msg'))
   <p class="alert alert-info text-center">{{ Session::get('msg') }}</p>
   @endif
  <form action="/savediscount" method="post">
    {{csrf_field()}}
    <table class="table table-responsive table-hover table-bordered table-striped" >
        <tr>
            <td colspan="4" class="text-center bg-navy">TENDER PREMIUM /DISCOUNT SETUP</td>
        </tr>
        <tr>
            <td>DISCOUNT NAME:<span style="color: red"> *</span></td>
            <td><input type="text" class="form-control" autocomplete="off" name="discountname" placeholder="Enter Discount Name" required></td>
        </tr>
        
        <tr>
            <td></td>
<td colspan="3"><input type="submit" value="Submit" class="btn btn-success" style="float: right ;"></td>
</tr>
</table>
</form>
@if(count($discounts)>0)
<table class="table table-responsive table-hover table-bordered table-striped" >
    <thead>
        <tr class="bg-navy">
            <th class="text-center">SL.NO</th>
            <th class="text-center">DISCOUNT NAME</th>
            
            <th class="text-center">EDIT</th>
            <!-- <th class="text-center">DELETE</th> -->
        </tr>
    </thead>
    <tbody>
        @foreach($discounts as $key=>$discount)
            <tr>
                <td class="text-center">{{$key+1}}</td>
                <td class="text-center">{{$discount->discountname}}</td>
               
                <td class="text-center"><button onclick="editactivity('{{$discount->id}}','{{$discount->discountname}}');" class="btn btn-info">EDIT</button></td>
              

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
        <form action="/updatediscount" method="POST">
            {{csrf_field()}}
            <table class="table table-responsive table-hover table-bordered table-striped" >
           <input type="hidden" name="did" id="did">
        <tr>
            <td colspan="4" class="text-center bg-navy">EDIT TENDER PREMIUM/DISCOUNT SETUP</td>
        </tr>
        <tr>
            <td>DISCOUNT NAME<span style="color: red"> *</span></td>
            <td><input type="text" class="form-control" autocomplete="off" name="discountname" placeholder="ENTER DISCOUNT NAME" id="discountname" required></td>
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
{{$discounts->links()}}
@endif

<script type="text/javascript">
    function editactivity(id,discountname) {
        $('#did').val(id);
        $('#discountname').val(discountname);
        
        $("#myModal").modal('show');
    }
</script>
@endsection
