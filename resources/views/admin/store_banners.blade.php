@extends('layouts.main')
@section('headers')
<style> 
    .card-inner {   padding: 3px!important;   }  .card-preview {  border: 0px;  }
    .form-group { padding-bottom:12px;}
    label { margin-bottom: 5px; }
    .link_url { word-wrap: break-word; font-family: fangsong, 'Nunito'; }
    </style>
    <script src="https://cdn.tiny.cloud/1/dzpx60hu7y4x9nzhth1ludx0xo3ygkl5iz2hgad6itpuf2dp/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
@section('content')
     
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid"> 

            <div class="card card-header"> 
                  <h5 class="mb-0"><em class="icon ni ni-img-fill"></em> Banner updates</h5>  
            </div>

 


            <div class="card card-preview p-3">
                <div class="card-inner">

              

                    <ul class="nav nav-tabs mt-n3">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabItem5"> <em class="icon ni ni-edit-alt"></em><span>Text-Editor Template</span> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabItem6"> <em class="icon ni ni-text-rich"></em><span>Default Template</span> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabItem7"><em class="icon ni ni-laptop"></em><span>Picture Template</span></a>
                        </li>
                       
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabItem5">
                            
                    {!! Form::open(['route' => ['frontstore.create_html_banner'], 'method'=>'POST', 'files' => true]) !!}

                            <div class="row ">
                                <div class="col-lg-6">
                                <div class="form-group">
                                <label>  Background Image </label>
                                <input type="file" class="form-control" required name="background"/> 
                                </div>
                                </div>

                                <div class="col-lg-6">
                                <div class="form-group">
                                <label>  ID </label>
                                <select name="bg_position" id="bg_position" class="form-control">
                                <option value="1">1st</option>     <option value="2">2nd</option>
                                <option value="3">3rd</option>     <option value="4">4th</option>
                                </select>
                                </div>
                                </div>

                                <div class="col-lg-6">
                                <div class="form-group">
                                <label>  Slider Link Text </label>
                                <input type="text" class="form-control" required name="bl_t" id="bl_t"/>
                                </div>
                                </div>

                                <div class="col-lg-6">
                                <div class="form-group">
                                <label>  Slider Link URL </label>
                                <input type="text" class="form-control" required name="bl_u" id="bl_u"/>
                                </div>
                                </div>
                                </div>


                                <hr>

                                <div class="row"> 
                                <div class="col-md-12">
                                <div class="form-group">
                                <label>  Text Contents </label>
                                <textarea name="html_content">  </textarea>
                                </div>
                                </div>


                                <div class="col-lg-12">
                                <div class="modal-footer" style="border-top: 0px;"> 
                                <input type="submit" class="btn btn-primary" value="Submit" name="submit_html_slider"/>
                                </div>
                                </div>
                            </div>

                    {!! Form::close() !!}


                                                    </div>
                                                    <div class="tab-pane" id="tabItem6">
                                                    
                    {!! Form::open(['route' => ['frontstore.create_default_banner'], 'method'=>'POST', 'files' => true]) !!}


                            <div class="row ">
                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  Background Image </label>
                            <input type="file" class="form-control" required name="background"/> 
                            </div>
                            </div>

                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  ID </label>
                            <select name="bg_position" id="bg_position" class="form-control">
                            <option value="1">1st</option>     <option value="2">2nd</option>
                            <option value="3">3rd</option>     <option value="4">4th</option>
                            </select>
                            </div>
                            </div>
                            </div>

                            <hr>
                            <div class="row">

                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  Heading </label>
                            <input type="text" class="form-control" required name="sl_t"/>
                            </div>
                            </div>

                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  ID </label>
                            <select name="sl_p" id="sl_p" class="form-control">
                            <option value="1">1st</option>     <option value="2">2nd</option>
                            <option value="3">3rd</option>     <option value="4">4th</option>
                            </select>
                            </div>
                            </div>


                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  Sub Heading </label>
                            <input type="text" class="form-control" required name="fl_t"/>
                            </div>
                            </div>

                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  ID </label>
                            <select name="fl_p" id="fl_p" class="form-control">
                            <option value="1">1st</option>     <option value="2">2nd</option>
                            <option value="3">3rd</option>     <option value="4">4th</option>
                            </select>
                            </div>
                            </div>




                            <div class="col-lg-6">
                            <div class="form-group">
                            <label> Paragraph </label>
                            <input type="text" class="form-control" required name="tl_t"/>
                            </div>
                            </div>

                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  ID </label>
                            <select name="tl_p" id="tl_p" class="form-control">
                            <option value="1">1st</option>     <option value="2">2nd</option>
                            <option value="3">3rd</option>     <option value="4">4th</option>
                            </select>
                            </div>
                            </div> 

                            </div>
                            <hr>

                            <div class="row"> 
                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  Slider Link Text </label>
                            <input type="text" class="form-control" required name="bl_t" id="bl_t"/>
                            </div>
                            </div>

                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  Slider Link URL </label>
                            <input type="text" class="form-control" required name="bl_u" id="bl_u"/>
                            </div>
                            </div>

                            <div class="col-lg-12">
                            <div class="modal-footer" style="border-top: 0px;"> 
                            <input type="submit" class="btn btn-primary" value="Submit" name="submit_default_slider"/>
                            </div>
                            </div>
                            </div>


                        {!! Form::close() !!}
                                                    </div>



                                                    <div class="tab-pane" id="tabItem7">

                        {!! Form::open(['route' => ['frontstore.create_picture_banner'], 'method'=>'POST', 'files' => true]) !!}

                            <div class="row ">
                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  Background Image </label>
                            <input type="file" class="form-control" required name="background"/> 
                            </div>
                            </div>

                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  ID </label>
                            <select name="bg_position" id="bg_position" class="form-control">
                            <option value="1">1st</option>     <option value="2">2nd</option>
                            <option value="3">3rd</option>     <option value="4">4th</option>
                            </select>
                            </div>
                            </div>

                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  Slider Link Text </label>
                            <input type="text" class="form-control" required name="bl_t" id="bl_t"/>
                            </div>
                            </div>

                            <div class="col-lg-6">
                            <div class="form-group">
                            <label>  Slider Link URL </label>
                            <input type="text" class="form-control" required name="bl_u" id="bl_u"/>
                            </div>
                            </div>
                            </div>



                            <div class="row">  

                            <div class="col-lg-12">
                            <div class="modal-footer" style="border-top: 0px;"> 
                            <input type="submit" class="btn btn-primary" value="Submit" name="submit_picture_slider"/>
                            </div>
                            </div>
                            </div>

                        {!! Form::close() !!}
                        </div>
                        
                    </div>
                </div>
            </div><!-- .card-preview -->












            <div class="card card-bordered">
 
                <div class="card-header border-bottom">  
                    <h5 class="" style="display:inline;"> Current Sliders </h5>  
                </div>
        
        
        
                <div class="card-inner table-responsive">
                     <!-- START START START -->
                             
        
                         
                    <table class="table" style="width:100%">
                                 <thead> 
                                    <tr> 
                                    <th width="5%">ID</th> 
                                    <th width="15%">Background</th> 
                                    <th width="5%">Link Text</th> 
                                    <th width="25%">Link URL</th> 
                                    <th width="40%">Text Contents</th> 
                                    <th width="10%">Actions</th> 
                                    </tr>
                                 </thead> 
            
                                 <tbody>
                                     
                            @foreach ($store_sliders as $store_slider)
                                         
                                     @php
                                         if ($store_slider->status=='active') { $bt_status = 'checked'; }  else { $bt_status = ''; }
                                     @endphp
                                             <tr>
                                             <td>{{$store_slider->position}}</td>
                                             <td> <img class="img img-fluid" src="{{asset('storage/uploads/assets/'.$store_slider->background)}}"/></td>
                                             <td>{{$store_slider->link_text}}</td>
                                             <td><div style="width:180px;word-wrap: break-word;">{{$store_slider->link_url}}</div></td>
                                             <td> 
                                                 {{-- @php
                                                     if (count($store_slider->slider_content)==0) { dd($store_slider->slider_content); }
                                                 @endphp --}}
                                                
                                                <div class="mb-0">
                                                    @if (count($store_slider->slider_content)>0)
                                                        @foreach ($store_slider->slider_content as $slider_content)
                                                        @if ($slider_content->type=='fl')       {{-- if first level text --}}
                                                        <h4 class="mb-0" style="font-size:18px"> {{$slider_content->content}}</h4>
                                                        @elseif ($slider_content->type=='sl')   {{-- if second level text --}}
                                                        <h1 class="mb-0" style="font-size:29px">{{$slider_content->content}}</h1>
                                                        @elseif ($slider_content->type=='tl')   {{-- if third level text --}}
                                                        <p class="mb-0">{{$slider_content->content}}</p>
                                                        @elseif ($slider_content->type=='html')   
                                                        <div class="mb-0">{!!$slider_content->content!!}</div>
                                                        @endif 
                                                        @endforeach
                                                    @endif 

                                                        @if ($store_slider->type=='picture')
                                                                <p class="mb-0"> <b>NONE</b> </p>
                                                        @endif 
                                                </div>  
                                              

                                             </td>
                                             <td style="text-align:center;"> 
                                             
                                         <div class="custom-control custom-switch mr-n2 mb-2" data-toggle="tooltip" data-placement="top" title="Activate & De-activate slider">
                                             <input type="checkbox" {{$bt_status}} class="custom-control-input" onclick="switch_slider('{{$store_slider->slider_id}}')" id="{{$store_slider->slider_id}}">
                                             <label class="custom-control-label" for="{{$store_slider->slider_id}}"></label>
                                         </div>
        
                                             <button class="btn btn-primary btn-sm m-1 mb-2" onClick="update_banner_modal('{{$store_slider->slider_id}}')">Update</button>  
                                             <button class="btn btn-danger btn-sm m-1" onClick="delete_banner_modal('{{$store_slider->slider_id}}')" >Delete</button> </td>
                                </tr> 
                         
                            @endforeach
        
                      </tbody>
                    </table>
                        
                            
        
        
                    <!-- END END END -->
                    </div>
                </div>
        </div><!-- /.container-fluid -->
      </section>






      

<!-- UPDATE BANNER MODAL -->
<div class="modal fade" id="update_banner_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"> 
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="display:inline;" id="exampleModalLabel"> Update Slider </h5>
          <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        {!! Form::open(['route' => ['frontstore.update_banner_post'], 'method'=>'POST', 'files' => true]) !!}
          <div class="modal-body" id="update_ready_div"> </div>
        {!! Form::close() !!} 
        
       </div> 
    </div>
  </div>
  
  
  <!-- DELETE BANNER MODAL -->
  <div class="modal fade" id="delete_banner_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="display:inline;" id="exampleModalLabel"> Delete Slider</h5>
  
          <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
  
          <p class="mb-0" style="font-size:15px;">Are you sure to delete this slider ? </p> 
        </div>

        {!! Form::open(['route' => ['frontstore.delete_banner_post'], 'method'=>'POST', 'files' => true]) !!}
           <div class="modal-body" id="delete_ready_div"> </div>
        {!! Form::close() !!} 
        
      </div> 
    </div>
  </div>
  





    @section('page_scripts')
        <script>
            // TINYMCE RICH TEXT EDITOR
            tinymce.init({
            selector: 'textarea',
            plugins: 'link autolink preview',
            toolbar: 'checklist code undo redo preview | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
            toolbar_mode: 'floating', 
            min_height: 300
            });




             // UPDATE BANNER MODAL
function update_banner_modal(val) {
        $('#update_banner_modal').modal('show');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $('#update_ready_div').html('<div class="text-center mt-5 mb-5"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>');
        $.ajax({
			type:'get',
			url:'{{route("frontstore.update_banner_fetch")}}',
			data: 'slider_id='+ val, 

			success:function(data) {
			    $('.verify').show();
				$('#update_ready_div').html(data);  
			}
	    }); 
    }




     // DELETE BANNER MODAL
function delete_banner_modal(val) {
        $('#delete_banner_modal').modal('show');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $('#delete_ready_div').html('<div class="text-center mt-5 mb-5"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>');
        $.ajax({
			type:'get',
			url:'{{route("frontstore.delete_banner_fetch")}}',
			data: 'slider_id='+ val, 

			success:function(data) {
			    $('.verify').show();
				$('#delete_ready_div').html(data);  
			}
	    }); 
    }
   



    // SWITCH SLIDER ON/OFF

function switch_slider(slider_id)   {
	       
        var checkattr=$('#'+slider_id).prop('checked');   
        if(checkattr==false)    {   var act_log = 'yes';    }  else {   var act_log = 'no';     }

         var filters = {"slider_id":slider_id}; 
           $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
           $.ajax({
                       type: 'POST',
                       url: '{{route("frontstore.switch_slider")}}',
                       data: filters,
                       dataType: 'json', 
                       // beforeSend: function() {  
                       // },
                       success: function(response) {    console.log(response.status);

                    //    if(response.status == '1')         {   $('#act_log_en').hide();   $('#act_log_ds').show();    }
                    //    else if (response.status == '11')  {   $('#act_log_en').show();   $('#act_log_ds').hide();    }   
                   }   
            });

   }
        </script>
    @endsection

 
 

@endsection
