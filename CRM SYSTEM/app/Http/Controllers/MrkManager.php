<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Config;
use App\Employee;
use App\UserLogin;
use App\Lead;
use App\Customer_Account;
class MrkManager extends Controller
{

    public function showManageLead(Request $request,$token=null){
    	if(Auth::check() && $request->session()->get('manageLead')==$token){
        	return view('mrkManagerManageLead')->with('lead',Lead::select('lead_id','organization_name','contact_person_name','lead.mobile_no','lead.email','lead.status','description','employee.full_name','lead.updated_at')->join('employee','lead.emp_id','=','employee.emp_id')->get());	
        }
        else
        	return view('errors.404Error');
    }
    public function showApproveQuotation(Request $request,$token=null){
    		if(Auth::check() && $request->session()->get('approveQuotation')==$token){
        	return view('mrkManagerApproveQuotation')->with('data',Lead::select('lead.lead_id','lead.address','employee.full_name','quotation_approve.quotation_id','quotation_approve.resend_status','quotation_approve.approve_status as approve_status','organization_name','quotation_approve.approve_id','lead.status as lead_source','contact_person_name','lead.mobile_no','lead.email','lead.status','description','employee.full_name','lead.updated_at')->join('employee','lead.emp_id','=','employee.emp_id')->join('quotation_approve','lead.lead_id','=','quotation_approve.lead_id')->orderBy('quotation_approve.created_at','dsc')->where('quotation_approve.approve_status','!=','2')->get());	
        }
        else
        	return view('errors.404Error');
    }
    public function showDisApproveQuotation(Request $request,$token=null){
            if(Auth::check() && $request->session()->get('disApproveQuotation')==$token){
            return view('mrkManagerDisApproveQuotation')->with('data',Lead::select('lead.lead_id','employee.full_name','quotation_approve.quotation_id','quotation_approve.approve_status as approve_status','organization_name','quotation_approve.approve_id','lead.status as lead_source','contact_person_name','lead.mobile_no','lead.email','lead.status','description','employee.full_name','lead.updated_at')->join('employee','lead.emp_id','=','employee.emp_id')->join('quotation_approve','lead.lead_id','=','quotation_approve.lead_id')->orderBy('quotation_approve.created_at','dsc')->where('quotation_approve.approve_status','=','2')->get());   
        }
        else
            return view('errors.404Error');
    }
     public function showAddCustomer(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('addCustomer')==$token){
            return view('mrkManagerAddCustomer')->with('data',Lead::select('lead.lead_id','employee.full_name','organization_name','lead.status as lead_source','contact_person_name','lead.mobile_no','lead.email','lead.status','description','lead.updated_at')->join('employee','lead.emp_id','=','employee.emp_id')->get());   
        }
        else
            return view('errors.404Error');
    }
     public function showEditCustomer(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('editCustomer')==$token){

            return view('mrkManagerEditCustomer')->with('customer',Customer_Account::select('customer_id','account_name','CIN','GST','employee.full_name')->join('employee','customer_account.created_by','=','employee.emp_id')->get());   
        }
        else
            return view('errors.404Error');
    }
}
