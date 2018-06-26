<?php
/*************************************Author:Amol Tribhuwan*******************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Config;
use App\Allocate;
use App\Request_call;
use App\UserLogin;
class SupervisorOperation extends Controller
{
    /************************************Allocate call to Engineer***************************************************/
    public function allocateCall(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
    	
    		$allocate=new Allocate();
    		$allocate->to_user_id=$request->input('engineer');
    		$allocate->from_user_id=Auth::user()->user_id;
    		$allocate->call_id=$request->input('call');
    		$allocate->priority=$request->input('priority');
    		$allocate->schedule=$request->input('schedule');
    		$allocate->save();


    		Request_call::where('call_id','=',$request->input('call'))->update(['status'=>$request->input('status')]);
    		return redirect()->back()->with('succMsg','Allocate a call successfully');

    	}
    	else
    		return view('errors.404Error');
    }
    /*****************************Edit Allocated Calls*********************************************************/
    public function updateAllocateCall(Request $request,$token=null){
        if(Auth::check() && $token!=null){

            Allocate::where('call_id','=',$request->input('call'))->update(['to_user_id'=>$request->input('engineer'),
                                          'priority'=>$request->input('priority'),
                                          'schedule'=>$request->input('schedule')]);
            return redirect()->back()->with('succMsg','Call Update Successfully');

        }
        else
            return view('errors.404Error');
    }

    /*************Ajax functions retrive values**********************************************************************/
    public function getEngineer(Request $request){
    	return json_encode(UserLogin::select('users.user_id','employee.full_name')->join('employee','users.emp_id','=','employee.emp_id')->join('area','users.a_id','area.a_id')->where('area.area_name','=',$request->input('area'))->where('users.dept_id','=',Config::get('checkAuth.engineer')['dept_id'])->where('users.role_id','=',Config::get('checkAuth.engineer')['role_id'])->get());
    }
    public function getAllocatedData(Request $request){
        return json_encode(Allocate::select('to_user_id','priority','schedule')->where('call_id','=',$request->input('call'))->get());
    }

}
