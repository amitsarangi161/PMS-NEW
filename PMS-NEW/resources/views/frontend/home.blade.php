  @extends('layouts.frontend')
  @section('content')
  <!-- ============================================== NAVBAR ============================================== -->


<!-- ============================================== HEADER : END ============================================== -->

<div class="modal fade" id="promobox" role="dialog" data-backdrop="static" data-keyboard="false" style="margin-top: 30px;">

       
         <div class="container">
         <div class="row ">
             
           <div class="col-md-6 col-md-offset-3 " style="background:#fff;padding: 20px;">
               
               
           <div class="promoimage">
               <i  data-dismiss="modal" class="fa fa-times-circle close" style="font-size:26px; float:right;"></i>  
               <img style="width: 100%;height: auto;" class="img img-responsive" src="/img/offer.jpg">
           </div>
           <form action="/addsubscriber" method="post">
            {{csrf_field()}}
           <div class="subscribe">
        <div class="form-group" >
        <label class="info-title" for="exampleInputEmail1">Enter your Mobile Number</label>
        <input type="text" id="mobile" name="mobile" class="form-control unicase-form-control text-input"  >
        </div>
        <div>
        <button class="btn btn-warning btn-flat form-control" id="sbm" type="submit">Get This Offer</button>

        </div>
           
         </div>
       </form>
     
      </div>
      </div>
     
  </div>
  </div>
  
  
<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row"> 
      <!-- ============================================== SIDEBAR ============================================== -->
     
      
      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder"> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
       <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    @php
    $x=0;
    $y=0;
    @endphp
    
    @foreach($sliders as $slider)

 @if($x==0)
     <li data-target="#myCarousel" data-slide-to="{{$x}}" class="active"></li>
   @else
    <li data-target="#myCarousel" data-slide-to="{{$x}}" ></li>
    @endif
@php
    $x++;
    @endphp

    @endforeach
    
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    @foreach($sliders as $slider)

 @if($y==0)


  <div class="item active">
  
<img class="main-slider" src="{{ asset('/img/sliderimage/'.$slider->image )}}" alt="New York">

    </div>
@else
    <div class="item">
      <img class="main-slider" src="{{ asset('/img/sliderimage/'.$slider->image )}}" alt="Chicago">
    </div>

    @endif
@php
    $y++;
    @endphp

    @endforeach


  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        <!-- ========================================= SECTION – HERO : END ========================================= --> 
        
        <!-- ============================================== INFO BOXES ============================================== -->
        <div class="info-boxes wow fadeInUp">
          <div class="info-boxes-inner">
            <div class="row">
              <div class="col-md-6 col-sm-4 col-lg-4">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">Installation</h4>
                    </div>
                  </div>
                  <h6 class="text">Installation within 24hrs in all over India </h6>
                </div>
              </div>
              <!-- .col -->
              
              <div class="hidden-md col-sm-4 col-lg-4">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">free shipping</h4>
                    </div>
                  </div>
                  <h6 class="text">Shipping on orders over INR 999</h6>
                </div>
              </div>
              <!-- .col -->
              
              <div class="col-md-6 col-sm-4 col-lg-4">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">Special Sale</h4>
                    </div>
                  </div>
                  <h6 class="text">Extra INR 500 off on all items </h6>
                </div>
              </div>
              <!-- .col --> 
            </div>
            <!-- /.row --> 
          </div>
          <!-- /.info-boxes-inner --> 
          
        </div>
        <!-- /.info-boxes --> 
        <!-- ============================================== INFO BOXES : END ============================================== --> 
        <!-- ============================================== SCROLL TABS ============================================== -->
        @foreach($productsshow as $ps)
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">{{$ps['brandname']}}</h3>
            
            <!-- /.nav-tabs --> 
          </div>
          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                  @foreach($ps['products'] as $product)
                  <div class="item item-carousel">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> <a href="/products/{{$product->name}}/{{$product->id}}"><img  src="{{asset('img/productimage/'.$product->image1)}}" alt=""></a> </div>
                          <!-- /.image -->
                          
                          <div class="tag new"><span>new</span></div>
                        </div>
                        <!-- /.product-image -->
                        
                        <div class="product-info text-left">
                          <h3 class="name"><a href="/products/{{$product->name}}/{{$product->id}}">{{$product->name}}</a></h3>
                          <div class="">
                                  @php
                                  $img="";
                                  $pid=$product->id;
                                  $r=DB::table('rating')->where('productid',$pid)->pluck('rating')->first();
                                 
                                  @endphp
                                  
                                 
                                
                                  @for($i=1; $i<=$r; $i++)
                                  <i class="fa fa-star checked" style="color:#e7b710;"></i>
                                  @endfor
                                  @for($j=$i; $j<=5; $j++)
                                  <i class="fa fa-star" style="color:#c0c0c0;"></i>
                                  @endfor

                                   <strong>{{round( $r, 1, PHP_ROUND_HALF_UP)}}</strong>
                                  
                             
                               
                          </div>
                          <div class="description"></div>
                          <div class="product-price"> <span class="price"> INR {{$product->promocost}}</span> <span class="price-before-discount">INR {{$product->cost}}</span> </div>
                          <!-- /.product-price --> 
                          
                        </div>
                        <!-- /.product-info -->

                        <!-- /.cart --> 
                      </div>
                      <!-- /.product --> 
                      
                    </div>
                    <!-- /.products --> 
                  </div>
                  <!-- /.item -->
                  @endforeach
                  
                  
                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
            
          </div>
          <div class="more-info-tab clearfix ">
                   <a href="/productsbycategory/{{$ps['brandname']}}/{{$ps['brandid']}}"><h3 class="new-product-title pull-right" style="border: 1px solid #ff7713;padding: 8px;background: #de5e00;color: #fff;font-size: 11px;">View all</h3></a>
                 </div>
          <!-- /.tab-content --> 
        </div>
        
        @endforeach
 
        
      </div>
      <!-- /.homebanner-holder --> 
      <!-- ============================================== CONTENT : END ============================================== --> 
    </div>
    <!-- /.row --> 
    
  </div>
  <!-- /.container --> 
</div>
 @if(Session::get('userid')['status'] !="Y" AND Session::get('offerapply')!='Y')
<script>
    $(document).ready(function(){
        $("#promobox").modal();
    });
</script>
@endif
<!-- /#top-banner-and-menu --> 
@endsection