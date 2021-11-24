<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Session;
use App\Models\Business_info;
use App\Models\Store_slider;
use App\Models\Slider_content;

class FrontstoreController extends BaseController
{
    
     public $title = 'frontstore';


    public function __construct() {
       $this->middleware('auth');
       parent::__construct(); 

    }



    // loads up the page that lists out all updates
    public function business_info ()
    { 

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }  

        $business_info = Business_info::where('id', '>', '0')->get()[0];
        return view('admin.business_info', compact('business_info'));
    }


        // loads up the page to update store banners, posters, sliders
        public function banners ()
        { 
    
            // if (!in_array($this->title, parent::app_sections_only())) {    
            //     return redirect()->route('access_denied'); 
            // }
    
            // if (auth()->user()->usr_type=='usr_admin') {
            //     if (!in_array(__FUNCTION__, parent::middleware_except())) {
            //         return redirect()->route('access_denied'); 
            //     }  
            // }  
    
            $store_sliders = Store_slider::orderBy('position', 'asc')->get();
            return view('admin.store_banners', compact('store_sliders'));
        }





        // this stores front-store identity info
        public function business_identity(Request $request)
        {
            // if (!in_array($this->title, parent::app_sections_only())) {    
            //     return redirect()->route('access_denied'); 
            // }
    
            // if (auth()->user()->usr_type=='usr_admin') {
            //     if (!in_array(__FUNCTION__, parent::middleware_except())) {
            //         return redirect()->route('access_denied'); 
            //     }  
            // }   
    
    
            
            $data = request()->validate([
                'name' => ['required', 'string'],
                'logo' => ['required', 'image'],
                'slogan' => ['nullable', 'string']
            ]); 
            
            $file = $request->file('logo');   
            $ogImage = Image::make($file);
            $originalPath = 'app/public/uploads/assets/';   $random_string = Str::random(10);  
            $filename = time().'-'. $random_string .'.'. $file->getClientOriginalExtension();
            $ogImage =  $ogImage->save(storage_path($originalPath.$filename));
    
    
            $insert = Business_info::updateOrCreate(
                ['id'=>'1'],
                ['name'=>$data['name'], 'logo'=>$filename, 'slogan'=>$data['slogan']]
            );
            
            $business_info = Business_info::where('id', '>', '0')->get()[0];
            return redirect()->route('frontstore.business_info', compact('business_info'))->with('success', 'Front-store updated successfully.');
        }




        // this stores front-store identity info
        public function business_contacts (Request $request)
        {
            // if (!in_array($this->title, parent::app_sections_only())) {    
            //     return redirect()->route('access_denied'); 
            // }
    
            // if (auth()->user()->usr_type=='usr_admin') {
            //     if (!in_array(__FUNCTION__, parent::middleware_except())) {
            //         return redirect()->route('access_denied'); 
            //     }  
            // }   
    
        
            
            $data = request()->validate([
                'email_a' => ['required', 'string'],
                'email_b' => ['nullable', 'string'],
                'phone_a' => ['required', 'string'],
                'phone_b' => ['nullable', 'string'],
                'address_a' => ['required', 'string'],
                'address_b' => ['nullable', 'string'],
                'facebook_link' => ['nullable', 'string'],
                'twitter_link' => ['nullable', 'string'],
                'instagram_link' => ['nullable', 'string']
            ]); 
            
             
            $insert = Business_info::updateOrCreate(
                ['id'=>'1'],
                [
                    'email_a'=>$data['email_a'], 'email_b'=>$data['email_b'], 'phone_a'=>$data['phone_a'], 'phone_b'=>$data['phone_b'], 
                    'address_a'=>$data['address_a'], 'address_b'=>$data['address_b'], 'facebook_link'=>$data['facebook_link'], 
                    'twitter_link'=>$data['twitter_link'], 'instagram_link'=>$data['instagram_link']
                ]
            );
            
            $business_info = Business_info::where('id', '>', '0')->get()[0];
            return redirect()->route('frontstore.business_info', compact('business_info'))->with('success', 'Front-store updated successfully.');
        }


           // this creates an html banner
           public function create_html_banner (Request $request)
           {
               // if (!in_array($this->title, parent::app_sections_only())) {    
               //     return redirect()->route('access_denied'); 
               // }
       
               // if (auth()->user()->usr_type=='usr_admin') {
               //     if (!in_array(__FUNCTION__, parent::middleware_except())) {
               //         return redirect()->route('access_denied'); 
               //     }  
               // }   
        
              // dd($request);
               $data = request()->validate([
                   'background' => ['required', 'image'],
                   'bg_position' => ['required', 'string'],
                   'bl_t' => ['required', 'string'],
                   'bl_u' => ['required', 'string'],
                   'html_content' => ['required', 'string']
               ]); 

               $sql = DB::select("show table status like 'store_sliders'");
               $next_id = $sql[0]->Auto_increment;      
               $slider_id = 'slide_0'.$next_id; 
              
               $file = $request->file('background');   
               $ogImage = Image::make($file);
               $originalPath = 'app/public/uploads/assets/';   $random_string = Str::random(10);  
               $filename = time().'-'. $random_string .'.'. $file->getClientOriginalExtension();
               $ogImage =  $ogImage->save(storage_path($originalPath.$filename));
      
            $insert1 = Store_slider::create([  
                'slider_id' => $slider_id,
                'status'    => 'active',
                'background' => $filename, 
                'position' => $data['bg_position'],
                'type' => 'html',
                'link_text' => $data['bl_t'],
                'link_url' => $data['bl_u']
            ]); 


            $insert2 = Slider_content::create([  
                'slider_id' => $slider_id,
                'type'    => 'html',
                'position' => '1',
                'content' => $data['html_content']
            ]); 
               
            Session::flash('success', 'New HTML banner addded successfully');
            $store_sliders = Store_slider::orderBy('position', 'asc')->get();
            return redirect()->route('frontstore.banners', compact('store_sliders'));
        }





        // this creates a default banner
        public function create_default_banner (Request $request)
        {
             // if (!in_array($this->title, parent::app_sections_only())) {    
             //     return redirect()->route('access_denied'); 
             // }
     
             // if (auth()->user()->usr_type=='usr_admin') {
             //     if (!in_array(__FUNCTION__, parent::middleware_except())) {
             //         return redirect()->route('access_denied'); 
             //     }  
             // }   
             
             // dd($request);
             $data = request()->validate([
                 'background' => ['required', 'image'],
                 'bg_position' => ['required', 'string'],
                 'sl_t' => ['required', 'string'],
                 'sl_p' => ['required', 'string'],
                 'fl_t' => ['required', 'string'],
                 'fl_p' => ['required', 'string'],
                 'tl_t' => ['required', 'string'],
                 'tl_p' => ['required', 'string'],
                 'bl_t' => ['required', 'string'],
                 'bl_u' => ['required', 'string'],
             ]); 

             $sql = DB::select("show table status like 'store_sliders'");
             $next_id = $sql[0]->Auto_increment;      
             $slider_id = 'slide_0'.$next_id; 
            
            $banner_content = array();                     // SAVE IN ARRAY FOR INDIVIDUAL DATABASE INSERTION
            $banner_content['fl'] = [$data['fl_p'], $data['fl_t']];
            $banner_content['sl'] = [$data['sl_p'], $data['sl_t']];
            $banner_content['tl'] = [$data['tl_p'], $data['tl_t']];  

             $file = $request->file('background');   
             $ogImage = Image::make($file);
             $originalPath = 'app/public/uploads/assets/';   $random_string = Str::random(10);  
             $filename = time().'-'. $random_string .'.'. $file->getClientOriginalExtension();
             $ogImage =  $ogImage->save(storage_path($originalPath.$filename));
    
            $loop = 0;
            foreach ($banner_content as $key => $bn_item) {  $loop++;
                $l_p =  $bn_item[0];    $l_t =  $bn_item[1];     
                if ($loop==1)  {  $index= 'fl';  }   if ($loop==2)  {  $index= 'sl';  }  if ($loop==3)  {  $index= 'tl';  } 
    

                $insert1 = Slider_content::create([  
                    'slider_id' => $slider_id,
                    'type'    => $index,
                    'position' => $l_p,
                    'content' => $l_t
                ]); 
            }

             $insert2 = Store_slider::create([  
              'slider_id' => $slider_id,
              'status'    => 'active',
              'background' => $filename, 
              'position' => $data['bg_position'],
              'type' => 'default',
              'link_text' => $data['bl_t'],
              'link_url' => $data['bl_u']
            ]); 


            Session::flash('success', 'New default banner addded successfully');
            $store_sliders = Store_slider::orderBy('position', 'asc')->get();
            return redirect()->route('frontstore.banners', compact('store_sliders'));
        }
     
 

 

        // this creates a picture banner
        public function create_picture_banner (Request $request)
        {
             // if (!in_array($this->title, parent::app_sections_only())) {    
             //     return redirect()->route('access_denied'); 
             // }
     
             // if (auth()->user()->usr_type=='usr_admin') {
             //     if (!in_array(__FUNCTION__, parent::middleware_except())) {
             //         return redirect()->route('access_denied'); 
             //     }  
             // }   
             
            
             $data = request()->validate([
                 'background' => ['required', 'image'],
                 'bg_position' => ['required', 'string'],
                 'bl_t' => ['required', 'string'],
                 'bl_u' => ['required', 'string'],
             ]); 
             //  dd($request);

             $sql = DB::select("show table status like 'store_sliders'");
             $next_id = $sql[0]->Auto_increment;      
             $slider_id = 'slide_0'.$next_id; 
            
             $file = $request->file('background');   
             $ogImage = Image::make($file);
             $originalPath = 'app/public/uploads/assets/';   $random_string = Str::random(10);  
             $filename = time().'-'. $random_string .'.'. $file->getClientOriginalExtension();
             $ogImage =  $ogImage->save(storage_path($originalPath.$filename));
            
                $insert1 = Store_slider::create([  
                    'slider_id' => $slider_id,
                    'status'    => 'active',
                    'background' => $filename, 
                    'position' => $data['bg_position'],
                    'type' => 'picture',
                    'link_text' => $data['bl_t'],
                    'link_url' => $data['bl_u']
                ]); 


          Session::flash('success', 'New picture banner addded successfully');
          $store_sliders = Store_slider::orderBy('position', 'asc')->get();
          return redirect()->route('frontstore.banners', compact('store_sliders'));
        }




        // fetch update banner form
        public function update_banner_fetch(Request $request)
        {  
            // if (!in_array($this->title, parent::app_sections_only())) {    
            //     return redirect()->route('access_denied'); 
            // }

            // if (auth()->user()->usr_type=='usr_admin') {
            //     if (!in_array(__FUNCTION__, parent::middleware_except())) {
            //         return redirect()->route('access_denied'); 
            //     }  
            // }   
        

            $slider_id = $request['slider_id']; // dd($request['slider_id']); 
            $store_slider = Store_slider::where('slider_id', $slider_id)->firstOrFail();
            return view('admin.slider_update_ajax_fetch', compact('store_slider')); 
        }



        // updates banner
        public function update_banner_post (Request $request)
        {
                // if (!in_array($this->title, parent::app_sections_only())) {    
                //     return redirect()->route('access_denied'); 
                // }
        
                // if (auth()->user()->usr_type=='usr_admin') {
                //     if (!in_array(__FUNCTION__, parent::middleware_except())) {
                //         return redirect()->route('access_denied'); 
                //     }  
                // }   
                
            
                $data = request()->validate([
                    'background' => ['nullable', 'image'],
                    'bg_position' => ['required', 'string'],
                    'slider_id' => ['required', 'string'],
                    'type' => ['required', 'string'],
                    'html_content' => ['nullable', 'string'],
                    'fl_t' => ['nullable', 'string'],
                    'fl_p' => ['nullable', 'string'],
                    'sl_t' => ['nullable', 'string'],
                    'sl_p' => ['nullable', 'string'],
                    'tl_t' => ['nullable', 'string'],
                    'tl_p' => ['nullable', 'string'],
                    'bl_t' => ['nullable', 'string'],
                    'bl_u' => ['nullable', 'string'],
                ]); 
                


                $slider = Store_slider::where('slider_id', $data['slider_id'])->firstOrFail(); // checks if the slider id submitted is valid
            
                if ($request->hasFile('background')) { // if a picture was uploaded
                // get previous picture 
                $previous_image = $slider->background;   
        

                $file = $request->file('background');   
                $ogImage = Image::make($file);
                $originalPath = 'app/public/uploads/assets/';   $random_string = Str::random(10);  
                $filename = time().'-'. $random_string .'.'. $file->getClientOriginalExtension();
                $ogImage =  $ogImage->save(storage_path($originalPath.$filename));
                

                    $update1 = Store_slider::where(['slider_id'=>$data['slider_id']])->update([  
                        'background' => $filename, 
                        'position' => $data['bg_position'],
                        'link_text' => $data['bl_t'],
                        'link_url' => $data['bl_u']
                    ]); 

                if ($data['type']=='default') {
                        $banner_content = array();   // SAVE IN ARRAY FOR INDIVIDUAL DATABASE INSERTION
                        $banner_content['fl'] = [$data['fl_p'], $data['fl_t']];
                        $banner_content['sl'] = [$data['sl_p'], $data['sl_t']];
                        $banner_content['tl'] = [$data['tl_p'], $data['tl_t']]; 
                    
                    
                        $loop = 0;
                        foreach ($banner_content as $key => $bn_item) {  $loop++;
                            $l_p =  $bn_item[0];    $l_t =  $bn_item[1];     
                            if ($loop==1)  {  $index= 'fl';  }   if ($loop==2)  {  $index= 'sl';  }  if ($loop==3)  {  $index= 'tl';  } 
                    
                            $update2 = Slider_content::where(['slider_id'=>$data['slider_id'],'type'=>$index])->update([  
                                'content' => $l_t
                            ]); 
                        }
                } elseif ($data['type']=='html') {
                        $update2 = Slider_content::where(['slider_id'=>$data['slider_id'],'type'=>'html'])->update([  
                            'position' => '0',
                            'content' => $data['html_content']
                        ]); 
                }

                // delete previous picture 
                unlink(public_path().'/storage/uploads/assets/'.$previous_image);
                } else { // if no picture was uploaded  

                    $update1 = Store_slider::where(['slider_id'=>$data['slider_id']])->update([  
                        'position' => $data['bg_position'],
                        'link_text' => $data['bl_t'],
                        'link_url' => $data['bl_u']
                    ]); 

                if ($data['type']=='default') {
                        $banner_content = array();   // SAVE IN ARRAY FOR INDIVIDUAL DATABASE INSERTION
                        $banner_content['fl'] = [$data['fl_p'], $data['fl_t']];
                        $banner_content['sl'] = [$data['sl_p'], $data['sl_t']];
                        $banner_content['tl'] = [$data['tl_p'], $data['tl_t']]; 
                    
                    
                        $loop = 0;
                        foreach ($banner_content as $key => $bn_item) {  $loop++;
                            $l_p =  $bn_item[0];    $l_t =  $bn_item[1];     
                            if ($loop==1)  {  $index= 'fl';  }   if ($loop==2)  {  $index= 'sl';  }  if ($loop==3)  {  $index= 'tl';  } 
                    
                            $update2 = Slider_content::where(['slider_id'=>$data['slider_id'],'type'=>$index])->update([  
                                'position' => $l_p,
                                'content' => $l_t
                            ]); 
                        }
                } elseif ($data['type']=='html') {
                        $update2 = Slider_content::where(['slider_id'=>$data['slider_id'],'type'=>'html'])->update([  
                            'content' => $data['html_content']
                        ]); 
                } 
    
    
            }


            Session::flash('success', 'Banner updated successfully');
            $store_sliders = Store_slider::orderBy('position', 'asc')->get();
            return redirect()->route('frontstore.banners');
        }



        // switch banner ON / OFF
        public function switch_slider (Request $request)
        {
                // if (!in_array($this->title, parent::app_sections_only())) {    
                //     return redirect()->route('access_denied'); 
                // }
        
                // if (auth()->user()->usr_type=='usr_admin') {
                //     if (!in_array(__FUNCTION__, parent::middleware_except())) {
                //         return redirect()->route('access_denied'); 
                //     }  
                // }   
                $slider_id = $request['slider_id'];
                $store_slider = Store_slider::where('slider_id', $slider_id)->firstOrFail();
            
                if ($store_slider->status=='active') { $new_status='inactive'; }
                                                else { $new_status='active';   }

                $update1 = Store_slider::where(['slider_id'=>$slider_id])->update([  
                        'status' => $new_status
                ]); 

                return response()->json(['status'=>'1','message'=>'successful']);
        }



        // fetch update banner form
        public function delete_banner_fetch(Request $request)
        {  
            // if (!in_array($this->title, parent::app_sections_only())) {    
            //     return redirect()->route('access_denied'); 
            // }

            // if (auth()->user()->usr_type=='usr_admin') {
            //     if (!in_array(__FUNCTION__, parent::middleware_except())) {
            //         return redirect()->route('access_denied'); 
            //     }  
            // }   
        

            $slider_id = $request['slider_id']; // dd($request['slider_id']); 
            $store_slider = Store_slider::where('slider_id', $slider_id)->firstOrFail();
            return view('admin.slider_delete_ajax_fetch', compact('store_slider')); 
        }



        // permanently delete store banner
        public function delete_banner_post (Request $request)
        {
                // if (!in_array($this->title, parent::app_sections_only())) {    
                //     return redirect()->route('access_denied'); 
                // }
        
                // if (auth()->user()->usr_type=='usr_admin') {
                //     if (!in_array(__FUNCTION__, parent::middleware_except())) {
                //         return redirect()->route('access_denied'); 
                //     }  
                // }   


                $slider_id = $request['slider_id'];
                $store_slider = Store_slider::where('slider_id', $slider_id)->firstOrFail();
                
                if ($store_slider) {
                    $slider_img = $store_slider->background;
                    $deleted_rows1 = Store_slider::where('slider_id', $slider_id)->delete();
                    $deleted_rows2 = Slider_content::where('slider_id', $slider_id)->delete();
                        if ($deleted_rows1>0) {
                            unlink(public_path().'/storage/uploads/assets/'.$slider_img); 
                        } 
                }

                Session::flash('success', 'Banner deleted successfully');
                $store_sliders = Store_slider::orderBy('position', 'asc')->get();
                return redirect()->route('frontstore.banners');
        }


}
