<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Astrologer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $astrologers=Astrologer::where('is_active',1)->get();
        return view('frontend.home',compact('astrologers'));
    }
    public function about(){
        return view('frontend.about');
    }
    public function blog(){
        return view('frontend.blog');
    }
    public function contact_us(){
        return view('frontend.contact_us');
    }
    public function details($id){
         $astrologer=Astrologer::find($id);
        return view('frontend.details',compact('astrologer'));
    }
    public function contactus(){
        return view('frontend.contactus');
    }
    public function consultHistroy(){
        return view('frontend.consultHistroy');
    }
    public function astrologer(){
        return view('frontend.astrologer');
    }
    public function zodiacsigns(){
        return view('frontend.zodiacsigns');
    }
    public function payment(){
        return view('frontend.payment');
    }
     public function astrologyprofile(){
        return view('frontend.astrologyprofile');
    }
    public function chat(){
        return view('frontend.chat');
    }
     public function updateprofile(){
        return view('frontend.updateprofile');
    }
    
}
