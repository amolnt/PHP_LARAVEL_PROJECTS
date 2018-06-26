<?php

namespace App\Http\Controllers;
use App\UserLogin;
use App\Reset;
use Mail;
use App\Mail\Reset_Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ResetPasswordController extends Controller
{	
   	public function sendLink(Request $request){
   		if(count(Input::all())<=0){
            return redirect()->back();
   		}

   		$rad=substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 16)), 0, 28);

   		if(UserLogin::where('username','=',$request['email'])->exists()){
   			$val=UserLogin::select('username','remember_token')->where('username','=',$request['email'])->get();
   		
            if(!Reset::where('email','=',$val[0]['username'])->exists()){
               Reset::insert(array('email'=>$val[0]['username'],
                                'token'=>$rad));   
            }
            else{
               Reset::where('email','=',$val[0]['username'])->update(['token'=>$rad]);      
            }	
			
   			$request->session()->put('email',$val[0]['username']);
   			$request->session()->put('token',$rad);
   			Mail::to($val[0]['username'])->send(new Reset_Password());

   			return redirect()->back()->with('succMsg',"Password link send to your email");
   			
   		}
   		else{
   			return redirect()->back()->with('errorMsg',"your email is not register");
   		}
   	}
   	public function showResetForm(Request $request,$token=null){
         if($token==null || count(Input::all())<=0)
            return view('errors.404Error');
   		if($request->session()->get('token')==$token){
			Reset::where('email','=',bcrypt($request->session()->get('username')))->update(['token'=>1]);  
			$request->session()->forget('username');
			$request->session()->forget('token'); 			
   			return view('reset');	
   		}
         return view('errors.404Error');
   	}
   	public function reset(Request $request){
   			UserLogin::where('username','=',$request['email'])->update(['password'=>bcrypt($request['password'])]);
   			return redirect('/')->with('succMsg','password change successfully');
   		}
}
