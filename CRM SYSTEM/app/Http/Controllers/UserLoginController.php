<?php
/*********************************************Author:Amol Tribhuwan*****************************************************/
namespace App\Http\Controllers;

use App\UserLogin;
use App\Roles;
use App\Location;
use App\District;
use App\State;
use App\Client;
use App\ACL;
use App\User_Location;
use Mail;

use App\Mail\Your_Username_Password;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Auth;
use Config;
use Cache;
class UserLoginController extends Controller
{
    use AuthenticatesUsers;
    /**************************Show Login Page*************************************************/
    public function index(Request $request){
        return view('login');
    }

    public function login(Request $request){
        /************validate username and password**************************/
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        /*******************************check username and password************************************/
        if (auth()->attempt(array('username' => $request['username'], 'password' =>$request['password'])))
        {
            #UserLogin::where('user_id',auth()->user()->user_id)->update(['status'=>1]);
            return redirect('/home');
        }
        else
            return redirect()->back()->with('errorMsg','Incorrect Username or Password');
    }
   /***********************logout user and flush the all sessions*****************************************/
    public function logout(Request $request){

        if(auth()->check()){
            $request->session()->flush();
            return redirect('/');
       }
       else{
        return redirect('/');
       }
    }
    
}
