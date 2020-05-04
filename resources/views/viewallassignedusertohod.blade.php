@extends('layouts.app')
@section('content')

<table class="table">
	<tr class="bg-blue">
		<td class="text-center">VIEW USERS ASSIGNED UNDER HOD</td>
	</tr>
	
</table>
<div class="container-fluid">

	@foreach(array_chunk($finalusershodsarray, 3) as $chunk)
	<div class="row">
      @foreach($chunk as $data)
        <div class="col-md-4">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title" class="text-center" style="text-transform: capitalize;">{{$data['hodname']}}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool"><i class="fa fa-plus"></i>
                </button>
              </div>
              
            </div>
           
            <div class="box-body" style="">
            	@foreach($data['users'] as $user)
            	<ul>
            		<li id="li{{$user['unhid']}}" style="text-transform: capitalize;font-weight: bold;">{{$user['name']}}<i class="fa fa-trash-o pull-right" onclick="removethisuser('{{$user["unhid"]}}');"  style="font-size:15px;color:red;cursor: pointer;"></i></li>
            	</ul>
            	@endforeach
            </div>
            
          </div>
         
        </div>
        @endforeach
       
      
       
      </div>
	   @endforeach
</div>

<script type="text/javascript">
	function removethisuser(unhid)
	{

	   var question=confirm("Do you Want to Delete this User?");
       if(question)
       {
       	    if(unhid!='')
        {

    
                $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });
              

              $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxremoveuserfromhod")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      id:unhid

                     },

               success:function(data) {         
                      
        var liid="#li"+unhid;

        $(liid).remove();
                }
              });



    }
   

       }
        


	}
</script>
@endsection