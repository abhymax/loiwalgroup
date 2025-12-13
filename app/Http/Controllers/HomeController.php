<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\News;
use App\Models\Banner;
use Illuminate\Http\Response;

class HomeController extends Controller
{

    public function index(Request $request){

        /*$cms_id = 4;
 
        $newsquery = News::orderBy('date_added','DESC');
        $data['news'] = $newsquery->get();

        $bannerquery = Banner::where('banner_active','Y')->where('banner_location',$cms_id);
        $data['banners'] = $bannerquery->get();
        $data['cms_id'] =  $cms_id;
        
        if(array_key_exists('it_number', $request->all())){
            if(!empty($request->it_number)){
                $data['it_number'] = $request->it_number;
            }
        }
        if(array_key_exists('lot_number', $request->all())){
            if(!empty($request->lot_number)){
                $data['lot_number'] = $request->lot_number;
            }
        }
        if(array_key_exists('hbl_number', $request->all())){
            if(!empty($request->hbl_number)){
                $data['hbl_number'] = $request->hbl_number;
            }
        }*/
		
        $data['content'] = 'Coming Soon';
        return view('home', compact('data'));


    }
}