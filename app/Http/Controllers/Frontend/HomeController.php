<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BookingRequest;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    function __construct(){
        $setting = Setting::first();
        $food_categories = Category::where('status',1)->orderBy('rank')->get();
        View::share('setting',$setting);
        View::share('food_categories',$food_categories);
    }
    public function showHomePage(){
        return view('frontend.home');
    }

    public function showMenu(){
        return view('frontend.menu');
    }

    function  showBookingForm(){
        return view('frontend.booking');
    }

    public  function  storeBookingData(Request $request){
        $request->request->add(['status' => 1]);
        if (Booking::create($request->all())){
            return back()->with('success', 'Booking Successful');
        } else {
            return back()->with('error', 'Booking Failed');
        }
    }
}
