@if ($store_slider->type=='default')  

        @php
        if (count($store_slider->slider_content)>0) {
            foreach ($store_slider->slider_content as $slider_content) {
                if ($slider_content->type=='fl')       
                {  $fl_p = $slider_content->position;   $fl_t = $slider_content->content;  }
                if ($slider_content->type=='sl')  
                {  $sl_p = $slider_content->position;   $sl_t = $slider_content->content;  }
                if ($slider_content->type=='tl')   
                {  $tl_p = $slider_content->position;   $tl_t = $slider_content->content;}
                if ($slider_content->type=='html')   
                {  } 
            }
        }
        @endphp

     
    

            <div class="row ">
                    <div class="col-lg-12 text-center">
                        <img src="{{asset('storage/uploads/assets/'.$store_slider->background)}}" class="img mx-auto mb-2" width="150px" />
                        <input type="hidden" value="{{$store_slider->slider_id}}" required name="slider_id"/> 
                        <input type="hidden" value="{{$store_slider->type}}" required name="type"/> 
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label> New Background (optional)</label>
                            <input type="file" class="form-control" name="background"/> 
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>  ID </label>
                            <select name="bg_position" id="" class="form-control">
                            <option value="{{$store_slider->position}}">{{get_position($store_slider->position)}}</option> 
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
                        <label> Heading </label>
                            <input type="text" class="form-control" value="{{$sl_t}}" required name="sl_t"/>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>  ID </label>
                            <select name="sl_p" id="sl_p" class="form-control">
                            <option value="{{$sl_p}}">{{get_position($sl_p)}}</option> 
                            <option value="1">1st</option>     <option value="2">2nd</option>
                            <option value="3">3rd</option>     <option value="4">4th</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-6">
                    <div class="form-group">
                        <label>  Sub Heading </label>
                        <input type="text" class="form-control" value="{{$fl_t}}" required name="fl_t"/>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label>  ID </label>
                        <select name="fl_p" id="" class="form-control">
                        <option value="{{$fl_p}}">{{get_position($fl_p)}}</option>
                        <option value="1">1st</option>     <option value="2">2nd</option>
                        <option value="3">3rd</option>     <option value="4">4th</option>
                        </select>
                    </div>
                </div>



                    <div class="col-lg-6">
                        <div class="form-group">
                        <label> Paragraph </label>
                            <input type="text" class="form-control" value="{{$tl_t}}" required name="tl_t"/>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>  ID </label>
                            <select name="tl_p" id="tl_p" class="form-control">
                            <option value="{{$tl_p}}">{{get_position($tl_p)}}</option> 
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
                        <label>  Banner Link Text </label>
                        <input type="text" class="form-control" value="{{$store_slider->link_text}}" required name="bl_t"/>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                        <label>  Banner Link URL </label>
                        <input type="text" class="form-control"  value="{{$store_slider->link_url}}"  required name="bl_u"/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="modal-footer p-0 pt-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Submit" name="update_banner"/>
                        </div>
                    </div>
            </div>

   


@elseif ($store_slider->type=='html') 

             
    

          <div class="row ">
                  <div class="col-lg-12 text-center">
                        <img src="{{asset('storage/uploads/assets/'.$store_slider->background)}}" class="img mx-auto mb-2" width="150px" />
                        <input type="hidden" value="{{$store_slider->slider_id}}" required name="slider_id"/> 
                        <input type="hidden" value="{{$store_slider->type}}" required name="type"/> 
                  </div>
          
                   <div class="col-lg-6">
                        <div class="form-group">
                            <label> New Background (optional)</label>
                            <input type="file" class="form-control" name="background"/> 
                         </div>
                    </div>
          
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>  ID </label>
                            <select name="bg_position" id="" class="form-control">
                            <option value="{{$store_slider->position}}">{{get_position($store_slider->position)}}</option> 
                            <option value="1">1st</option>     <option value="2">2nd</option>
                            <option value="3">3rd</option>     <option value="4">4th</option>
                            </select>
                         </div>
                    </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label>  Banner Link Text </label>
                        <input type="text" class="form-control" value="{{$store_slider->link_text}}" required name="bl_t"/>
                    </div>
                </div>
     
                <div class="col-lg-6">
                    <div class="form-group">
                    <label>  Banner Link URL </label>
                    <input type="text" class="form-control"  value="{{$store_slider->link_url}}"  required name="bl_u"/>
                    </div>
                </div>
          </div>
          
        <hr>
        <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                    <label>  Text Contents </label> 
                    <textarea name="html_content">{!!$store_slider->slider_content[0]->content!!}</textarea>
                </div>
                </div>
        
        
        
                <div class="col-lg-12">
                    <div class="modal-footer p-0 pt-2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Submit" name="update_banner"/>
                </div>
                    </div>
        </div>
          
   

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
            min_height: 400
            });
        </script>
         

 
@elseif ($store_slider->type=='picture') 

    

          <div class="row ">
                  <div class="col-lg-12 text-center">
                        <img src="{{asset('storage/uploads/assets/'.$store_slider->background)}}" class="img mx-auto mb-2" width="150px" />
                        <input type="hidden" value="{{$store_slider->slider_id}}" required name="slider_id"/> 
                        <input type="hidden" value="{{$store_slider->type}}" required name="type"/> 
                  </div>
          
                   <div class="col-lg-6">
                        <div class="form-group">
                            <label> New Background (optional)</label>
                            <input type="file" class="form-control" name="background"/> 
                         </div>
                    </div>
          
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>  ID </label>
                            <select name="bg_position" id="" class="form-control">
                            <option value="{{$store_slider->position}}">{{get_position($store_slider->position)}}</option> 
                            <option value="1">1st</option>     <option value="2">2nd</option>
                            <option value="3">3rd</option>     <option value="4">4th</option>
                            </select>
                         </div>
                    </div>

                    <div class="col-lg-6">
                    <div class="form-group">
                    <label>  Banner Link Text </label>
                    <input type="text" class="form-control" value="{{$store_slider->link_text}}" required name="bl_t"/>
                    </div>
                </div>
     
                <div class="col-lg-6">
                    <div class="form-group">
                    <label>  Banner Link URL </label>
                    <input type="text" class="form-control"  value="{{$store_slider->link_url}}"  required name="bl_u"/>
                    </div>
                </div>
          </div>
          
          <hr>
          <div class="row"> 
          
                    <div class="col-lg-12">
                        <div class="modal-footer p-0 pt-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Submit" name="update_banner"/>
                    </div>
                     </div>
            </div>
          
   

@endif