  <!-- Start Footer Area -->
	<footer class="footer">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo">
								<a href="index.html"><img src="{{ asset('storage/uploads/assets/'.$store_data['business_info']->logo) }}" alt="#"></a>
							</div>
							<p class="text">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue,  magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>
							<p class="call">Got Question? Call us 24/7<span><a href="tel:{{$store_data['business_info']->phone_a}}">{{$store_data['business_info']->phone_a}}</a></span></p>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Information</h4>
							<ul>
								<li><a href="#">About Us</a></li>
								<li><a href="#">Faq</a></li>
								<li><a href="#">Terms & Conditions</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Help</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Customer Service</h4>
							<ul>
								<li><a href="#">Payment Methods</a></li>
								<li><a href="#">Money-back</a></li>
								<li><a href="#">Returns</a></li>
								<li><a href="#">Shipping</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Get In Touch</h4>
							<!-- Single Widget -->
							<div class="contact">
								<ul>  
									<li>{{$store_data['business_info']->address_a}}</li>
									<li>{{$store_data['business_info']->address_b}}</li>
									<li>{{$store_data['business_info']->email_a}}</li>
									<li>{{$store_data['business_info']->email_b}}</li>
									<li>{{$store_data['business_info']->phone_a}}</li>
									<li>{{$store_data['business_info']->phone_b}}</li>
								</ul>
							</div>
							<!-- End Single Widget -->
							<ul>
								<li><a href="{{$store_data['business_info']->facebook_link}}"><i class="ti-facebook"></i></a></li>
								<li><a href="{{$store_data['business_info']->twitter_link}}"><i class="ti-twitter"></i></a></li>
								{{-- <li><a href="#"><i class="ti-flickr"></i></a></li> --}}
								<li><a href="{{$store_data['business_info']->instagram_link}}"><i class="ti-instagram"></i></a></li> 
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
    
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="#" target="_blank">{{$store_data['business_info']->name}}</a>  -  All Rights Reserved.</p>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="right">
								<img src="{{asset('assets/store/img/payment-method.png')}}" alt="#">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->
