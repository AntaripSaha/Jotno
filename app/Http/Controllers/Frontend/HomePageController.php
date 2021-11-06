<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomeModule\Home;
use App\Models\PageModule\NewPage;
use App\Models\Quality_Module\Quality;

class HomePageController extends Controller
{
    
    //index function start
    public function index(){
        $homeDatas = Home::select("id","title","sub_title","description","image","about_title","about_description","about_image","satisfied_patient","patient_per_year")->first();
        $qualities = Quality::select("id","name","image")->orderBy('id','desc')->get();
         
        if( $homeDatas &&  $qualities ){
            return view("frontend.pages.home",compact('homeDatas','qualities'));
        }else{
            return view("errors.404");
        }
        

    }
    //index function end


    //new page function start
    public function new_page($slug){
        $new_pages = NewPage::select('id','name','slug','description')->orderBy('id','desc')->get();
        $new_page_datas = NewPage::select('id','name','slug','description')->where('slug',$slug)->first();
        if( $new_pages && $new_page_datas ){
            return view('frontend.pages.info_page',compact('new_page_datas','new_pages'));
        }else{
            return view("errors.404");
        }        
        
    }
    //new page function end

    

}
