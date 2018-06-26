<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Config;
use App\Lead;
use App\Task;
use App\Lead_Action;
use App\Lead_Response;
use App\Quotation_Approve;
use App\Customer_Opportunity;
use App\Customer_Account;
class MrkManagerOperation extends Controller
{
    public function addTask(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
    		$task=new Task();
            $task->assign_from=Auth::user()->emp_id; 
            $task->assign_to=Lead::select('emp_id')->where('lead_id','=',$request->input('lead'))->get()[0]['emp_id'];
    		$task->lead_id= $request->input('lead');
            $task->priority=$request->input('priority');
    		$task->subject=$request->input('subject');
    		$task->schedule=$request->input('schedule');
    		$task->discription=$request->input('discription');
    		$task->save();
    		return redirect()->back()->with('succMsg','Task assign successfully');
    	}
    	else
    		return view('errors.404Error');
    }
    
    public function resendRequest(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            Quotation_Approve::where('quotation_id','=',$request->input('quotation'))->update(['resend_status'=>'1','created_by'=>Auth::user()->emp_id]);
            return redirect()->back()->with('succ1',['succMsg'=>'Request Sent To Resend Quotation']);
        }
        else
            return view('errors.404Error');
    }
    public function approveQuotation(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            if($request->input('approve_status')==0){
                Quotation_Approve::where('approve_id','=',Quotation_Approve::select('approve_id')->where('quotation_approve.quotation_id','=',$request->input('quotation_number'))->join('quotation','quotation_approve.quotation_id','=','quotation.quotation_id')->get()[0]['approve_id'])->update(['approve_status'=>'2',
                                                                                              'updated_by'=>Auth::user()->emp_id]);
                return redirect()->back()->with('succMsg','Quotation DisApproved Successfully');
            }
            else{
                Quotation_Approve::where('quotation_id','=',$request->input('quotation_number'))->update(['approve_status'=>'1',
                                                                                              'updated_by'=>Auth::user()->emp_id]);
                $Opportunity=new Customer_Opportunity();
                $Opportunity->customer_id=$request->input('account_name');
                $Opportunity->lead_id=$request->input('lead');
                $Opportunity->quotation_id=$request->input('quotation_number');
                $Opportunity->close_date=$request->input('approve_closeDate');
                $Opportunity->stage=$request->input('approve_stage');
                $Opportunity->reason_for_lost=$request->input('reason_lost');
                $Opportunity->created_by=Auth::user()->emp_id;
                $Opportunity->save();

                Lead::where('lead_id','=',$request->input('lead'))->update(['status'=>$request->input('status')]);
                return redirect()->back()->with('succMsg','Apportunity Created Successfully');
            }
        }
        else
            return view('errors.404Error');
    }

     public function addCustomer(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            if(Customer_Account::where('account_name','=',$request->input('account_name'))->exists())
                return redirect()->back()->with('succMsg','Customer Already Exists');
            else{
                $customer=new Customer_Account();
                $customer->lead_id=$request->input('lead');
                $customer->account_name=$request->input('account_name');
                $customer->CIN=$request->input('CIN');
                $customer->GST=$request->input('GST');
                $customer->created_by=Auth::user()->emp_id;
                $customer->save();
                return redirect()->back()->with('succMsg','Customer Created Successfully');
            }
        }
        else
            return view('errors.404Error');
    }
    public function editCustomer(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            Customer_Account::where('customer_id','=',$request->input('customer'))->update(['account_name'=>$request->input('account_name'),'CIN'=>$request->input('CIN'),'GST'=>$request->input('GST'),'updated_by'=>Auth::user()->emp_id]);
            return redirect()->back()->with('succMsg','Customer Updated Successfully');
        }
        else
            return view('errors.404Error');
    }
    /******************************************************Ajax************************************************************/
     public function getActionResponse(Request $request,$id){
        if(Auth::check() && Auth::user()->dept_id==Config::get('checkAuth.mrkManager')['dept_id'] && Auth::user()->role_id==Config::get('checkAuth.mrkManager')['role_id']){
            if(Lead_Action::where('lead_id','=',$id)->exists()){
                $action=Lead_Action::select('action_type','action_date','description')->where('lead_id','=',$id)->orderBy('action_date','dsc')->get();
                $response=Lead_Response::select('response_type','response_date','description')->where('lead_id','=',$id)->orderBy('response_date','dsc')->get();
                $tr="<tbody>";
                if(count($action)==1){
                    $tr.="<tr>";
                    $tr.="<td>".$action[0]['action_type']."</td>";
                    $tr.="<td>".$action[0]['description']."</td>";
                    $tr.="<td>".$action[0]['action_date']."</td>";
                    $tr.="<td>".$response[0]['response_type']."</td>";
                    $tr.="<td>".$response[0]['description']."</td>";
                    $tr.="<td>".$response[0]['response_date']."</td>";
                    $tr.="</tr>";
                    $tr.="</tbody>";
                    return json_encode($tr);
                }
                if(count($action)==2){
                    for ($i=0; $i <2 ; $i++) { 
                        $tr.="<tr>";
                        $tr.="<td>".$action[$i]['action_type']."</td>";
                        $tr.="<td>".$action[$i]['description']."</td>";
                        $tr.="<td>".$action[$i]['action_date']."</td>";
                        $tr.="<td>".$response[$i]['response_type']."</td>";
                    $tr.="<td>".$response[$i]['description']."</td>";
                    $tr.="<td>".$response[$i]['response_date']."</td>";
                        $tr.="</tr>";    
                    }
                    $tr.="</tbody>";
                    return json_encode($tr);
                }
                else{
                        for ($i=0; $i <2 ; $i++) {
                            $tr.="<tr>";
                            $tr.="<td>".$action[$i]['action_type']."</td>";
                            $tr.="<td>".$action[$i]['description']."</td>";
                            $tr.="<td>".$action[$i]['action_date']."</td>";
                            $tr.="<td>".$response[$i]['response_type']."</td>";
                             $tr.="<td>".$response[$i]['description']."</td>";
                            $tr.="<td>".$response[$i]['response_date']."</td>";
                            $tr.="</tr>";
                        } 
                        $tr.="<tr><td colspan=\"8\"><a style=\"cursor:pointer;font:bold;color:blue;\" data-toggle=\"collapse\" data-target=\"#showMoreAction\">Show More Action</a></td></tr></tbody>";
                        $tr.="<tbody id=\"showMoreAction\" class=\"collapse\">";
                        for ($j=2; $j <count($action)-1; $j++) { 
                            $tr.="<tr>";
                            $tr.="<td>".$action[$j]['action_type']."</td>";
                            $tr.="<td>".$action[$j]['description']."</td>";
                            $tr.="<td>".$action[$j]['action_date']."</td>";
                            $tr.="<td>".$response[$j]['response_type']."</td>";
                            $tr.="<td>".$response[$j]['description']."</td>";
                            $tr.="<td>".$response[$j]['response_date']."</td>";
                            $tr.="</tr>";            
                        }
                        $tr.="</tbody>";
                        return json_encode($tr);
                    }
                }
            else
            {
                return json_encode("<tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody>");
            }

        }
        else
            return view('errors.404Error');
    }
    public function getAccounts(Request $request){
        return json_encode(Customer_Account::select('customer_id','account_name')->get());
    }
    /*****************************************************End**************************************************************/
}
