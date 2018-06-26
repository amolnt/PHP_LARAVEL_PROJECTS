<?php
namespace App\Http\Controllers;

use App\UserLogin;
use App\Roles;
use App\City;
use App\Area;
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

class UserLoginController extends Controller
{
    use AuthenticatesUsers;

    public function index(Request $request){
        return view('login');
    }

    public function login(Request $request){
        
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

    if (auth()->attempt(array('username' => $request['username'], 'password' =>$request['password'],'redirect_status'=>0)))
        {
            #UserLogin::where('user_id',auth()->user()->user_id)->update(['status'=>1]);
            return view('client_info');
        }
        else if (auth()->attempt(array('username' => $request['username'], 'password' =>$request['password'],'redirect_status'=>1)))
        {
            #UserLogin::where('user_id',auth()->user()->user_id)->update(['status'=>1]);
            return redirect('/home');
        }/*
        else if(auth()->attempt(array('username' => $request['username'], 'password' =>$request['password'],'status'=>1 ))){
            auth()->logout();
            $request->session()->flush();
            return view('errors.alreadyLogin');
        }*/
        else
            return redirect()->back()->with('errorMsg','Incorrect Username Or Password');
    }
    public function signup(Request $data){
        if(count(Input::all())<=0)
            return redirect()->back();

        
        if(!UserLogin::where('username','=',Input::get('email'))->exists()){

        $pass=substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMJNOPQRSTUVWXYZ0123456789-=[]!@#$%^&{}/?~\.>,<'), 0,6);

        $data=['username'=>Input::get('email'),
                'password' =>$pass];

        Mail::to(Input::get('email'))->send(new Your_Username_Password($data));
        

        $user=new UserLogin();
        $user->username = Input::get('email');
        $user->password = bcrypt($pass);
        $user->mobile_no = Input::get('mobileNo');
        $user->email = Input::get('email');
        $user->status   = 0;
        $user->save();

        ACL::insert(array(array('user_id'=>$user->user_id,'menu_id'=>'1','subMenu_id'=>'1'),
               array('user_id'=>$user->user_id,'menu_id'=>'2','subMenu_id'=>'2'),
               array('user_id'=>$user->user_id,'menu_id'=>'2','subMenu_id'=>'3'),
               array('user_id'=>$user->user_id,'menu_id'=>'2','subMenu_id'=>'4'),
               array('user_id'=>$user->user_id,'menu_id'=>'3','subMenu_id'=>'5'),
               array('user_id'=>$user->user_id,'menu_id'=>'3','subMenu_id'=>'6'),
               array('user_id'=>$user->user_id,'menu_id'=>'4','subMenu_id'=>'7'),
               array('user_id'=>$user->user_id,'menu_id'=>'4','subMenu_id'=>'8'),
               array('user_id'=>$user->user_id,'menu_id'=>'5','subMenu_id'=>'9'),
               array('user_id'=>$user->user_id,'menu_id'=>'5','subMenu_id'=>'10'),
               array('user_id'=>$user->user_id,'menu_id'=>'5','subMenu_id'=>'11'),
                ));
        return redirect()->back()->with('succMsg',"Username and Password is send to your mail");
        }
        else{
            return redirect()->back()->with('errorMsg',"email already exists");   
        }
    }

    public function logout(Request $request){
        if(auth()->check()){
            #UserLogin::where('user_id',auth()->user()->user_id)->update(['status'=>0]);
            auth()->logout();
            $request->session()->flush();
            return redirect('/');
        }
    }

    public function getDistrict($id){
        return json_encode(District::select('district_name','d_id')->where('s_id','=',$id)->get());
    }
    
    public function getCity($id){
         return json_encode(City::select('city_name','c_id')->where('d_id','=',$id)->get());
    }
    public function getArea($id){
         return json_encode(Area::select('area_name','a_id')->where('c_id','=',$id)->get());
    }
    
    public function add_client_info(Request $request){
        if(count(Input::all())<=0)
            return redirect()->back();
        if(auth()->check()){
                $client=new Client();
                $client->user_id=auth()->user()->user_id;
                $client->organisation_type=Input::get('organisationType');
                $client->organisation_name=Input::get('organisationName');
                $client->contactPerson_name=Input::get('contactPerName');
                $client->save();

                UserLogin::where('user_id','=',auth()->user()->user_id)->update(['redirect_status'=>1]);
                return redirect('/home');       
        }
        else{
            return view('errors.404Error');
        }
    }
}
