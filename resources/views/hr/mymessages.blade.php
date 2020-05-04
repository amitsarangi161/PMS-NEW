@extends('layouts.hr')
@section('content')
<style type="text/css">
      @charset "utf-8";


/* CSS Document */

/* ---------- GENERAL ---------- */
.bigdrop {
    width: 400px !important;
}
.bigdrop1 {
    width: 400px !important;
}
body {
  background: #e9e9e9;
  color: #9a9a9a;
  margin: 0;
}

a { text-decoration: none; }

fieldset {
  border: 0;
  margin: 0;
  padding: 0;
}

h4, h5 {
  line-height: 1.5em;
  margin: 0;
}

hr {
  background: #e9e9e9;
    border: 0;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    height: 1px;
    margin: 0;
    min-height: 1px;
}

img {
    border: 0;
    display: block;
    height: auto;
    max-width: 100%;
}

input {
  border: 0;
  color: inherit;
    font-family: inherit;
    font-size: 100%;
    line-height: normal;
    margin: 0;
}

p { margin: 0; }

.clearfix { *zoom: 1; } /* For IE 6/7 */
.clearfix:before, .clearfix:after {
    content: "";
    display: table;
}
.clearfix:after { clear: both; }

/* ---------- LIVE-CHAT ---------- */

#live-chat {
  bottom: 0;
  font-size: 12px;
  right: 24px;
  position: fixed;
  width: 433px;

}

#live-chat header {
  background: #293239;
  border-radius: 5px 5px 0 0;
  color: #fff;
  cursor: pointer;
  padding: 16px 24px;
}

#live-chat h4:before {
  background: #1a8a34;
  border-radius: 50%;
  content: "";
  display: inline-block;
  height: 8px;
  margin: 0 8px 0 0;
  width: 8px;
}

#live-chat h4 {
  font-size: 12px;
}

#live-chat h5 {
  font-size: 10px;
}

#live-chat form {
  padding: 24px;
}

#live-chat input[type="text"] {
  border: 1px solid #ccc;
  border-radius: 3px;
  padding: 8px;
  outline: none;
  width: 234px;
}

.chat-message-counter {
  background: #e62727;
  border: 1px solid #fff;
  border-radius: 50%;
  display: none;
  font-size: 12px;
  font-weight: bold;
  height: 28px;
  left: 0;
  line-height: 28px;
  margin: -15px 0 0 -15px;
  position: absolute;
  text-align: center;
  top: 0;
  width: 28px;
}

.chat-close {
  background: #1b2126;
  border-radius: 50%;
  color: #fff;
  display: block;
  float: right;
  font-size: 10px;
  height: 16px;
  line-height: 16px;
  margin: 2px 0 0 0;
  text-align: center;
  width: 16px;
}

.chat {
  background: #fff;
}

.chat-history {
  height: 252px;
  padding: 8px 24px;
  overflow-y: scroll;
}

.chat-message {
  margin: 16px 0;
}

.chat-message img {
  border-radius: 50%;
  float: left;
}

.chat-message-content {
  margin-left: 56px;
}

.chat-time {
  float: right;
  font-size: 10px;
}

.chat-feedback {
  font-style: italic; 
  margin: 0 0 0 80px;
}
</style>

<input type="hidden" id="otherpartyname1">
<input type="hidden" id="otherpartyid1">
<input type="hidden" id="convertationid1">
<input type="hidden" id="authid1">
<input type="hidden" id="input">



<button type="button" onclick="compose();" class="btn btn-primary" autocomplete="off">
  <i class="fa fa-edit"></i> Compose 
</button>
<!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
          <form id="composemmessage" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
  <table class="table">
    <tr>
      <td style="width: 20%;"><strong>TO</strong></td>

      <td>
        <select class="form-control select2 bigdrop1" name="reciver" id="reciver" required="">
          <option value="">Select a User</option>
          @foreach($users as $user)
                      @if($user->designation=='')
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @else
                      <option value="{{$user->id}}">{{$user->name}}({{$user->designation}})</option>
                    @endif
          @endforeach
          
        </select>
      </td>
    </tr>
    <tr>
      <td><strong>YOUR MESSAGE</strong></td>
      <td>
        <textarea class="form-control" name="message" id="message"></textarea>
      </td>
    </tr>
    <tr>
      <td><strong>ATTACHMENT</strong></td>
      <td>
        <input type="file" name="attachment" id="attachment">
      </td>
    </tr>

    <tr>
      <td colspan="2" style="text-align: right;"><button type="submit" class="btn btn-success btn-lg">SEND</button></td>
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
<!-- Modal -->
<div class="box box-primary">
            <div class="box-header with-border">
              <h3  style="text-align: center;"><strong>Recent Conversations</strong></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <ul class="products-list product-list-in-box" style="overflow-y: scroll; height: 380px;">


                @foreach($messages as $message)

                @php
                    if($message->sender==Auth::id())
                    {
                      $name=$message->reciver;
                    }
                    else
                    {
                      $name=$message->sender;
                    }

                    $username=\App\User::find($name);

                    if($message->seen=='1')
                    {
                      $col="khaki";
                    }
                    else{
                      $col="gainsboro";
                  }
                @endphp
                
                <li class="item" style="background-color:{{$col}}"  onclick="chatopen('{{$username->name}}','{{$name}}','{{$message->convertationid}}','{{Auth::id()}}');ajaxchangeseenstatus('{{$message->convertationid}}');">
                  
                 
                  <div class="product-img">
                    <img src="/dist/img/avatar04.png" alt="user image">
                  </div>
                  <div class="product-info">
                    <div class="product-title" style="text-transform: capitalize;"><strong style="font-size: 14px;">
                      {{$username->name}}</strong>
                      
                      <span class="label label-warning pull-right" style="font-size: 13px;">
                        {{\Carbon\Carbon::createFromTimeStamp(strtotime($message->created_at))->diffForHumans()}}
                      </span>
                       @if($message->seen=='1')
                       <span class="label label-danger pull-right" style="font-size: 13px;">New</span>
                      @endif
                    </div>
                    <span class="product-description">

                      @if($message->sender==Auth::id())
                         @if($message->attachment=='')
                           
                               <strong>YOU: {{$message->message}}</strong>

                              @else
                              <strong>YOU: {{$username->name}} Sent an Attachment </strong> 
                         @endif
                      @else
                          @if($message->attachment=='')
                           
                               <strong>{{$username->name}}: {{$message->message}}</strong>

                              @else
                              <strong>{{$username->name}}: Sent an Attachment </strong> 
                         @endif
                      @endif
                    </span>
                  </div>
                 
                </li>

                @endforeach
                

              </ul>
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
          </div>

<!-- Message Start -->
<div id="live-chat" style="display: none;">
    
    <header class="clearfix">
      
      <a href="#" class="chat-close">x</a>

      <h4 id="otherpartyname" style="text-transform: capitalize;"></h4>
      

      <span class="chat-message-counter">3</span>

    </header>

    <div class="chat">
      
      <div class="chat-history" id="chat-history" style="background-color: aliceblue;">

        
       

       

        
      </div> <!-- end chat-history -->

     

 <form class="form-horizontal file-upload" id="form" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
   

        <fieldset>
          
          <input type="text" name="message" placeholder="Type your message…" id="message" autofocus autocomplete="off" style="width:100%;border-radius:0px;">
         <div class="btn teal lighten-1">
                        <input type="file" name="attachment" id="attachment">
          </div>
          <input type="hidden"  name="otherpartyid" id="otherpartyid">
          

          <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Send</button>

        </fieldset>

      </form>

    </div> <!-- end chat -->

  </div> 
  <!-- messages -->

  <script type="text/javascript">


    var timer = null, 
    interval = 100000,
    value = 0;
 
 $(document).ready(function(){

     setInterval(function(){
 
 loadconversation();
 autoloadhistory();
 }, 50000);

 });


function autoloadhistory()
{

var otherpartyname1=$("#otherpartyname1").val();
var otherpartyid1=$("#otherpartyid1").val();
var authid1=$("#authid1").val();
var convertationid1=$("#convertationid1").val();
if(otherpartyname1!=''&& otherpartyid1!=''&& authid1!='' && convertationid1!='')
{



  if (timer !== null) return;
  timer = setInterval(function () {
      value = value+1;
      $("#input").val(value);

      ajaxloadchathistory(convertationid1,otherpartyid1,otherpartyname1,authid1);
  }, interval); 
}

}

function stoprefresh()
{
    clearInterval(timer);
    timer = null;
}






function loadconversation()
{
            $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

   //var u="business.draquaro.com/api.php?id=9658438020";

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxloadconvertation")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     
                     },

               success:function(data) { 

                $(".products-list").empty();
                
                 $.each(data.messages,function(key,value){
                    
                            
                   if(value.sender==data.authid)
                    {
                      name=value.recivername;
                      othid=value.reciver;
                    
                    }
                    else
                    {
                      name=value.sendername;
                      othid=value.sender;
                    }

                     
                      var current1= + new Date();
                      var time1=timeDifference(current1, new Date(value.created_at));
                    


                      var txtmessage='';
                            
                         if(value.sender==data.authid)
                         {
                             if(!value.attachment)
                             {
                                txtmessage='<strong>YOU:'+value.message+'</strong>';
                                
                             }
                             else
                             {
                                 txtmessage='<strong>YOU: Sent an Attachment</strong>';

                             }
                         }
                           
                         else{
                              if(!value.attachment)
                              {
                                  txtmessage='<strong>'+name+':'+value.message+'</strong>';
                              }
                              else
                              {
                                  txtmessage='<strong>'+name+':sent an Attachment </strong>';
                              }
                         }

                 if(value.seen=='1')
                    {
                      col="khaki";
                      showt='<span class="label label-danger pull-right" style="font-size:13px;">New</span>';

                    }
                    else{
                      col="gainsboro";
                      showt="";
                  }


 var x= '<li class="item" style="background-color:'+col+'" onclick="chatopen(\''+ name + '\','+othid+',\''+ value.convertationid + '\','+data.authid+');ajaxchangeseenstatus(\''+ value.convertationid + '\');">'+
                 
                  '<div class="product-img">'+
                    '<img src="/dist/img/avatar04.png" alt="user image">'+
                  '</div>'+
                  '<div class="product-info">'+
                    '<div class="product-title" style="text-transform: capitalize;"><strong style="font-size: 14px;">'+name+'</strong><span class="label label-warning pull-right" style="font-size:13px;">'+time1+'</span>'+showt+
                    '</div>'+
                    '<span class="product-description">'+txtmessage+
                    '</span>'+
                  '</div>'+
                 
                '</li>';


            $(".products-list").append(x);
                 });


               }
             });
}

$(document).ready(function(){


        $('#form').submit(function(event){


            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                url: "{{url('/ajaxsendmessage')}}",
                data: formData,
                type: 'post',
                async: false,
                processData: false,
                contentType: false,
                success:function(data){
                    
                   ajaxloadchathistory(data.convertationid,data.otherpartyid,data.otherpartyname,data.authid);
                   //ajaxchangeseenstatus(data.convertationid);
                   loadconversation();
                   $('#form').trigger("reset");
                }
            });

        });
    });


$(document).ready(function(){

    $('.item').on('click', function(e) {

    e.preventDefault();
    

  });


        $('#composemmessage').submit(function(event){


            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                url: "{{url('/ajaxcomposemessage')}}",
                data: formData,
                type: 'post',
                async: false,
                processData: false,
                contentType: false,
                success:function(data){
                     chatopen(data.otherpartyname,data.otherpartyid,data.convertationid,data.authid)
                     ajaxloadchathistory(data.convertationid,data.otherpartyid,data.otherpartyname,data.authid);
                   //ajaxchangeseenstatus(data.convertationid);
                   loadconversation();
                   $('#composemmessage').trigger("reset");
                   $("#myModal").modal('hide');
                    
                }
            });

        });
    });

    function chatopen(otherpartyname,otherpartyid,convertationid,authid)
    {
   
   
          stoprefresh();

            $("#otherpartyname1").val(otherpartyname);
        $("#otherpartyid1").val(otherpartyid);
        $("#convertationid1").val(convertationid);
        $("#authid1").val(authid);

            autoloadhistory();

        ajaxloadchathistory(convertationid,otherpartyid,otherpartyname,authid);
       /* ajaxchangeseenstatus(convertationid);*/
    

        $("#otherpartyname").html(otherpartyname);
        $("#otherpartyid").val(otherpartyid);
        $('#live-chat').fadeIn(300);
    }
   
  function ajaxchangeseenstatus(convertationid){

     $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });


           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxchangeseenstatus")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      convertationid: convertationid

                     },

               success:function(data) { 

                   loadconversation();
               }
             });


  }


  function ajaxloadchathistory(convertationid,otherpartyid,otherpartyname,authid)
{


      $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });


           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxgetchathistory")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                      convertationid: convertationid,
                      otherpartyid:otherpartyid

                     },

               success:function(data) { 
               
                   $("#chat-history").empty();
                     $.each(data,function(key,value){

                     if(value.sender==authid)
                     {
                        dispname="You";
                        img='/dist/img/avatar04.png';
                        color="chocolate";

                     }
                     else
                     {
                         color="blue";
                         dispname=otherpartyname;
                         img='/dist/img/avatar5.png';
                     }

    var current= + new Date();
var time=timeDifference(current, new Date(value.created_at));
    showattachment='';
  
     if (!value.attachment) 
     {
       
          showattachment='';
     }
     else
     {
         showattachment='<a title="click to view the attachment" href="/img/chatattachment/'+value.attachment+'" target="_blank">'+
         '<strong>Sent a Attachment('+value.attachmentrealname+')</strong></a>';
     }

    
       if(!value.message)
     {
       msg1="";
     }
     else
     {
       msg1='<p>'+value.message+'</p>';
     }

       var x= '<div class="chat-message clearfix">'+
      '<img src="'+img+'" alt="" width="32" height="32">'+
          '<div class="chat-message-content clearfix">'+
            '<span class="chat-time">'+time+'</span>'+
            '<h5><strong style="font-size: 14px;color:'+color+';text-transform: capitalize;">'+dispname+'</strong></h5>'+
            msg1+showattachment+
          '</div>'+
        '</div><hr>';

          $("#chat-history").prepend(x);
          var objDiv = document.getElementById("chat-history");
          objDiv.scrollTop = objDiv.scrollHeight;

                     });
                }
              });
}

    (function() {

/*  $('#live-chat header').on('click', function() {

    $('.chat').slideToggle(300, 'swing');
    $('.chat-message-counter').fadeToggle(300, 'swing');

  });*/

  $('.chat-close').on('click', function(e) {

    e.preventDefault();
    $('#live-chat').fadeOut(300);

  });

}) ();



    function timeDifference(current, previous) {
    
    var msPerMinute = 60 * 1000;
    var msPerHour = msPerMinute * 60;
    var msPerDay = msPerHour * 24;
    var msPerMonth = msPerDay * 30;
    var msPerYear = msPerDay * 365;
    
    var elapsed = current - previous;
    
    if (elapsed < msPerMinute) {
         return Math.round(elapsed/1000) + ' seconds ago';   
    }
    
    else if (elapsed < msPerHour) {
         return Math.round(elapsed/msPerMinute) + ' minutes ago';   
    }
    
    else if (elapsed < msPerDay ) {
         return Math.round(elapsed/msPerHour ) + ' hours ago';   
    }

    else if (elapsed < msPerMonth) {
         return 'approximately ' + Math.round(elapsed/msPerDay) + ' days ago';   
    }
    
    else if (elapsed < msPerYear) {
         return 'approximately ' + Math.round(elapsed/msPerMonth) + ' months ago';   
    }
    
    else {
         return 'approximately ' + Math.round(elapsed/msPerYear ) + ' years ago';   
    }
}

function compose()
{
  $("#myModal").modal('show');
}

  </script>
 
@endsection