<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use App\Task;
use Auth;
class Dashboard extends Controller
{
    public function index(Request $request,$token){
    	if(Auth::check() && $request->session()->has('IT-admin')){
    		return view('adminDashboard');
    	}
    	else if(Auth::check() && $request->session()->has('mrkExecutive')){
    		return view('mrkExecutiveDashboard')->with('task',Task::select('task_id','assign_task.status','lead.organization_name','assign_task.priority','subject','schedule','discription')->join('lead','assign_task.lead_id','=','lead.lead_id')->join('employee','lead.emp_id','=','employee.emp_id')->where('assign_to','=',Auth::user()->emp_id)->whereDate('assign_task.schedule','=',date('Y-m-d'))->get());
    	}
    	else
    		return view('dashboard');
    }
}
