<?php
/*******************************************Author:Amol Tribhuwan***********************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Config;
use App\Request_call;
use App\UserLogin;
class Supervisor extends Controller
{
   /* public function showDashboard(Request $request){
    	 if(Auth::user()->dept_id==Config::get('checkAuth.supervisor')['dept_id'] || Auth::user()->post_id==Config::get('checkAuth.supervisor')['post_id']){
    	 	return view('supervisorDashboard');	
    	 }
         else
            return view('errors.404Error');
    }*/

    public function showViewCall(Request $request,$token=null){
       
    	 if(Auth::check() && $request->session()->get('viewCall')==$token){
            
    	 	//$call=Request_call::select('teqcare_request_call.call_id','teqcare_equipment.equ_type','teqcare_request_call.status','teqcare_equipment.equ_name','area.area_name','teqcare_client_info.organisation_type','teqcare_client_info.organisation_name','teqcare_client_info.contactPerson_name','teqcare_request_call.problem')->join('teqcare_users','teqcare_request_call.usr_id','=','teqcare_users.user_id')->join('teqcare_client_info','teqcare_users.user_id','=','teqcare_client_info.user_id')->join('teqcare_equipment','teqcare_users.user_id','=','teqcare_equipment.usr_id')->join('area','teqcare_request_call.a_id','=','area.a_id')->where('teqcare_request_call.a_id','=',UserLogin::select('area.a_id')->join('area','users.a_id','area.a_id')->where('users.user_id','=',Auth::user()->user_id)->get()[0]['a_id'])->where('teqcare_request_call.status','=','Open')->orderBy('teqcare_request_call.created_at','dsc')->get();
    	 	return view('supervisorViewCall');//->with('call',$call);*/	
    	 }
         else
            return view('errors.404Error');
    }
    
    public function showAllocateCall(Request $request,$token=null){
         if(Auth::check() && $request->session()->get('allocateCall')==$token){
            
            //$call=Request_call::select('teqcare_request_call.call_id','teqcare_equipment.equ_type','teqcare_request_call.status','teqcare_equipment.equ_name','area.area_name','teqcare_client_info.organisation_type','teqcare_client_info.organisation_name','teqcare_client_info.contactPerson_name','teqcare_request_call.problem')->join('teqcare_users','teqcare_request_call.usr_id','=','teqcare_users.user_id')->join('teqcare_client_info','teqcare_users.user_id','=','teqcare_client_info.user_id')->join('teqcare_equipment','teqcare_users.user_id','=','teqcare_equipment.usr_id')->join('area','teqcare_request_call.a_id','=','area.a_id')->where('teqcare_request_call.a_id','=',UserLogin::select('area.a_id')->join('area','users.a_id','area.a_id')->where('users.user_id','=',Auth::user()->user_id)->get()[0]['a_id'])->where('teqcare_request_call.status','=','Allocated')->orderBy('teqcare_request_call.created_at','dsc')->get();


            //$user=UserLogin::select('employee.emp_id','employee.full_name')join('area','users.a_id','area.a_id')->where('area.a_id','=',Auth::user()->a_id)->where('users.dept_id','=',Config::get('checkAuth.engineer')['dept_id'])->where('users.role_id','=',Config::get('checkAuth.engineer')['role_id'])->get();
            return view('supervisorAllocatedCall');//->with('call',$call)->with('user',$user);  
         }
         else
            return view('errors.404Error');
    }
     public function showCloseCall(Request $request,$token=null){

         if(Auth::check() && $request->session()->get('closeCall')==$token){
            
            //$call=Request_call::select('teqcare_request_call.call_id','teqcare_equipment.equ_type','teqcare_request_call.status','teqcare_equipment.equ_name','area.area_name','teqcare_client_info.organisation_type','teqcare_client_info.organisation_name','teqcare_client_info.contactPerson_name','teqcare_request_call.problem')->join('teqcare_users','teqcare_request_call.usr_id','=','teqcare_users.user_id')->join('teqcare_client_info','teqcare_users.user_id','=','teqcare_client_info.user_id')->join('teqcare_equipment','teqcare_users.user_id','=','teqcare_equipment.usr_id')->join('area','teqcare_request_call.a_id','=','area.a_id')->where('teqcare_request_call.a_id','=',UserLogin::select('area.a_id')->join('area','users.a_id','area.a_id')->where('employee.emp_id','=',Auth::user()->emp_id)->get()[0]['a_id'])->where('teqcare_request_call.status','=','Close')->orderBy('teqcare_request_call.created_at','dsc')->get();

            return view('supervisorCloseCall');//->with('call',$call);  
         }
         else
            return view('errors.404Error');
    }
    
}
