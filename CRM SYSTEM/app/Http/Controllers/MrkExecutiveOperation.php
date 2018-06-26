<?php
/********************************************Author:Amol Tribhuwan************************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;

use App\Lead;
use App\Lead_Action;
use App\Lead_Response;
use Auth;
use Crypt;
use Config;
use App\Task;
use App\Quotation;
use App\Quotation_Approve;
use App\Organization_Service_subType;
class MrkExecutiveOperation extends Controller
{
    /**************************************executive to add a Lead**********************************************/
    public function addLead(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            $led = new Lead();
            $led->emp_id =Auth::user()->emp_id;
            $led->service_type_id =$request['service_type'];
            $led->service_subtype_id =$request['service_subtype'];
            $led->lead_source= $request['lead_source'];
            $led->organization_type= $request['orgType'];
            $led->organization_name=$request['orgName'];
            $led->contact_person_name=$request['contPerName'];
            $led->address=$request['address'];
            $led->phone_no=$request['phoneNo'];
            $led->mobile_no=$request['mobileNo'];
            $led->email= $request['email'];
            $led->description=$request['description'];
            $led->status =$request['status'];
             $led->created_by =Auth::user()->emp_id;
            $led->save();

            return redirect()->back()->with('succMsg','Lead Addedd sucessfully');
        }
        else
            return view('errors.404Error');
    }
    /**************************************executive to follow-up the lead********************************************/
    public function addAction(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            if(count(Input::all())<=0)
                return redirect()->back();

            $lead_action=new Lead_Action();
            $lead_action->lead_id=Input::get('lead');
            $lead_action->action_type=implode(', ',array_values(Input::get('actionType')) );
            $lead_action->description=Input::get('actionDescription');
            $lead_action->action_date=Input::get('action_date');
            $lead_action->created_by=Auth::user()->emp_id;
            $lead_action->save(); 

            return redirect()->back()->with('succMsg','Action Response add suucessfully');
        }
        return view('errors.404Error');
    }
    public function addResponse(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            $lead_response=new Lead_Response();
            $lead_response->lead_id=Input::get('lead');
            $lead_response->response_type=implode(', ',array_values(Input::get('responseType')) );
            $lead_response->response_date=Input::get('response_date');
            $lead_response->description=Input::get('responseDescription');
            $lead_response->created_by=Auth::user()->emp_id;
            $lead_response->save();
            Lead::where('lead_id','=',Input::get('lead'))->update(['status'=>Input::get('status'),'updated_by'=>Auth::user()->emp_id]);
            return redirect()->back()->with('succMsg','Response added suucessfully');
        }
        return view('errors.404Error');
    }

     public function addToArchive(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            Lead::where('lead_id','=',Input::get('archiveLead'))->update(['isArchive'=>'1','updated_by'=>Auth::user()->emp_id]);
            return redirect()->back()->with('succMsg','Lead move to archive');
        }
        return view('errors.404Error');
    }
    public function sendToApprove(Request $request,$token=null){

        if(Auth::check() && $token!=null){
            $quotation_approve=new Quotation_Approve();
            $quotation_approve->lead_id=$request->input('sendToApprove');
            $quotation_approve->quotation_id=Quotation::select('quotation_id')->where('lead_id','=',$request->input('sendToApprove'))->orderBy('quotation_id','dsc')->get()[0]['quotation_id'];
            $quotation_approve->created_by=Auth::user()->emp_id;
            $quotation_approve->send_status='1';
            $quotation_approve->save();
            return redirect()->back()->with('succMsg','Quotation send to for Aproving');
        }
        return view('errors.404Error');
    }
    /************************************************Executive Update Operation************************************/
    public function updateTaskStatus(Request $request,$token=null){
         if(Auth::check() && $token!=null){
            Task::where('task_id','=',$request->input('task'))->update(['status'=>$request->input('status')]);
            return redirect()->back()->with('succMsg','Task Updated Successfully');
        }
        return view('errors.404Error');
    }

    /****************************************************End Update Operation**************************************/

    /********************************************Ajax functions to retrives values*********************************/
    public function getAction(Request $request,$id){
        if(Auth::check()){
            
            if(Lead_Action::where('lead_id','=',$id)->exists()){
                $action=Lead_Action::select('action_type','action_date','description')->where('lead_id','=',$id)->orderBy('created_at','dsc')->get();
                $response=Lead_Response::select('response_type','response_date','description')->where('lead_id','=',$id)->orderBy('created_at','dsc')->get();
                $tr=" <tbody>
                        <tr>
                          <th>Action Type</th>
                          <th>Action Description</th>
                          <th>Action Date</th>
                          <th>Response Type</th>
                          <th>Response Description</th>
                          <th>Response Date</th>
                        </tr>
                        ";
                $tr.="";
          
                for ($i=0; $i <4 ; $i++) {
                    if(isset($action[$i])){
                        $tr.="<tr>";
                        $tr.="<td>".$action[$i]['action_type']."</td>";
                        $tr.="<td>".$action[$i]['description']."</td>";
                        $tr.="<td>".$action[$i]['action_date']."</td>";
                        if(isset($response[$i])){
                            $tr.="<td>".$response[$i]['response_type']."</td>";
                                    $tr.="<td>".$response[$i]['description']."</td>";
                                    $tr.="<td>".$response[$i]['response_date']."</td>";
                        }
                        else{
                                $tr.="<td>--</td>";
                                $tr.="<td>--</td>";
                                $tr.="<td>--</td>";
                            }
                            
                            $tr.="</tr>";
                    }
                } 

                $flag=true;
                  
                for ($j=4; $j <count($action); $j++) { 
                    $flag=false;
                    $tr.="<tr class=\"accordian collapse\">";
                    $tr.="<td>".$action[$j]['action_type']."</td>";
                    $tr.="<td>".$action[$j]['description']."</td>";
                    $tr.="<td>".$action[$j]['action_date']."</td>";
                           
                    if(isset($response[$j])){
                        $tr.="<td>".$response[$j]['response_type']."</td>";
                        $tr.="<td>".$response[$j]['description']."</td>";
                        $tr.="<td>".$response[$j]['response_date']."</td>";
                    }
                    else{
                            $tr.="<td>--</td>";
                            $tr.="<td>--</td>";
                            $tr.="<td>--</td>";
                        }
                           
                        $tr.="</tr>";            
                }

                if($flag!=true)
                    $tr.="<tr><td colspan=\"8\"><a style=\"cursor:pointer;\" data-toggle=\"collapse\" data-target=\".accordian\"><span class=\"fa fa-toggle-down\"></span></a></td></tr>";
                $tr.="</tbody>";
                return json_encode($tr);
                    
            if(count($action)==0)
            {
                return json_encode("<tbody>
                        <tr>
                          <th>Action Type</th>
                          <th>Action Description</th>
                          <th>Action Date</th>
                          <th>Response Type</th>
                          <th>Response Description</th>
                          <th>Response Date</th>
                        </tr><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody>");
            }
        }
        }
        else
            return view('errors.404Error');
    }
    public function anyNewTasks(Request $request){
        if(Auth::check() && Auth::user()->dept_id==Config::get('checkAuth.mrkExecutive')['dept_id'] && Auth::user()->post_id==Config::get('checkAuth.mrkExecutive')['post_id']){
                return json_encode(Task::select('task_id')->join('lead','user_task.lead_id','=','lead.lead_id')->join('employee','lead.emp_id','=','employee.emp_id')->where('employee.username','=',Auth::user()->username)->whereDate('user_task.schedule','=',date('Y-m-d'))->count());
        }
    }
    public function getServiceSubTypes($id){
        return json_encode(Organization_Service_subType::select('service_subtype_id','service_subtype_name')->where('service_type_id','=',$id)->get());
    }
    public function todayFollowUp(Request $request){
        $data=Lead::select('lead.lead_id','lead_source','address','organization_name','contact_person_name','mobile_no','email')->where('emp_id','=',Auth::user()->emp_id)->join('lead_response','lead.lead_id','=','lead_response.lead_id')->orderBy('lead_response.updated_at','dsc')->whereDate('lead_response.response_date','=',date('Y-m-d'))->where('isClose','=','0')->skip($request->input('start'))->take($request->input('end'))->where('isArchive','=','0')->get();
         $tr="";
         for ($i=0; $i <count($data) ; $i++) {
                $tr.= "<tr>";
                $tr.= "<td hidden>".$data[$i]['lead_id']."</td>";
                $tr.= "<td hidden>".$data[$i]['lead_source']."</td>";
                $tr.= "<td hidden>".$data[$i]['address']."</td>";
                $tr.= "<td>".$data[$i]['organization_name']."</td>";
                $tr.= "<td>".$data[$i]['contact_person_name']."</td>";
                $tr.= "<td>".$data[$i]['mobile_no']."</td>";
                $tr.= "<td>".$data[$i]['email']."</td>";
                $tr.= "<td>".$data[$i]['status']."</td>";
/*******************check last action and response is empty or not****************/
                $action_type;
                $response_type;
                if(Lead_Action::where('lead_id','=',$data[$i]['lead_id'])->exists())
                    $action_type=Lead_Action::where('lead_id','=',$data[$i]['lead_id'])->orderBy('updated_at','dsc')->pluck('description')[0];
                else
                    $action_type="--";
                if(Lead_Response::where('lead_id','=',$data[$i]['lead_id'])->exists())
                    $response_type=Lead_Response::where('lead_id','=',$data[$i]['lead_id'])->orderBy('updated_at','dsc')->pluck('description')[0];
                else
                    $response_type="--";
                                                
                $tr.= "<td>".$action_type."</td>";
                $tr.= "<td>".$response_type."</td>";
                $tr.= "<td><ul class=\"the_dropdown\" style=\"list-style-type: none;\">              
                                                    <li class=\"dropdown\">
                                                    <a  style=\" cursor:pointer;\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-delay=\"1000\" data-close-others=\"false\">
                                                      <span class=\"fa fa-cog\"></span> <b class=\"caret\"></b>
                                                    </a>
                                                    <ul class=\"dropdown-menu\" >
                                                      <li><a data-toggle=\"collapse\" class=\"follow-upAction\" data-target=\"#follow-upAction\">Follow-UpAction</a></li>
                                                      <li><a data-toggle=\"collapse\" class=\"follow-upResponse\" data-target=\"#follow-upResponse\">Follow-UpResponse</a></li>
                                                      <li><a data-toggle=\"collapse\" class=\"sendQuotation\" data-target=\"#sendQuotation\"  >SendQuotation</a></li>
                                                       <li><a  class=\"archive\" >addToArchive</a></li>
                                                    </ul>
                                                </li>
                                                </ul></td>";
                $tr.= "</tr>";
           }
        
        return json_encode($tr);
    }
    public function followUp(Request $request){
        $data= Lead::select('lead.lead_id','lead_source','address','organization_name','contact_person_name','mobile_no','email','status')->where('emp_id','=',Auth::user()->emp_id)->join('lead_response','lead.lead_id','=','lead_response.lead_id')->orderBy('lead_response.updated_at','dsc')->whereDate('lead_response.response_date','!=',date('Y-m-d'))->distinct()->where('isClose','=','0')->where('isArchive','=','0')->skip($request->input('start'))->take($request->input('end'))->get();
         $tr="";
         for ($i=0; $i <count($data) ; $i++) {
                $tr.= "<tr>";
                $tr.= "<td hidden>".$data[$i]['lead_id']."</td>";
                $tr.= "<td hidden>".$data[$i]['lead_source']."</td>";
                $tr.= "<td hidden>".$data[$i]['address']."</td>";
                $tr.= "<td>".$data[$i]['organization_name']."</td>";
                $tr.= "<td>".$data[$i]['contact_person_name']."</td>";
                $tr.= "<td>".$data[$i]['mobile_no']."</td>";
                $tr.= "<td>".$data[$i]['email']."</td>";
                $tr.= "<td>".$data[$i]['status']."</td>";
/*******************check last action and response is empty or not****************/
                $action_type;
                $response_type;
                if(Lead_Action::where('lead_id','=',$data[$i]['lead_id'])->exists())
                    $action_type=Lead_Action::where('lead_id','=',$data[$i]['lead_id'])->orderBy('updated_at','dsc')->pluck('description')[0];
                else
                    $action_type="--";
                if(Lead_Response::where('lead_id','=',$data[$i]['lead_id'])->exists())
                    $response_type=Lead_Response::where('lead_id','=',$data[$i]['lead_id'])->orderBy('updated_at','dsc')->pluck('description')[0];
                else
                    $response_type="--";
                                                
                $tr.= "<td>".$action_type."</td>";
                $tr.= "<td>".$response_type."</td>";
                $tr.= "<td><ul class=\"the_dropdown\" style=\"list-style-type: none;\">              
                                                    <li class=\"dropdown\">
                                                    <a  style=\" cursor:pointer;\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-delay=\"1000\" data-close-others=\"false\">
                                                      <span class=\"fa fa-cog\"></span> <b class=\"caret\"></b>
                                                    </a>
                                                    <ul class=\"dropdown-menu\" >
                                                      <li><a data-toggle=\"collapse\" class=\"follow-upAction\" data-target=\"#follow-upAction\">Follow-UpAction</a></li>
                                                      <li><a data-toggle=\"collapse\" class=\"follow-upResponse\" data-target=\"#follow-upResponse\">Follow-UpResponse</a></li>
                                                      <li><a data-toggle=\"collapse\" class=\"sendQuotation\" data-target=\"#sendQuotation\"  >SendQuotation</a></li>
                                                       <li><a  class=\"archive\" >addToArchive</a></li>
                                                    </ul>
                                                </li>
                                                </ul></td>";
                $tr.= "</tr>";
           }
        
        return json_encode($tr);
    }
    public function closeLeads(Request $request){
        $data=Lead::select('lead.lead_id','lead_source','address','organization_name','contact_person_name','mobile_no','email','status')->where('emp_id','=',Auth::user()->emp_id)->orderBy('updated_at','dsc')->where('isClose','=','1')->skip($request->input('start'))->take($request->input('end'))->where('isArchive','=','0')->get();
         $tr="";
         for ($i=0; $i <count($data) ; $i++) {
                $tr.= "<tr>";
                $tr.= "<td hidden>".$data[$i]['lead_id']."</td>";
                $tr.= "<td hidden>".$data[$i]['lead_source']."</td>";
                $tr.= "<td hidden>".$data[$i]['address']."</td>";
                $tr.= "<td>".$data[$i]['organization_name']."</td>";
                $tr.= "<td>".$data[$i]['contact_person_name']."</td>";
                $tr.= "<td>".$data[$i]['mobile_no']."</td>";
                $tr.= "<td>".$data[$i]['email']."</td>";
                $tr.= "<td>".$data[$i]['status']."</td>";
/*******************check last action and response is empty or not****************/
                $action_type;
                $response_type;
                if(Lead_Action::where('lead_id','=',$data[$i]['lead_id'])->exists())
                    $action_type=Lead_Action::where('lead_id','=',$data[$i]['lead_id'])->orderBy('updated_at','dsc')->pluck('description')[0];
                else
                    $action_type="--";
                if(Lead_Response::where('lead_id','=',$data[$i]['lead_id'])->exists())
                    $response_type=Lead_Response::where('lead_id','=',$data[$i]['lead_id'])->orderBy('updated_at','dsc')->pluck('description')[0];
                else
                    $response_type="--";
                                                
                $tr.= "<td>".$action_type."</td>";
                $tr.= "<td>".$response_type."</td>";
                $tr.= "<td><ul class=\"the_dropdown\" style=\"list-style-type: none;\">              
                                                    <li class=\"dropdown\">
                                                    <a  style=\" cursor:pointer;\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-delay=\"1000\" data-close-others=\"false\">
                                                      <span class=\"fa fa-cog\"></span> <b class=\"caret\"></b>
                                                    </a>
                                                    <ul class=\"dropdown-menu\" >
                                                      <li><a data-toggle=\"collapse\" class=\"follow-upAction\" data-target=\"#follow-upAction\">Follow-UpAction</a></li>
                                                      <li><a data-toggle=\"collapse\" class=\"follow-upResponse\" data-target=\"#follow-upResponse\">Follow-UpResponse</a></li>
                                                      <li><a data-toggle=\"collapse\" class=\"sendQuotation\" data-target=\"#sendQuotation\"  >SendQuotation</a></li>
                                                    </ul>
                                                </li>
                                                </ul></td>";
                $tr.= "</tr>";
           }
        
        return json_encode($tr);
    }
    public function newFollowUp(Request $request){
        $data=Lead::select('lead_id','lead_source','address','organization_name','contact_person_name','mobile_no','email','status')->where('emp_id','=',Auth::user()->emp_id)->where('isFollowUp','0')->orderBy('created_at','dsc')->skip($request->input('start'))->take($request->input('end'))->where('isArchive','=','0')->get();
        
         $tr="";
         for ($i=0; $i <count($data) ; $i++) {
                $tr.= "<tr>";
                $tr.= "<td hidden>".$data[$i]['lead_id']."</td>";
                $tr.= "<td hidden>".$data[$i]['lead_source']."</td>";
                $tr.= "<td hidden>".$data[$i]['address']."</td>";
                $tr.= "<td>".$data[$i]['organization_name']."</td>";
                $tr.= "<td>".$data[$i]['contact_person_name']."</td>";
                $tr.= "<td>".$data[$i]['mobile_no']."</td>";
                $tr.= "<td>".$data[$i]['email']."</td>";
                $tr.= "<td>".$data[$i]['status']."</td>";                              
                $tr.= "<td>--</td>";
                $tr.= "<td>--</td>";
                $tr.= "<td><ul class=\"the_dropdown\" style=\"list-style-type: none;\">              
                                                    <li class=\"dropdown\">
                                                    <a  style=\" cursor:pointer;\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-delay=\"1000\" data-close-others=\"false\">
                                                      <span class=\"fa fa-cog\"></span> <b class=\"caret\"></b>
                                                    </a>
                                                    <ul class=\"dropdown-menu\" >
                                                      <li><a data-toggle=\"collapse\" class=\"follow-upAction\" data-target=\"#follow-upAction\">Follow-UpAction</a></li>
                                                      <li><a data-toggle=\"collapse\" class=\"follow-upResponse\" data-target=\"#follow-upResponse\">Follow-UpResponse</a></li>
                                                      <li><a data-toggle=\"collapse\" class=\"sendQuotation\" data-target=\"#sendQuotation\"  >SendQuotation</a></li>
                                                    </ul>
                                                </li>
                                                </ul></td>";
                $tr.= "</tr>";
           }
        
        return json_encode($tr);
    }
     public function archiveLeads(Request $request){
        $data=Lead::select('lead.lead_id','lead_source','address','organization_name','contact_person_name','mobile_no','email','status')->where('emp_id','=',Auth::user()->emp_id)->orderBy('updated_at','dsc')->skip($request->input('start'))->take($request->input('end'))->where('isArchive','=','1')->get();
         $tr="";
         for ($i=0; $i <count($data) ; $i++) {
                $tr.= "<tr>";
                $tr.= "<td hidden>".$data[$i]['lead_id']."</td>";
                $tr.= "<td hidden>".$data[$i]['lead_source']."</td>";
                $tr.= "<td hidden>".$data[$i]['address']."</td>";
                $tr.= "<td>".$data[$i]['organization_name']."</td>";
                $tr.= "<td>".$data[$i]['contact_person_name']."</td>";
                $tr.= "<td>".$data[$i]['mobile_no']."</td>";
                $tr.= "<td>".$data[$i]['email']."</td>";
                $tr.= "<td>".$data[$i]['status']."</td>";
/*******************check last action and response is empty or not****************/
                $action_type;
                $response_type;
                if(Lead_Action::where('lead_id','=',$data[$i]['lead_id'])->exists())
                    $action_type=Lead_Action::where('lead_id','=',$data[$i]['lead_id'])->orderBy('updated_at','dsc')->pluck('description')[0];
                else
                    $action_type="--";
                if(Lead_Response::where('lead_id','=',$data[$i]['lead_id'])->exists())
                    $response_type=Lead_Response::where('lead_id','=',$data[$i]['lead_id'])->orderBy('updated_at','dsc')->pluck('description')[0];
                else
                    $response_type="--";
                                                
                $tr.= "<td>".$action_type."</td>";
                $tr.= "<td>".$response_type."</td>";
                $tr.= "<td><ul class=\"the_dropdown\" style=\"list-style-type: none;\">              
                                                    <li class=\"dropdown\">
                                                    <a  style=\" cursor:pointer;\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-delay=\"1000\" data-close-others=\"false\">
                                                      <span class=\"fa fa-cog\"></span> <b class=\"caret\"></b>
                                                    </a>
                                                    <ul class=\"dropdown-menu\" >
                                                      <li><a data-toggle=\"collapse\" class=\"follow-upAction\" data-target=\"#follow-upAction\">Follow-UpAction</a></li>
                                                      <li><a data-toggle=\"collapse\" class=\"follow-upResponse\" data-target=\"#follow-upResponse\">Follow-UpResponse</a></li>
                                                      
                                                    </ul>
                                                </li>
                                                </ul></td>";
                $tr.= "</tr>";
           }
        
        return json_encode($tr);
    }
  
}
