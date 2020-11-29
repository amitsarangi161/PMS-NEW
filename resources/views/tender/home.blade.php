@extends('layouts.tender')
@section('content')

Tender Dashboard

@if(Auth::user()->usertype=='MASTER ADMIN')
      <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$nooftenders}}</h3>

              <p>View all Tenders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="/tm/viewalltenders" class="small-box-footer">view all Tenders<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
            <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$currenttenders}}</h3>

              <p>Current Tender List</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/tm/tenderlist" class="small-box-footer">view all Current Tenders<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$assigntendertoapply}}</h3>

              <p>Assign Tender To Apply</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/tm/assignedtendersoffice" class="small-box-footer">Assign Tender To Apply <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$adminapprovedtenders}}<sup style="font-size: 20px"></sup></h3>

              <p>Admin Approved Tenders</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/tm/adminapprovedtenders" class="small-box-footer">view admin aproved Tenders<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        
        
   
        
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/temptender/notellgible" title="Not Elligible">
          <div class="info-box">
            
             <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text" title="Not Elligible">Not Elligible</span>
              <span class="info-box-number" id="differcount">{{$temptenders}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/tendercom/approvedcommiteetender" title="Approved Tender Committee">

          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" title="Approved Tender Committee">Approved Tender Committee</span>
              <span class="info-box-number" id="differcount">{{$approvedtendercommitte}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/ata/adminapprovedtenders" title="Admin Approved Tender">

          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" title="Admin Approved Tender">Admin Approved Tender</span>
              <span class="info-box-number" id="differcount">{{$adminapprovedtenders}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/applied/appliedtenders" title="Pending Expense Entry">
                    <div class="info-box">
           
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Applied Tenders</span>
              <span class="info-box-number" id="differcount">{{$appliedtenders}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
      	 <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/comrejected/comitteerejectedtenders" title="Not Elligible">
          <div class="info-box">
            
             <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text" title="Rejected Tenders Committe">Rejected Tenders Committe</span>
              <span class="info-box-number" id="differcount">{{$rejectedtenders}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="/alltenderpdu/alltendersdocupload" title="Tender Result">
          <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tender Result</span>
              <span class="info-box-number"></span>

             
                  <span class="progress-description">
                   
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
   
      </div>

      @endif

@endsection