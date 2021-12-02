@extends('layouts.main_shop')
@section('headers')
<link rel="stylesheet" href="{{ asset('dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/responsive.css') }}">
<style>
 .input_field {width:100%; height:45px; line-height:50px; margin-bottom:25px; background:#F6F7FB; border-radius:0px; border:none;}
 .fill { font-size: .9em; text-align:center; margin-bottom:2.5em;}
 .shop.checkout .nice-select { background: #ffffff;  }
 .wizard>.steps .current a, .wizard>.steps .current a:hover, .wizard>.steps .current a:active { background: #4bb6ee; }
 .wizard>.actions a, .wizard>.actions a:hover, .wizard>.actions a:active { background: #40bbe7; }
 .wizard>.content { background: #ffffff; }
 .wizard>.steps>ul>li { width: 33.3%; }
 @media (max-width: 480px) {
   .wizard>.steps>ul>li { width: 50%; }
 }

@media (min-width: 480px) {
 .wizard>.content>.body {  min-height: 348px; }
}
</style>
@endsection
@section('content')
 
  
    <!-- header 2 nav -->
    @include('shop.header2') 

     
    
    
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="#">Checkout </a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				 
		
        



        <!-- Start Checkout -->
		<section class="shop checkout section">
			<div class="container">
				<div class="row mt-3"> 
                    <div class="col-md-5">
                        <div class="mb-3" style="border: 1px solid #dfe0e2;">
                            <div class="text-center">
                                <img src="{{asset('storage/uploads/products_img/'.$product_attp->img_name)}}" alt="" class="img img-fluid" id="update_preview_img" style="height:200px;"/>
                            </div>  
                                
                            <div class="">
                                <table class="table table-hover w-100">
                                    <tr><td>Product ID</td>  <td><b>{{$product_attp->product_id}}</b></td></tr>
                                    <tr><td>Name</td>        <td><b>{{$product_attp->prd_name}}</b></td></tr>
                                    <tr><td>Price</td>       <td><b>{!!naira()!!} {{number_format($product_attp->price)}}</b></td></tr>
                                    <tr><td>Description</td> <td><b>{!!substr($product_attp->description,0,200)!!} ...</b></td></tr>
                                </table>
                            </div>   
                          </div>
                    </div>
                    
                    <div class="col-md-7">
                        <div class="login-sec-bg mb-4 p-2" id="add_new" style="border: 1px solid #dfe0e2;background-color: #f7f7fd;"> 
                            <form id="form_wizard" action="#" class="pt-1" name="registry_form" method="post">  
                            
                                <h3>Set Up</h3>
                                <fieldset class="form-input">
                                    <h6 class="fill">Fill in the fields below with the accurate information</h6>
                                    {{--START=> Your next of kin data --}}
                                    <div class="row">
                                        <input type="hidden" name="amt" id="amt" value="{{$product_attp->price}}">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="nok_fullname"> Payment Frequency  </label>
                                              <select class="form-control" name="freq" id="freqs">
                                                <option value=""> choose</option>
                                                <option value="daily">Daily</option>
                                                <option value="weekly">Weekly</option> 
                                                <option value="monthly">Monthly</option>
                                              </select>
                                            </div>
                                        </div> 
                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="nok_address"> Installment Duration  </label>
                                              <select class="form-control" name="duration" id="duration"required>
                                                <option value=""> choose</option>
                                                    <option value="2">Two Months</option>
                                                    <option value="3">Three Months</option>
                                                    <option value="4">Four Months</option>
                                                </select>
                                            </div> 
                                        </div> 
                        
                                     
                                       
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="tot-text"> First Payment  </label>
                                            <input required type="number" class="form-control" id="tot" name="tot" readonly>
                                            </div>
                                        </div>
                        
                                        <div class="col-md-6">                    
                                            <div class="form-group">
                                                <div class="form-radio" style="margin-bottom:10px">
                                                    <input name="mode" class="d-inline mr-1" id="mode1" type="radio" value='automatic'> 
                                                    <label class="d-inline" for="mode1">Allow Auto debit on card on payment due date</label>
                                                </div>
                                                <div class="form-radio">
                                                    <input name="mode" id="mode2" class="d-inline mr-1" type="radio" value="manual">  
                                                    <label class="d-inline" for="mode2">Manually pay on payment due date</label>
                                                </div> 
                                            </div>
                                        </div>
                                

                                    </div>  
                                      {{--END=> Your next of kin data --}}
                                </fieldset>


                            <h3>Personal Data</h3>  
                            <fieldset class="form-input">
                                <h6 class="fill">Fill in the fields below with the accurate information</h6>
                                {{--START=> Your personal information --}}
                                <div class="row">  
                                  <input type="hidden" name="_method" value="PUT">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name"> {{__('First Name')}}  </label>
                                            <input required value="{{auth()->user()->client->first_name}}" type="text" class="form-control" id="first_name" name="first_name">
                                            </div>
                                        </div> 
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name"> {{__('Last Name')}}  </label>
                                            <input required value="{{auth()->user()->client->last_name}}" type="text" class="form-control" id="last_name" name="last_name">
                                            </div> 
                                        </div>   

                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email"> {{__('Email Address')}}  </label>
                                            <input required value="{{auth()->user()->email}}" type="email" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone"> {{__('Phone Number')}}  </label>
                                            <input required value="{{auth()->user()->client->phone}}" type="digits" class="form-control" id="phone" name="phone_number">
                                            </div>
                                        </div> 
                    
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address"> {{__('Address')}}  </label>
                                            <input required value="{{auth()->user()->client->address}}" type="text" class="form-control" id="address" name="address">
                                            </div>
                                        </div>
                    
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city"> {{__('City')}}  </label>
                                            <input required value="{{auth()->user()->client->city}}" type="text" class="form-control" id="city" name="city">
                                            </div>
                                        </div>
                    
                                            <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="state"> {{__('State')}}  </label>
                                            <select required id="state" class="form-control" name="state"> 
                                                <option value="Lagos">Lagos</option> 
                                              </select>
                                            </div>
                                        </div>
                     
                                      
                    
                                    
                        
                                           
                                
                                    </div>    
                                {{--END=> Your personal information --}}
                            </fieldset>
                     
                            <h3>Summary</h3>
                            <fieldset class="form-input">
                                {{-- <h6 class="fill">Fill in the fields below with the accurate information</h6> --}}
                                {{--START=> data --}}
                                 <div class="row">
                    
                                      <div class="col-12">
                                         
                                      </div> 
                       
                                  </div>  
                                {{--END=> Your guarantor data --}}
                            </fieldset>
                    
                            
                          </form>
                      </div>  
                    </div>


					{{-- <div class="col-lg-8 col-12">
						<div class="checkout-form">
							<h2>Make Your Checkout Here</h2>
							<p>Please register in order to checkout more quickly</p>
							<!-- Form -->
							<form class="form" method="post" action="#">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>First Name</label>
											<input type="text" name="name" value="{{auth()->user()->client->first_name}}" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Last Name</label>
											<input type="text" name="name" value="{{auth()->user()->client->last_name}}" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Email Address</label>
											<input type="email" name="email" value="{{auth()->user()->email}}" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Phone Number</label>
											<input type="number" name="number" value="{{auth()->user()->client->phone}}" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Country</label>
                                            <input type="text" name="country" value="{{auth()->user()->client->country}}" required="required">

										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>State </label>
                                            <input type="text" name="country" value="{{auth()->user()->client->state}}" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Address </label>
											<input type="text" name="address" value="{{auth()->user()->client->address}}"  required="required">
										</div>
									</div>  
  

								 
								</div>
							</form>
							<!--/ End Form -->
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="order-details">

							<!-- Order Widget -->
							<div class="single-widget">
								<h2>INSTALLMENT SET-UP</h2>
								<div class="content">
									   <div class="row">
                                              
                                       </div>
								</div>
							</div>
							<!--/ End Order Widget -->


							<!-- Order Widget -->
							<div class="single-widget">
								<h2>Payments</h2>
								<div class="content">
									<div class="radio mb-1 ml-4 pt-2">
										<label class="d-block mb-1" for="online_payment"><input name="pay_method" id="online_payment" type="radio"> Online Payment</label>
										<label class="d-block mb-1" for="cash"><input name="pay_method" id="cash" type="radio"> Cash On Delivery</label>
									</div>
								</div>
							</div>
							<!--/ End Order Widget -->
							  






							<!-- Button Widget -->
							<div class="single-widget get-button">
								<div class="content">
									<div class="button">
										<a href="#" class="btn">Confirm Transaction</a>
									</div>
								</div>
							</div>
							<!--/ End Button Widget -->
						</div>
					</div> --}}
				</div>
			</div>
		</section>
		<!--/ End Checkout -->
		
		<!-- Start Shop Services Area  -->
		<section class="shop-services section home">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Service -->
						<div class="single-service">
							<i class="ti-rocket"></i>
							<h4>Free shiping</h4>
							<p>Orders over $100</p>
						</div>
						<!-- End Single Service -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Service -->
						<div class="single-service">
							<i class="ti-reload"></i>
							<h4>Free Return</h4>
							<p>Within 30 days returns</p>
						</div>
						<!-- End Single Service -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Service -->
						<div class="single-service">
							<i class="ti-lock"></i>
							<h4>Sucure Payment</h4>
							<p>100% secure payment</p>
						</div>
						<!-- End Single Service -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Service -->
						<div class="single-service">
							<i class="ti-tag"></i>
							<h4>Best Peice</h4>
							<p>Guaranteed price</p>
						</div>
						<!-- End Single Service -->
					</div>
				</div>
			</div>
		</section>
		<!-- End Shop Services -->
		
		<!-- Start Shop Newsletter  -->
		<section class="shop-newsletter section">
			<div class="container">
				<div class="inner-top">
					<div class="row">
						<div class="col-lg-8 offset-lg-2 col-12">
							<!-- Start Newsletter Inner -->
							<div class="inner">
								<h4>Newsletter</h4>
								<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
								<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
									<input name="EMAIL" placeholder="Your email address" required="" type="email">
									<button class="btn">Subscribe</button>
								</form>
							</div>
							<!-- End Newsletter Inner -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Shop Newsletter -->
   

 

    @section('footers')
        <!-- jquery.steps js -->
        {{-- <script src='https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js'></script> --}}
        <script src="{{ asset('dist/js/jquery.validate.js') }}"></script>
        <script src="{{ asset('dist/js/jquery.steps.js') }}"></script>
        <script src="{{ asset('dist/js/particles.js') }}"></script>

  

        <script>
            var form = $("#form_wizard").show();
            form.steps({
                headerTag: "h3",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Allways allow previous action even if the current form is not valid!
                    if (currentIndex > newIndex)
                    { return true; }
                    // Forbid next action on "third" step.
                    // if (newIndex === 3 ) { return false; }
        
                    // Needed in some cases if the user went back (clean up)
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        form.find(".body:eq(" + newIndex + ") label.error").remove();
                        form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                    }
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                    //return true;
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Used to skip the "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        form.steps("next");
                    }
                    // Used to skip the "third" step.
                    // if (currentIndex === 2 && priorIndex === 3)  { form.steps("previous");  }
                },
                onFinishing: function (event, currentIndex)
                {
                    form.validate().settings.ignore = ":disabled";
                    return form.valid();   
                },
                onFinished: function (event, currentIndex)
                {  
                    // $("a[href='#finish']").click(function (e) { e.preventDefault();  form.submit(); });
                    // $("a[href='#finish']").click(function (e) {  });
                  var first_name = $("#first_name").val();
                  if(first_name == '') {
                    $('#error_msg').show();
                    $('#error_msg').html('All the required fields must be filled');
                } else{
                    $('#error_msg').hide();
        
                    $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $("input[name=_token]").val()
                          }
                      });
                      // url: '{{ url("/agent") }}',
                    $.ajax({
                        type: 'post',
                        url: '',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function() { 
                            $('#form_wizard').css("opacity",".5"); 
                        },
                        success: function(response){   var error_msg='';
                            $('#error_msg').show(); 
                            for (const key of Object.keys(response)){
                                 console.log(key, response[key]);
                                error_msg += (' <div class="alert alert-success mb-1" style="font-size:14px;">'+response[key]+'</div>');
                            }
                            $('#error_msg').html(error_msg);
                            $('#form_wizard').css("opacity","");  
                            fetch_saved_data();
                        }
                    });
                }
        
        
                // ----------------------------------------------------- //
        
                }
            }).validate({
                errorPlacement: function errorPlacement(error, element) { element.before(error); },
                rules: {
                    confirm: {
                        equalTo: "#password"
                    }
                }
            });
        
        
        
        
        //-----------------------   SOME FREE GAP -----------------------// 
            $('#form_wizard').on('submit', function(e){
                e.preventDefault(); 
            }); 
        //----------------------     SOME FREE GAP    --------------------//  
        



 
            $(document).ready(function(){
                
                        // DAILY
                $('#duration').change(function(){
                        var freqs= $('#freqs').val();
                        var duration=$('#duration').val();
                        var amt=$('#amt').val();
                        var tot=$('#tot').val();
                        
                        
                        
                
                        // for weekly
                        if (freqs=='weekly' && duration=='2') {
                        var amt1=Math.round(amt/8);
                        $('#tot-text').html(freqs + ' '+"pay" + ':');
                        $('#tot').val(amt1);
                        $('#limit').val('8');
                        
                        }
                        if (freqs=='weekly' && duration=='3') {
                        var amt1=Math.round(amt/12);
                        $('#tot-text').html(freqs + ' '+"pay" + ':');
                        $('#tot').val(amt1);
                        $('#limit').val('12');
                        
                        }
                        if (freqs=='weekly' && duration=='4') {
                        var amt1=Math.round(amt/16);
                        $('#tot-text').html(freqs + ' '+"pay" + ':');
                        $('#tot').val(amt1);
                        $('#limit').val('16');
                        }
                
                        // for daily 
                        if (freqs=='daily' && duration=='2') {
                        var amt1=Math.round(amt/60);
                        $('#tot-text').html(freqs + ' '+"pay" + ':');
                        $('#tot').val(amt1);
                        $('#limit').val('60');
                        
                        }
                        if (freqs=='daily' && duration=='3') {
                        var amt1=Math.round(amt/90);
                        $('#tot-text').html(freqs + ' '+"pay" + ':');
                        $('#tot').val(amt1);
                        $('#limit').val('90');
                        
                        }
                        if (freqs=='daily' && duration=='4') {
                        var amt1=Math.round(amt/120);
                        $('#tot-text').html(freqs + ' '+"pay" + ':');
                        $('#tot').val(amt1);
                        $('#limit').val('120');
                        }
                
                        //for monthly
                        if (freqs=='monthly' && duration=='2') {
                        var amt1=Math.round(amt/2);
                        $('#tot-text').html(freqs + ' '+"pay" + ':');
                        $('#tot').val(amt1);
                        $('#limit').val('2');
                        }
                        if (freqs=='monthly' && duration=='3') {
                        var amt1=Math.round(amt/3);
                        $('#tot-text').html(freqs + ' '+"pay" + ':');
                        $('#tot').val(amt1);
                        $('#limit').val('3');
                        }
                        if (freqs=='monthly' && duration=='4') {
                        var amt1=Math.round(amt/4);
                        $('#tot-text').html(freqs + ' '+"pay" + ':');
                        $('#tot').val(amt1);
                        $('#limit').val('4');
                        }
                
                        // if(tot==' '){
                        //   //$('#btn').attr('disabled','disabled');
                        //   alert(tot);
                        // }else{
                        //   $('#btn').removeAttr('disabled');
                        // }
                        });
                
                        $('#freqs').change(function(){
                        if(duration!=''){
                        $('#duration').val('');
                        $('#tot-text').html("Total pay" + ':');
                        $('#tot').val('');
                        }
                });




                function summary(){
        var freq=document.getElementById('freqs').value;
      var durations=document.getElementById('duration').value;
     var pay=document.getElementById('tot').value;
     //scroll to the top on mobile view
      jQuery('html,body').animate({scrollTop:0});

      document.getElementById('sfreq').innerHTML=freq;
      document.getElementById('sduration').innerHTML=durations + "months";
      document.getElementById('stot').innerHTML=pay;

      
      }

      function summary2(){
          
      var fullname= document.getElementById('fname').value;
      var phone=document.getElementById('phone').value;
      var email= document.getElementById('email').value;
      var username= document.getElementById('username').value;

      //scroll to the top on mobile view
      jQuery('html,body').animate({scrollTop:0});

      document.getElementById('sname').innerHTML=fullname;
      document.getElementById('sphone').innerHTML=phone;
      document.getElementById('semail').innerHTML=email;
      document.getElementById('susername').innerHTML=username;
      }
                
            });
        </script> 
    @endsection

@endsection

