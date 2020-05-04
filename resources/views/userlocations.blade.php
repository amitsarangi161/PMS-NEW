@extends('layouts.app')
@section('content')
<style type="text/css">
    
#map-canvas{
    width: 100%;
    height: 700px;
}

</style>
<div class="col-sm-12">
<div class="col-md-10">
    <div id="map-canvas">
    
</div>
</div>
<div class="col-md-2">
    <div class="well">
        Details:<hr>
        Name:<b style="color:blue;">{{$uname}}</b><br>
        
        Date:<b style="color:green;">{{$date}}</b>
        
    </div>
    <div class="well">
        
        Location Details:
        <hr>
        <strong id="locdetails" style="color:red;"></strong>
        <br>
        SERIAL NO :- <strong id="slno"></strong>
   
        
    </div>
    <div class="well">
        <a href="/showdetaillocations/{{$uid}}/{{$date}}" class="btn btn-primary" target="_blank">SHOW DETAILS</a> 
    </div>


    
</div>
    
</div>

<input type="hidden" name="uid" id="uid" value="{{$uid}}">
<input type="hidden" name="date" id="date" value="{{$date}}">
<input type="button" onclick="transition();" value="Reload markers" >
<input type="hidden" id="add">



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpd5bBWsGyPvEBgmB_3-QjTQ8bP5yIW0"></script>


<script type="text/javascript">
  var geocoder;
  var map;
  var places;
  var markers = [];



 function initialize() {
    // create the geocoder
    
    geocoder = new google.maps.Geocoder();
    
    // set some default map details, initial center point, zoom and style
    var mapOptions = {
      center: new google.maps.LatLng(20.9517,85.0985),
      zoom: 7,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    // create the map and reference the div#map-canvas container
    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    // fetch the existing places (ajax) 
    // and put them on the map
    fetchPlaces();
  }
  
   google.maps.event.addDomListener(window, 'load', initialize);

var fetchPlaces = function() {
    var uid=$("#uid").val();
    var date=$("#date").val();
    var infowindow =  new google.maps.InfoWindow({
        content: ''
    });

        $.ajaxSetup({
            
            
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
            });


        

               $.ajax({
               type:'POST',
               url:'{{url("/getuserlocation")}}',
               data: {
                     "_token": "{{ csrf_token() }}",
                      uid:uid,
                      date:date
                     },
                     success:function(data) {
                     
                   //setMarkers(data);
                    
                   /* $.each(data, function(view, element) {
                           tmpLatLng = new google.maps.LatLng(element.latitude,element.longitude); 
                           // make and place map maker.
            var marker = new google.maps.Marker({
                map: map,
                position: tmpLatLng,
                title : element.id 
            });
            bindInfoWindow(marker, map, infowindow, '<b>'+element.id + "</b><br>");

                     });*/
                     
                     
var flightPlanCoordinates = new Array(); 
var bounds = new google.maps.LatLngBounds();

                   
                    
                       for (var i = 0; i < data.length; i++) {
                            var icon = { 
                                url: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+(i+1)+'|FE6256|000000'
                                 };
                        counter=1;
                       var beach = data[i];
                      var contentString="<h5>"+beach.empid+"</h5>";
                        var myLatLng = new google.maps.LatLng(beach.latitude, beach.longitude);

      
                         var marker = new google.maps.Marker({
                                  position: myLatLng,
                                  map: map,
                                  icon:icon,
                                 
                                 
                                
                                });
        
    
      
  
    
     bindInfoWindow(marker, map, infowindow, "<b>"+(i+1)+ "</b><br><b>"+createtime(beach.created_at)+"</b><br><button type='button' onclick='return_address("+beach.latitude+", "+beach.longitude+","+(i+1)+")'>View</button>");
        // Push marker to markers array
      markers.push(marker);
       
    }
   
//alert(return_address(beach.latitude, beach.longitude));
    for (var i = 0; i < data.length; i++) {
         var beach = data[i];
       
          var point =new google.maps.LatLng(beach.latitude, beach.longitude);
             bounds.extend(point);
            flightPlanCoordinates.push(point); 
        
    }
    
console.log(flightPlanCoordinates);
    
    
var flightPath = new google.maps.Polyline({

 path: flightPlanCoordinates,

 geodesic: true,

 strokeColor: 'blue',

 strokeOpacity: 5.0,

 strokeWeight: 2

 });



flightPath.setMap(map);

//map.fitBounds(bounds);
    

                      
               
                   
                   
                    }
                    
                    });

   
}
/*function setMarkers(locations) {
   

    for (var i = 0; i < locations.length; i++) {
        counter=1;
        var beach = locations[i];
        var contentString="<h5>"+beach.id+"</h5>";
        var myLatLng = new google.maps.LatLng(beach.latitude, beach.longitude);
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title:"abc"
        });
       
      //  bindInfoWindow(marker, map, infowindow, contentString);
        // Push marker to markers array
      markers.push(marker);
       
    }
}*/




     
   
   
  function return_address(lat,long,slno) {
     //alert(slno);
    var address = null;
     $.get( "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+long+"&key=AIzaSyAPpd5bBWsGyPvEBgmB_3-QjTQ8bP5yIW0", function( data ) {
         address=data.results[0].formatted_address;
        $("#locdetails").html(address);
        $("#slno").html(slno);
   });
   

};



var bindInfoWindow = function(marker, map, infowindow, html) {
    
  
   
      google.maps.event.addListener(marker, 'click', function() {
          
           map.panTo(this.getPosition());
          
          infowindow.setContent(html);
          infowindow.open(map, marker);
      });
      

  } 


var timeout = setInterval(reloadmap, 3000); 

function reloadmap () {
 /*     for(i=0; i<markers.length; i++){
        markers[i].setMap(null);
    }
    console.log(markers)*/
   
  fetchPlaces();
}


function createtime(datetime)
{
   
    var today = new Date(datetime);
    var cHour = today.getHours();
    var cMin = today.getMinutes();
    var cSec = today.getSeconds();
    var time=cHour+ ":" + cMin+ ":" +cSec;
    return time;

}

</script>  


@endsection
    