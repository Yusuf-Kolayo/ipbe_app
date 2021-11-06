
<!-- UPDATE BANNER MODAL -->
@admin
  <div class="modal fade" id="update_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="" role="document" id="update_ready_div">
      <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>   
    </div>
  </div>



  <!-- DELETE BANNER MODAL -->
  <div class="modal fade" id="delete_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="" role="document" id="delete_ready_div">
         <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div> 
    </div>
  </div>

  

   {{-- SELECT PRODUCT PURCHASE MODAL  --}} 
   <div class="modal fade" id="select_pps_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog medium_modal" style="" role="document" id="pps_ready_div">
    
      <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>  
    
    </div>
   </div> 
  
  
  
  
  {{-- DELETE PRODUCT PURCHASE MODAL  --}} 
  <div class="modal fade" id="delete_pps_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog medium_modal" style="" role="document" id="delete_pps_ready_div">
    
      <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>  
    
    </div>
  </div> 
  



  <script>
          // SELECT PRODUCT MODAL
    function select_pps_modal(pps_id) { 
      $('#pps_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        $('#select_pps_modal').modal('show');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });

        $.ajax({
        type:'GET',
        url:"{{ route('client.pps_details_ajax_fetch') }}",
        data: {"pps_id":pps_id },

          success:function(data) {
            $('.verify').show();
            $('#pps_ready_div').html(data);  
          }
        }); 
     }




    // DELEET PRODUCT MODAL
    function delete_pps_modal(pps_id) { 
      $('#delete_pps_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        $('#delete_pps_modal').modal('show');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });

        $.ajax({
        type:'GET',
        url:"{{ route('client.pps_delete_ajax_fetch') }}",
        data: {"pps_id":pps_id },

          success:function(data) {
            $('.verify').show();
            $('#delete_pps_ready_div').html(data);  
          }
        }); 
     }
  </script>
  
  
@endadmin





 




{{-- SELECT PRODUCT MODAL  --}}
@agent
<div class="modal fade" id="select_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" style="display:inline;font-size: 17px!important;font-weight: 400!important;"
          id="exampleModalLabel"> Are you sure the customer wants the above product? </h6>
        <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['route' => ['client.select_client'], 'method'=>'get', 'files' => false, 'id'=>'product_select_form', ]) !!} 
        <div class="modal-body" id="select_ready_div">
          <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>   
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit" name="update_product_btn" >Confirm</button>
        </div>
      {!! Form::close() !!} 
    </div> 
  </div>
</div>
@endagent



 
@section('page_scripts')
<script>  
       
          $('#brand_select').change(function() {  
              var brand_id = $(this).val();    var cat_id = $('#cat_id').val();  var page = {{$products->currentPage()}}; // console.log(cat_id);
              var data2send={'brand_id':brand_id, 'cat_id':cat_id, 'page':page};  
              $('#data_box').html('<div class="text-center mt-3 p-4 bg-white border rounded"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');
              $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
              $.ajax({
                  url:"{{ route('fetch_product_by_brand') }}",
                  dataType:"text",
                  method:"GET",
                  data:data2send,
                  success:function(resp) { $('#data_box').html(resp); }
            }); 
          } );



          function fetch_next (current_page) {
              var brand_id = $('#brand_select').val();    var cat_id = $('#cat_id').val();  var page = current_page + 1; // console.log(cat_id);
              var data2send={'brand_id':brand_id, 'cat_id':cat_id, 'page':page};  

              $('#data_box').html('<div class="text-center mt-3 p-4 bg-white border rounded"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');
              $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
              $.ajax({
                  url:"{{ route('fetch_product_by_brand') }}",
                  dataType:"text",
                  method:"GET",
                  data:data2send,
                  success:function(resp) { $('#data_box').html(resp); }
            }); 
          }


          function fetch_prev (current_page) {
              var brand_id = $('#brand_select').val();    var cat_id = $('#cat_id').val();  var page = current_page - 1; // console.log(cat_id);
              var data2send={'brand_id':brand_id, 'cat_id':cat_id, 'page':page};  

              $('#data_box').html('<div class="text-center mt-3 p-4 bg-white border rounded"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto preloader1" alt=""> </div>');
              $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
              $.ajax({
                  url:"{{ route('fetch_product_by_brand') }}",
                  dataType:"text",
                  method:"GET",
                  data:data2send,
                  success:function(resp) { $('#data_box').html(resp); }
            }); 
          }

@admin
   
      function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();    
          reader.onload = function(e) {
            $('#preview_img').attr('src', e.target.result);
          } 
          reader.readAsDataURL(input.files[0]);
        }
      } 
      $("#img_name").change(function() { readURL(this); }); 






      // FETCH SUB-CATEGORY INTO SELECT FIELD ON ADD PRODUCT FORM
      function fetch_sub_cat() {
          var main_cat_id = $('#main_category_id').val();
          var data2send={'main_cat_id':main_cat_id, 'element':'select'};  
          $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
          $.ajax({
              url:"{{ route('category.sub_cat_ajax_fetch') }}",
              dataType:"text",
              method:"GET",
              data:data2send,
              success:function(resp){
                  $('#sub_category_id').html(resp);
              }
        }); 
      }

    




    // UPDATE PRODUCT MODAL
     function update_product_modal(product_id) {   
      $('#update_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
          $('#update_product_modal').modal('show');  // window.stop();
          // $('#update_ready_div').html('');  
          var data2send={'product_id':product_id};  
          $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
          $.ajax({
              url:"{{ route('product.update_ajax_fetch') }}",
              dataType:"text",
              method:"GET",
              data:data2send,
              success:function(resp){
                  $('#update_ready_div').html(resp);
              }
        }); 
      }
  
  

      // DELETE PRODUCT MODAL
      function delete_product_modal(product_id) {
        $('#delete_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
          $('#delete_product_modal').modal('show'); 
          $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });

          $.ajax({
          type:'GET',
          url:"{{ route('product.show_details_ajax_fetch') }}",
          data: {"product_id":product_id },

            success:function(data) {
              $('.verify').show();
              $('#delete_ready_div').html(data);  
            }
          }); 
      }



    // SOME FREE GAP HERE PLS 
    


    
    // refresh product div after update 
    function refresh_product_div(product_id) {    
          var data2send={'product_id':product_id};  
          $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
          $.ajax({
              url:"{{ route('product.refresh_product_ajax_fetch') }}",
              dataType:"text",
              method:"GET",
              data:data2send,
              success:function(resp) {
                  $('#DIV-'+product_id).html(resp);
              }
        }); 
      }

  
        
    // delete product div after delete 
    function delete_product_div(product_id) {  $('#DIV-'+product_id).html('');  }



@else
 
    
      // SELECT PRODUCT MODAL
      function select_product_modal(product_id) {
        $('#select_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        $('#select_product_modal').modal('show');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
          
          $.ajax({
          type:'GET',
          url:"{{ route('product.show_details_ajax_fetch') }}",
          data: {"product_id":product_id },

              success:function(data) {
              $('.verify').show();
              $('#select_ready_div').html(data);  
            }
          }); 
      }
@endadmin 
</script>
@endsection