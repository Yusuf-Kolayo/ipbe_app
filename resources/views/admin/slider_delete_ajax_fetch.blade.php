<div class="row ">
        <div class="col-lg-12 text-center">
          <img src="{{asset('storage/uploads/assets/'.$store_slider->background)}}" class="img mx-auto mb-2" width="150px" />
          <input type="hidden" value="{{$store_slider->slider_id}}" required name="slider_id"/> 
        </div>

         <div class="col-lg-12 text-center">
              <p class="mb-0">ID : {{get_position($store_slider->position)}}</p>
              <p class="mb-0">Slider Link Text : {{$store_slider->link_text}}</p>
              <p class="mb-0 link_url">Slider Link URL : {{$store_slider->link_url}}</p>
          </div>
 
</div>

<hr>
<div class="row">
<div class="col-lg-12" style="border: 2px solid rgb(218 218 218 / 56%);">
<h6 class="mb-0 text-center" style="padding: 3px; background-color: rgb(218 218 218 / 56%);">Text Contents</h6>
<div class="pt-4" style="width: 80%;margin: 0 auto;text-align: center;">


  
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
</div>
</div>
 

<div class="row">   
    <div class="col-lg-12">
        <div class="modal-footer p-0 pt-2">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-danger" value="Confirm Delete" name="delete_slider"/>
        </div>
    </div>
</div>