<?php
/*******************************************Author:Amol Tribhuwan************************************************/

/*****************************This controller only shows forms*****************************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;

use Auth;
use App\State;
use App\District;
use App\City;
use App\Area;
use App\Department;
use App\Roles;
use App\UserLogin;
use App\Work_charge;
use App\Post;
use App\Country;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Config;
class AdminController extends Controller
{
    /*public function __construct()
    {
        if(!Auth::check()){
            return redirect('/');
        }
    }*/
    public function showDashboard(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('IT-admin')==$token){
           return view('adminDashboard');
        }
        else
            return view('errors.404Error');
    }
    public function showAddEmployee(Request $request,$token=null){
    	if(Auth::check() && $request->session()->get('IT-admin')==$token){
    		return view('adminAddEmployee')->with('states',State::select('state_id','state_name')->get());
		}
		return view('errors.404Error');
    }

    public function showModifyEmployee(Request $request,$token=null){
    	if(Auth::check() && $request->session()->get('IT-admin')==$token){
    		return view('adminModifyEmployee')->with('employee',UserLogin::select('emp_id','department.dept_name','post.post_name','full_name','dob','email','mobile','qualification')->join('department','employee.dept_id','=','department.dept_id')->join('post','employee.post_id','=','post.post_id')->where('employee.dept_id','NOT LIKE','1%')->get())->with('country',Country::select('country_id','country_name')->get())->with('state',State::select('state_id','state_name')->get())->with('district',District::select('district_id','district_name')->get());
		}
		return view('errors.404Error');
    }
    public function showAddEditPost(Request $request,$token=null){
    	if(Auth::check() && $request->session()->get('IT-admin')==$token){

    		return view('adminAddEditPost')->with('workCharge',Work_charge::select('charge_id','charge_name')->get())->with('role',Roles::select('role_id','role_name')->get())->with('post',Post::select('user_roles.role_name','work_charge.charge_name','post.post_name','post.post_id','post.superior')->join('user_roles','post.role_id','=','user_roles.role_id')->join('work_charge','post.charge_id','=','work_charge.charge_id')->get());
		}
		return view('errors.404Error');
    }
    public function showAddEditWorkcharge(Request $request,$token=null){
         
    	if(Auth::check() && $request->session()->get('IT-admin')==$token){
    		return view('adminAddEditWorkCharge')->with('work',Work_charge::select('charge_id','charge_name')->get());
		}
		return view('errors.404Error');
    }
    public function showAddEditDepartment(Request $request,$token=null){
    	if(Auth::check() && $request->session()->get('IT-admin')==$token){
    		return view('adminAddEditDepartment')->with('department',Department::select('dept_id','dept_name')->get());
		}
		return view('errors.404Error');
    }
    public function showAddEditRole(Request $request,$token=null){

    	if(Auth::check() && $request->session()->get('IT-admin')==$token){
    		return view('adminAddEditRole')->with('role',Roles::select('role_id','role_name','hr_level')->get());
		}
		return view('errors.404Error');
    }
    public function showState(Request $request,$token=null){

    	if(Auth::check() && $request->session()->get('IT-admin')==$token){
    		return view('adminState')->with('state',State::select('state_id','state_name','state_code')->get());
		}
		return view('errors.404Error');
    }
    public function showDistrict(Request $request,$token=null){
    	if(Auth::check() && $request->session()->get('IT-admin')==$token){

    		return view('adminDistrict')->with('state',State::select('state_id','state_name')->get())->with('district',District::select('district_id','state.state_name','district_name')->join('state','district.state_id','=','state.state_id')->get());

		}
		return view('errors.404Error');
    }
    public function showCity(Request $request,$token=null){

    	if(Auth::check() && $request->session()->get('IT-admin')==$token){

    		return view('adminCity')->with('district',District::select('district_id','district_name')->get())->with('city',City::select('city_id','district_name','city_name')->join('district','city.district_id','=','district.district_id')->get());
		}
		return view('errors.404Error');
    }
    public function showArea(Request $request,$token=null){
    	if(Auth::check() && $request->session()->get('IT-admin')==$token){
    		return view('adminArea')->with('city',City::select('city_id','city_name')->get())->with('area',Area::select('area_id','city_name','area_name')->join('city','area.city_id','=','city.city_id')->get());
		}
		return view('errors.404Error');
    }
}
