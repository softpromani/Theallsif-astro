<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function aries(){
        return view('frontend.service.aries');
    }
    public function palm(){
        return view('frontend.service.palm');
    }
 
    public function chinese(){
        return view('frontend.service.chinese');
    }
    public function chinese_single(){
        return view('frontend.service.chinese_single');
    }
    public function crystal(){
        return view('frontend.service.crystal');
    }
    public function kundli_dosh(){
        return view('frontend.service.kundli_dosh');
    }
    public function tarot(){
        return view('frontend.service.tarot');
    }

    public function numerology(){
        return view('frontend.service.tarot_single');
    }

    public function vastu_shastra(){
        return view('frontend.service.vastu_shastra');
    }

}
