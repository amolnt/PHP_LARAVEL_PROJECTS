<?php
/************************************************Author:Amol Tribhuwan*********************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;

use Auth;
use App\Lead;
use App\Lead_Log;
use App\Lead_Action;
use App\Lead_Response;
use Config;
use App\Task;
use Carbon\Carbon;
use App\Quotation;
use App\Quotation_Approve;
use App\Organization_Service_Type;
class MrkExecutive extends Controller
{
    public function showAddLead(Request $request,$token=null){

    	if(Auth::check() && $request->session()->get('mrkExecutive')==$token){
            
    		return view('mrkExecutiveAddLead')->with('service_type',Organization_Service_Type::select('service_type_id','service_type_name')->get());
		}
		return view('errors.404Error');
    }

    public function showActionResponse(Request $request,$token=null){
    	if(Auth::check() && $request->session()->get('mrkExecutive')==$token){
            
            return view('mrkExecutiveActionResponse');
        }
        return view('errors.404Error');
    }
    
     public function showTodayTasks(Request $request,$token=null){
   
        if(Auth::check() && $request->session()->get('mrkExecutive')==$token){
            return view('mrkExecutiveTodayTasks')->with('task',Task::select('task_id','assign_task.status','lead.organization_name','assign_task.priority','subject','schedule','discription')->join('lead','assign_task.lead_id','=','lead.lead_id')->join('employee','lead.emp_id','=','employee.emp_id')->where('assign_to','=',Auth::user()->emp_id)->whereDate('assign_task.schedule','=',date('Y-m-d'))->where('assign_task.status','=','Assign')->get());
        }  
        else
            return("errors.404Error");      
    }
     public function showMonthTasks(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('mrkExecutive')==$token){
            return view('mrkExecutiveMonthTasks')->with('task',Task::select('task_id','assign_task.status','lead.organization_name','assign_task.priority','subject','schedule','discription')->join('lead','assign_task.lead_id','=','lead.lead_id')->join('employee','lead.emp_id','=','employee.emp_id')->where('assign_to','=',Auth::user()->emp_id)->whereBetween('assign_task.schedule',array(Carbon::now()->addDays(1),Carbon::now()->addDays(30)))->get());
        }  
        else
            return("errors.404Error");      
    }
     public function showOverDueTasks(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('mrkExecutive')==$token){
            return view('mrkExecutiveOverDueTasks')->with('task',Task::select('task_id','assign_task.status','lead.organization_name','assign_task.priority','subject','schedule','discription')->join('lead','assign_task.lead_id','=','lead.lead_id')->join('employee','lead.emp_id','=','employee.emp_id')->where('assign_to','=',Auth::user()->emp_id)->whereBetween('assign_task.schedule',array(Carbon::now()->addDays(30),Carbon::now()->addYear(2)))->get());
        }  
        else
            return("errors.404Error");      
    }
     public function showCompletedTasks(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('mrkExecutive')==$token){
            return view('mrkExecutiveCompletedTasks')->with('task',Task::select('task_id','lead.organization_name','assign_task.status','assign_task.priority','subject','schedule','discription')->join('lead','assign_task.lead_id','=','lead.lead_id')->join('employee','lead.emp_id','=','employee.emp_id')->where('assign_to','=',Auth::user()->emp_id)->where('assign_task.status','=','Complete')->get());
        }  
        else
            return("errors.404Error");      
    }

    public function showSendToApprove(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('mrkExecutive')==$token){
            $tr="";
            $data=Lead::select('lead.lead_id','address','organization_name','contact_person_name','mobile_no','email','status')->where('lead.emp_id','=',Auth::user()->emp_id)->orderBy('lead.updated_at','asc')->orderBy('isFollowUp','asc')->where('isArchive','=','0')->get();
           
            for ($i=0; $i <count($data) ; $i++) {
                $tr.="<tr>";
               
                $tr.="<td hidden>".$data[$i]['lead_id']."</td>";
                if(Quotation::where('lead_id','=',$data[$i]['lead_id'])->exists()){
                    $tr.="<td>".Quotation::select('quotation_id')->where('lead_id','=',$data[$i]['lead_id'])->orderBy('created_at','dsc')->get()[0]['quotation_id']."</td>";
                }
                else
                    $tr.="<td></td>";

                
                $tr.="<td hidden>".$data[$i]['address']."</td>";
                $tr.="<td>".$data[$i]['organization_name']."</td>";
                $tr.="<td>".$data[$i]['contact_person_name']."</td>";
                $tr.="<td>".$data[$i]['mobile_no']."</td>";
                $tr.="<td>".$data[$i]['email']."</td>";
                $tr.="<td>".$data[$i]['status']."</td>";
                $status=null;
                if(Quotation_Approve::where('lead_id','=',$data[$i]['lead_id'])->exists()){
                   $status=Quotation_Approve::select('send_status')->where('lead_id','=',$data[$i]['lead_id'])->get()[0]['send_status'];

                }

                if(Quotation::where('lead_id','=',$data[$i]['lead_id'])->exists()){
                    if(Quotation::where('lead_id','=',$data[$i]['lead_id'])->where('emp_id','=',Auth::user()->emp_id)->where('sendStatus','=','1')->exists()){
                        if($status=='1'){
                            $tr.='<td> <a class="btn btn-success btn-xs"  >
                                    <span class="fa fa-check" > Send</span>
                                    </a></td>';
                            $tr.='<td> <a class="btn btn-success btn-xs"  >
                                    <span class="fa fa-check" > Send</span>
                                    </a></td>';
                            if(Quotation_Approve::select('resend_status')->where('lead_id','=',$data[$i]['lead_id'])->get()[0]['resend_status']=='1'){
                                  $tr.='<td> <a class="btn btn-danger btn-xs resend"  data-toggle="collapse" data-target="#resendQuotation">
                                    <span class="fa fa-remove" >Resend</span>
                                    </a></td>';
                            }
                            else if(Quotation_Approve::select('resend_status')->where('lead_id','=',$data[$i]['lead_id'])->get()[0]['resend_status']=='2'){
                                  $tr.='<td> <a class="btn btn-success btn-xs"  >
                                    <span class="fa fa-check" >Resend</span>
                                    </a></td>';
                            }
                            else {
                                  $tr.='<td> <a class="btn btn-danger btn-xs"  >
                                    <span class="fa fa-remove" >Requested</span>
                                    </a></td>';
                            }
                            $tr.='<td></td>';
                        }
                        else{
                            $tr.='<td> <a class="btn btn-danger btn-xs"  >
                                    <span class="fa fa-remove" > Send</span>
                                    </a></td>';  
                             $tr.='<td> <a class="btn btn-success btn-xs"  >
                                    <span class="fa fa-check" > Send</span>
                                    </a></td>';
                            $tr.='<td><a  data-toggle="collapse" data-target="#approve" onclick="approve(this)" name="'.$i.'" style="cursor:pointer" class="approve btn btn-primary btn-xs">SendToApprove</a></td>';  
                       
                            }    
                    }
                    else
                    {
                        if($status=='1'){
                            $tr.='<td> <a class="btn btn-success btn-xs"  >
                                    <span class="fa fa-check" > Send</span>
                                    </a></td>';
                            $tr.='<td> <a class="btn btn-success btn-xs"  >
                                    <span class="fa fa-check" > Send</span>
                                    </a></td>';
                             if(Quotation_Approve::select('resend_status')->where('lead_id','=',$data[$i]['lead_id'])->get()[0]['resend_status']=='1'){
                                  $tr.='<td> <a class="btn btn-danger btn-xs resend"  data-toggle="collapse" data-target="#resendQuotation" >
                                    <span class="fa fa-remove" >Resend</span>
                                    </a></td>';
                            }
                            else if(Quotation_Approve::select('resend_status')->where('lead_id','=',$data[$i]['lead_id'])->get()[0]['resend_status']=='2'){
                                  $tr.='<td> <a class="btn btn-success btn-xs"  >
                                    <span class="fa fa-check" >Resend</span>
                                    </a></td>';
                            }
                            else {
                                  $tr.='<td> <a class="btn btn-danger btn-xs"  >
                                    <span class="fa fa-remove" >Requested</span>
                                    </a></td>';
                            }
                        }
                        else{
                            $tr.='<td> <a class="btn btn-danger btn-xs"  >
                                    <span class="fa fa-remove" > Send</span>
                                    </a></td>';  
                             $tr.='<td> <a class="btn btn-success btn-xs"  >
                                    <span class="fa fa-check" > Send</span>
                                    </a></td>';
                            $tr.='<td><a  data-toggle="collapse" data-target="#approve" onclick="approve(this)" name="'.$i.'" style="cursor:pointer" class="approve btn btn-primary btn-xs">SendToApprove</a></td>'; 
                        }
                    }
                }
                else{
                    $tr.='<td> <a class="btn btn-danger btn-xs"  >
                                    <span class="fa fa-remove" > Send</span>
                                    </a></td>';
                    $tr.='<td> <a class="btn btn-danger btn-xs"  >
                                    <span class="fa fa-remove" > Send</span>
                                    </a></td>'; 
                   $tr.='<td> <a class="btn btn-danger btn-xs"  >
                                    <span class="fa fa-remove" >Requested</span>
                                    </a></td>';
                }
                $tr.="</tr>";
            
            }
            return view('mrkExecutiveSendToApproveQuotation')->with('tr',$tr);
            
        }
        else
            return view('errors.404Error');
    }
}
