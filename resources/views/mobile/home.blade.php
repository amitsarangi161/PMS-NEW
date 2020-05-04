@extends('layouts.mobile')

@section('content')

<style type="text/css">
  
    .btnid{margin-top: 50px;margin-bottom: 50px;}
    .my-btn{
    width: 100%;
    height: 150px;
    border-radius: 0px;
    font-size: 50px;
    color: #fff;
    letter-spacing: 1px;
}

.my-btn{
    width: 100%;
    height: 150px;
    border-radius: 0px;
    font-size: 50px;
    color: #fff;
    letter-spacing: 1px;
}
#btnid{margin-top: 50px;margin-bottom: 50px;}
.mob-user .fa-sign-out{color:black;}

</style>

<div class="section">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" id="btnid">
        <button onclick="openvendor();"  class="btn my-btn" style="background-color: #12A37B;">Vendor</button>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" id="btnid">
        <button  class="btn my-btn" style="background-color: #12A37B;">Requisition</button>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" id="btnid">
        <button class="btn my-btn" style="background-color: #FF8800;">Expense</button>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" id="btnid">
        <button class="btn my-btn" style="background-color: #007E33;">Progress</button>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" id="btnid">
        <button class="btn my-btn" style="background-color: #CC0000;">Complaint</button>
    </div>
</div>


<script type="text/javascript">
    function openvendor()
    {
        location.href='/mobile/vendors';
    }
</script>

@endsection