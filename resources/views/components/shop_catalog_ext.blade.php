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
        <script>

        function get_checked_price_ranges () {
            var price_ranges = [];
            let inputs = document.getElementsByClassName('price_range');     console.log(inputs);
            let inputs_arr = Array.from(inputs);   
                for (var item of inputs_arr) {
                    if (item.checked===true) { price_ranges.push(item.value);  } 
                }
            return price_ranges;
        }





        $('#select_ordering').change(function() { //   console.log($(this).val());
            var ordering = $(this).val(); 	var fetch_id = $('#fetch_id').val();  var fetch_mode = $('#fetch_mode').val();
            var price_ranges = get_checked_price_ranges();

            var data2send={'ordering':ordering,'fetch_id':fetch_id, 'fetch_mode': fetch_mode, 'price_ranges': price_ranges};       console.log(data2send);
            $('#product_ready_div').html('<div class="text-center p-1 bg-white"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') } });
            $.ajax({
                url:"{{ route('shop.fetch_catalog_ajax') }}",
                dataType:"text",
                method:"GET",
                data:data2send,
                success:function(resp) {
                    $('#product_ready_div').html(resp);
                }
            }); 
        });



        
        function fetch_next (current_page) { 
            var ordering   = $('#select_ordering').val();	     var page = current_page + 1;
            var fetch_id = $('#fetch_id').val();  var fetch_mode = $('#fetch_mode').val();       
            var price_ranges = get_checked_price_ranges();

            var data2send={'ordering':ordering,'fetch_id':fetch_id, 'fetch_mode': fetch_mode, 'price_ranges': price_ranges, 'page':page};  


        $('#product_ready_div').html('<div class="text-center p-1 bg-white"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
            url:"{{ route('shop.fetch_catalog_ajax') }}",
            dataType:"text",
            method:"GET",
            data:data2send,
            success:function(resp) { $('#product_ready_div').html(resp); }
        }); 
        }


        function fetch_prev (current_page) { 
        var ordering   = $('#select_ordering').val();	  var page = current_page - 1;  
        var fetch_id = $('#fetch_id').val();  var fetch_mode = $('#fetch_mode').val();       
        var price_ranges = get_checked_price_ranges();

            var data2send={'ordering':ordering,'fetch_id':fetch_id, 'fetch_mode': fetch_mode, 'price_ranges': price_ranges, 'page':page};  

        $('#product_ready_div').html('<div class="text-center p-1 bg-white"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
            url:"{{ route('shop.fetch_catalog_ajax') }}",
            dataType:"text",
            method:"GET",
            data:data2send,
            success:function(resp) { $('#product_ready_div').html(resp); }
        }); 
        }




        $('.checkbox-inline').change(function() {
            var price_ranges=[];
            $("input").each(function() {
                if ($(this).is(':checked')) {
                //   var checked = ($(this).val());
                //   price_ranges.push(checked);
                    price_ranges.push(this.value); 
                }  
            });  console.log(price_ranges); 

            var ordering   = $('#select_ordering').val();	     var fetch_id = $('#fetch_id').val();  var fetch_mode = $('#fetch_mode').val(); 
            // var price_ranges = get_checked_price_ranges();

            var data2send={'ordering':ordering,'fetch_id':fetch_id, 'fetch_mode': fetch_mode, 'price_ranges': price_ranges};  


        $('#product_ready_div').html('<div class="text-center p-1 bg-white"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
            url:"{{ route('shop.fetch_catalog_ajax') }}",
            dataType:"text",
            method:"GET",
            data:data2send,
            success:function(resp) { $('#product_ready_div').html(resp); }
        }); 

        });

        </script>
@endsection