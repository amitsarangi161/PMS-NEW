<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
 <style type="text/css">
div.a {
width: 50px;
height:50px;
position:fixed;
z-index: 4;
    
}

.mybtn
{
	height: 50px;
	width: 100px;
}
 </style>

</head>
<body>
</body>

	<div class="container" style="margin-top: 30px;">
		       <div class='a'>
				<button type="button" class="btn btn-lg btn-default pull-left mybtn" onclick="myfun('{{$images->nextPageUrl()}}')" disabled="">Next</button>

				</div>
		

		<div class="panel panel-info">
		      <div class="panel-body">



		      @foreach(array_chunk($items, 4) as $chunk)
		    	
			    	<div class="row">
			    	
			    		
		    		<div class="col-md-12">
		    			@foreach($chunk as $add)
			    		<div class="col-md-3"><img src="/{{$add->image}}" class="img-responsive myimg">
			    		</div>
			    	
			    		@endforeach
			    	</div>
			    	
		    	    </div>
	            @endforeach
	
		      </div>
		</div>
	
	</div>


<script type="text/javascript">
	$(document).ready(function(){
		after();
    animateDiv('.a');
    
    
});

function makeNewPosition(){
    
    // Get viewport dimensions (remove the dimension of the div)
    var h = $(window).height() - 50;
    var w = $(window).width() - 50;
    
    var nh = Math.floor(Math.random() * h);
    var nw = Math.floor(Math.random() * w);
    
    return [nh,nw];    
    
}

function animateDiv(myclass){
    var newq = makeNewPosition();
    $(myclass).animate({ top: newq[0], left: newq[1] }, 5000,   function(){
      animateDiv(myclass);        
    });
    
};

function myfun(url)
{
	
	window.location.href=url;
}

function handleTimer() {
  if(count === 0) {
    clearInterval(timer);
    endCountdown();
     
   
  } else {
    $(".mybtn").prop('disabled', false);
    $(".mybtn").text('Next'+count);
    count--;
   
  }
}
function endCountdown() {
	$(".mybtn").prop('disabled', true);
   $(".mybtn").text('Next');
}

var count = 3;
var timer=0;

function activebtn()
{

timer = setInterval(function() { handleTimer(count); }, 1000);

var interval = setInterval(doStuff, 3000); // 2000 ms = start after 2sec 
function doStuff() {

  //alert('this is a 3 second warning');
   $(".mybtn").text('Next');
 
  $(".mybtn").prop('disabled', true);
  
  
  clearInterval(interval);
   after();
}
}

function  after(){
var interval1 = setInterval(doStuff1, 15000);
	function doStuff1() {
  //alert('this is a 15 second warning');
  $(".mybtn").prop('disabled', false);
  clearInterval(interval1);
   activebtn();
   count=3;
   

}

}

</script>


</html>