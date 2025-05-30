<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    function showLogin(){
        return view('backend.user.login');
    }

    function showRegister(){
        return view('backend.user.register');
    }

    function register(RegisterRequest $request){
        try{
            $user = User::create($request->all());
            if($user){
                return redirect()->route('backend.showlogin')->with('success','User registered succssfully');
            } else {
                return redirect()->back()->with('error','User registration failed');
            }
        }catch(Exception $ex){
                return redirect()->back()->with('error','Oops... Error');
        }
    }
}
