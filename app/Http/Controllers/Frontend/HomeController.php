<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BookingRequest;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Food;
use App\Models\Setting;
use Binafy\LaravelCart\Models\Cart;
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
        $data['foods'] = Food::pluck('title','id');
        return view('frontend.menu',compact('data'));
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

    public  function  addToCart(Request $request){

        if(Cart::query()->firstOrCreateWithStoreItems(
            Food::find($request->food_id),
            $request->quantity,
            1
        )){
            return back()->with('success', 'Food Added into Cart Successful');
        }else{
            return back()->with('error', 'Failed to add into cart!!!');
        }
    }

    public function showCart(){

        $cart = Cart::query()->firstOrCreate(['user_id' => 1]);
        $cart_items = $cart->items()->get();
        return view('frontend.cart',compact('cart_items'));
    }

    public function showCheckoutPage(){

        $cart = Cart::query()->firstOrCreate(['user_id' => 1]);
        $cart_items = $cart->items()->get();
        return view('frontend.checkout',compact('cart_items'));
    }

}
