@extends('layouts.main_shop')
@section('headers')
<style>
 .input_field {width:100%; height:45px; line-height:50px; margin-bottom:25px; background:#F6F7FB; border-radius:0px; border:none;}
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
								<li class="active"><a href="{{route('register_login')}}">Accounts</a></li>
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

				  <div class="container-fluid pb-2">
					<x-alerts /> 
				  </div>


				<div class="row"> 
					<div class="col-lg-5 col-12 p-1">
						<div class="checkout-form p-4" style="background-color:#ffc107;">
							<h2>Log in Here</h2>
							<p>Please log in to proceed if you already have an account.</p>
							<!-- Form -->
                            {!! Form::open(['route' => ['login_submit'], 'method'=>'POST', 'files' => false]) !!}
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Email address</label>
											<input class="input_field" type="text" name="email" placeholder="" required="required">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Password</label>
											<input class="input_field" type="password" name="password" required="required">
										</div>
									</div>
									 
									<div class="col-6">
										<div class="form-group create-account">
											<input id="cbox" type="checkbox">
											<label>Create an account?</label>
										</div>
									</div>

                                    <div class="col-6">
										 <button type="submit" class="btn btn-primary btn-block">Log In</button>
									</div>
								</div>
                            {!! Form::close() !!}
							<!--/ End Form -->
						</div>
					</div>
					<div class="col-lg-7 col-12 p-1">
						<div class="checkout-form p-4" style="background-color:#46b9eb;">
							<h2>Register Here</h2>
							<p>Please register in order to proceed if you don't have an account yet.</p>
							<!-- Form -->
                            {!! Form::open(['route' => ['register_submit'], 'method'=>'POST', 'files' => false]) !!}
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>First Name</label>
											<input class="input_field" type="text" name="first_name" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Last Name</label>
											<input class="input_field" type="text" name="last_name" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Email Address</label>
											<input class="input_field" type="email" name="email" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Phone Number</label>
											<input class="input_field" type="number" name="phone" placeholder="" required="required">
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Country</label>
											<select name="country" id="country">
												<option value="nigeria">Nigeria</option> 
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>State </label>
											<select name="state" id="state">
												{{-- <option value="divition" selected="selected">New Yourk</option> --}}
												<option>Lagos</option>
												<option>Ogun</option> 
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Address</label>
											<input class="input_field" type="text" name="address" placeholder="" required="required">
										</div>
									</div>  


									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Username</label>
											<input class="input_field" type="text" name="username" placeholder="" required="required">
										</div>
									</div>  

									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Password</label>
											<input class="input_field" type="password" name="password" placeholder="" required="required">
										</div>
									</div>  

									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Confirm Password</label>
											<input class="input_field" type="password" name="confirm_password" placeholder="" required="required">
										</div>
									</div>  
								</div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group create-account">
                                            <input id="cbox" type="checkbox">
                                            <label>Create an account?</label>
                                        </div>
                                    </div> 
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                                   </div>
                                </div> 
                            {!! Form::close() !!}
							<!--/ End Form -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Checkout -->
   


 
@endsection