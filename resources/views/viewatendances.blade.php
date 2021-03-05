@extends('layouts.app')
@section('content')

<style type="text/css">
    .b {
    white-space: nowrap; 
    width: 120px; 
    overflow: hidden;
    text-overflow: ellipsis; 
   
}
</style>
<table class="table">
  <tr class="bg-blue">
    <td class="text-center">VIEW ATTENDANCES</td>
  </tr>
  
</table>
<div class="row">
<div class="col-md-6">
  <div class="row">
 
</div></div>
<div class="col-md-6"></div>
</div>
<div style="overflow-x:auto;">
<table class="table table-responsive table-hover table-bordered table-striped datatable1">
  <thead>
    <tr class="bg-navy">
    <th>Id</th>
    <th>EMPCODE NO</th>
    <th>EMPLOYEE NAME</th>
    <th>PRESENT</th>
    <th>FULL</th>
    <th>CHANGE</th>
    <th>FULL/HALF</th>
    </tr>
  </thead>

  <tbody>
    @foreach($viewatendances as $viewatendance)
          <tr>
            <td>{{$viewatendance->id}}</td>
            <td>{{$viewatendance->employee_id}}</td>
            <td>{{$viewatendance->employeename}}</td>
            @if($viewatendance->present =="Y")
            <td>PRESENT</td>
            @endif
            @if($viewatendance->present =="H")
            <td>HOLIDAY</td>
            @endif
            @if($viewatendance->present =="N")
            <td>ABSENT</td>
            @endif
            @if($viewatendance->halffull =="F")
            <td>FULLDAY</td>
            @endif
            @if($viewatendance->halffull =="H")
            <td>HALFDAY</td>
            @endif
            @if($viewatendance->halffull =="")
            <td>HOLIDAY</td>
            @endif
            
           <td>
           <select onchange="changestatus(this.value,'{{$viewatendance->id}}')" class="form-control">
           <option value="">Select</option>
           <option value="H">HOLIDAY</option>
           <option value="Y">PRESENT</option>
           <option value="N">ABSENT</option>
          </select>
        </td>
        <td>
           <select onchange="changedaytype(this.value,'{{$viewatendance->id}}')" class="form-control">
           <option value="">Select</option>
           <option value="H">HALF DAY</option>
           <option value="F">FULL DAY</option>
          </select>
        </td>
             </td>
          </tr>
    @endforeach
  </tbody>
</table>
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
              
               url:'{{url("/ajaxchangestatus")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     status:value,
                     id:id
                     },

               success:function(data) { 
                  location.reload();
               }
               
             });
       
    }
    function changedaytype(value,id)
    { 

   $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxchangedaytype")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     status:value,
                     id:id
                     },

               success:function(data) { 
                  location.reload();
               }
               
             });
       
    }
</script>

@endsection