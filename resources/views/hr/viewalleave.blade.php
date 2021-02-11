@extends('layouts.hr')

@section('content')

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
      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped datatable1">
        <thead>
          <tr class="bg-navy">
            <th>SL_NO</th>
            <th>APPLIER NAME</th>
            <th>PURPOSE</th>
            <th>LEAVE TYPE</th>
            <th>Full/HALF</th>
            <th>FROM DATE</th>
            <th>TO DATE</th>
            <th>RELIVER</th>
            <th>APPROVAL</th>
            <!-- <th>ACTION</th> -->
            <th>VIEW</th>
          </tr>
        </thead>
    <tbody>
       @foreach($viewapplies as $key =>$viewapplie)
       @php
           if($viewapplie->status=="PENDING")
           {

              $color="#dbd973";
           }
           if($viewapplie->status=="REJECTED")
           {

              $color="#f2bfbf";
           }
           if($viewapplie->status=="ACCEPTED")
           {

              $color="#77e89e";
           }
        @endphp
      <tr style="background-color: {{$color}}">
          <td>{{$key+1}}</td>
          <td>{{$viewapplie->name}}</td>
          <td title="{{$viewapplie->purpose}}">{{str_limit($viewapplie->purpose,30)}}</td>
          <td>{{$viewapplie->leavetypename}}</td>
          <td>{{$viewapplie->fullhalf}}</td>
          <td>{{$viewapplie->fromdate}}</td>
          <td>{{$viewapplie->todate}}</td>
          <td>{{$viewapplie->releivername}}</td>
          <td>{{$viewapplie->status}}</td>
          <!-- <td id="tid{{$viewapplie->id}}">
           <select onchange="changestatus(this.value,'{{$viewapplie->id}}')" class="form-control">
           <option value="">Select</option>
           <option value="ACCEPTED">ACCEPTED</option>
           <option value="REJECTED">REJECTED</option>
          </select>
        </td> -->
        <td><a href="/viewapplicantleaveall/{{$viewapplie->id}}" ><button class="btn btn-primary">VIEW</button></a></td>
      </tr>
      @endforeach
    </tbody>

      
      </table>
  </div>

</div>

<script type="text/javascript">
  function changestatus(value,id)
    { 
      


   $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxchangeleavestatus")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     status:value,
                     id:id,
                     
                     },

               success:function(data) { 
                    location.reload();
                    id='#tid'+data;
               }
               
             });
       
    }
</script>


@endsection