<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;

use App\Area;
use App\State;
use App\User_Location;
use App\Equipments;
use App\Place_Order;
use App\Request_call;
use App\UserLogin;
use App\Client;
use Auth;
class CustomerController extends Controller
{
    public function dashboard(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('dashboard')==$token){
            

            return view('dashboard');
        }
        return view('errors.404Error');
    }
    public function requestCall(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('requestCall')==$token){
            $a_id=User_Location::select('a_id')->where('usr_id','=',Auth::user()->user_id)->distinct()->get();
            $arr=[];
            for($i=0;$i<count($a_id);$i++){
                $arr[$i]=Area::select('area_name','a_id')->where('a_id','=',$a_id[$i]['a_id'])->get()[0];
            }
            return view('requestCall')->with('area',$arr);
        }
        return view('errors.404Error');
    }
    public function manageCall(Request $request ,$token=null){
        if(Auth::check() && $request->session()->get('manageCall')==$token){
            $popupStr="";
            $request_call=Request_call::select('created_at','a_id','engineer_name','status')->where('usr_id','=',Auth::user()->user_id)->get();
            $tr="";
            for($i=0;$i<count($request_call);$i++){
                $tr.="<tr>\n";
                $tr.="\t<td>".$request_call[$i]['created_at']."</td>\n";
                $tr.="\t<td></td>\n";
                $tr.="\t<td>".Area::select('area_name')->where('a_id','=',$request_call[$i]['a_id'])->get()[0]['area_name']."</td>\n";
                $tr.="\t<td>".$request_call[$i]['engineer_name']."</td>\n";
                $tr.="\t<td></td>\n";
                if($request_call[$i]['status']=='Open'){
                     $tr.="<td><button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#open_popup\">".$request_call[$i]['status']."</button></td>";
                     $popupStr.="<!-- Modal -->
                        <div class=\"modal fade\" id=\"open_popup\" role=\"dialog\">
                            <div class=\"modal-dialog\">
    
                            <!-- Modal content-->
                            <div class=\"modal-content\">
                                <div class=\"modal-header\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                    <h4 class=\"modal-title\">Open</h4>
                                </div>
                                <div class=\"modal-body\">
                                    <p>This is open status.</p>
                                </div>
                                <div class=\"modal-footer\">
                                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                                </div>
                            </div>
                        </div>
                        </div>";
                }
                else if($request_call[$i]['status']=='Allocated'){
                    $tr.="<td><button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#allocated_popup\">".$request_call[$i]['status']."</button></td>";
                    $popupStr.="<!-- Modal -->
                        <div class=\"modal fade\" id=\"allocated_popup\" role=\"dialog\">
                            <div class=\"modal-dialog\">
    
                            <!-- Modal content-->
                            <div class=\"modal-content\">
                                <div class=\"modal-header\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                    <h4 class=\"modal-title\">Allocated</h4>
                                </div>
                                <div class=\"modal-body\">
                                    <p>This is allocated status.</p>
                                </div>
                                <div class=\"modal-footer\">
                                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                                </div>
                            </div>
                        </div>
                        </div>";
                }
                else{
                    $tr.="<td><button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#close_popup\">".$request_call[$i]['status']."</button></td>";
                    $popupStr.="<!-- Modal -->
                        <div class=\"modal fade\" id=\"close_popup\" role=\"dialog\">
                            <div class=\"modal-dialog\">
    
                            <!-- Modal content-->
                            <div class=\"modal-content\">
                                <div class=\"modal-header\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                    <h4 class=\"modal-title\">Close</h4>
                                </div>
                                <div class=\"modal-body\">
                                    <p>This is close status.</p>
                                </div>
                                <div class=\"modal-footer\">
                                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                                </div>
                            </div>
                        </div>
                        </div>";
                }
                $tr.="</tr>\n";
            }
            return view('manageCall')->with('tr',$tr)->with('popup',$popupStr);
        }
        return view('errors.404Error');
    }
    public function callHistory(Request $request ,$token=null){
        if(Auth::check() && $request->session()->get('callHistory')==$token){
            return view('callHistory');
        }
        return view('errors.404Error');
    }
    public function placeOrder(Request $request ,$token=null){
        if(Auth::check() && $request->session()->get('placeOrder')==$token){    
            return view('placeOrder');
        }
        return view('errors.404Error');   
    }
    
    public function productHistory(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('productHistory')==$token){
            $plorder=Place_Order::select('plorder_id','created_at','product_name','discription','status')->where('user_id','=',Auth::user()->user_id)->get();
            $tr="";
            for($i=0;$i<count($plorder);$i++){
                $tr.="<tr>\n";
                $tr.="\t<td>".$plorder[$i]['plorder_id']."</td>\n";
                $tr.="\t<td>".$plorder[$i]['created_at']."</td>\n";
                $tr.="\t<td>".$plorder[$i]['product_name']."</td>\n";
                $tr.="\t<td>".$plorder[$i]['discription']."</td>\n";
                $tr.="\t<td></td>\n";
                $tr.="\t<td>".$plorder[$i]['status']."</td>\n";
                $tr.="</tr>\n";
            }
            return view('productHistory')->with('tr',$tr);
        }
        return view('errors.404Error');
    }
    public function addDevice(Request $request,$token=null){

        if(Auth::check() && $request->session()->get('addDevice')==$token){
            $l_id=User_Location::select('a_id')->where('usr_id','=',Auth::user()->user_id)->distinct()->get();
            $arr=[];
            for($i=0;$i<count($l_id);$i++){
                $arr[$i]=Area::select('area_name','a_id')->where('a_id','=',$l_id[$i]['a_id'])->get()[0];
            }
            return view('addDevice')->with('area',$arr);
        }
        return view('errors.404Error');
    }
    public function manageDevice(Request $request,$token=null){

        if(Auth::check() && $request->session()->get('manageDevice')==$token){
             $l_id=User_Location::select('a_id')->where('usr_id','=',Auth::user()->user_id)->distinct()->get();
            $arr=[];
            for($i=0;$i<count($l_id);$i++){
                $arr[$i]=Area::select('area_name','a_id')->where('a_id','=',$l_id[$i]['a_id'])->get()[0];
            }
            $equ=Equipments::select('equ_id','area.area_name','equ_name','model_no','serial_no','equ_discription','status')->where('usr_id','=',Auth::user()->user_id)->join('area','teqcare_equipment.a_id','=','area.a_id')->get();
            $tr="";

            for($i=0;$i<count($equ);$i++){
                $tr.="<tr>\n";
                $tr.="\t<td hidden>".$equ[$i]['equ_id']."</td>\n";
                $tr.="\t<td>".$equ[$i]['area_name']."</td>\n";
                $tr.="\t<td></td>\n";
                $tr.="\t<td>".$equ[$i]['equ_name']."<br>".$equ[$i]['model_no']."<br>".$equ[$i]['serial_no']."</td>\n";
                $tr.="\t<td>".$equ[$i]['equ_discription']."</td>\n";
                $tr.="\t<td>".$equ[$i]['status']."</td>\n";
                $tr.="\t<td>"."<a class=\"btn btn-info btn-xs edit\" data-toggle=\"collapse\" data-target=\"#edit\"><i class=\"fa fa-pencil\"></i> Edit </a><br>
                            <a href=\"#\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash-o\"></i> Scrape </a>"."</td>\n";
                $tr.="</tr>\n";
            }
            return view('manageDevice')->with('tr',$tr)->with('area',$arr);
        }
        return view('errors.404Error');
    }
    public function profile(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('profile')==$token){
            return view('profile')->with('contact',Client::select('contactPerson_name')->get()[0]['contactPerson_name'])->with('organization',Client::select('organisation_name')->get()[0]['organisation_name'])->with('email',UserLogin::select('email')->get()[0]['email'])->with('address',Client::select('address')->get()[0]['address']);
        }
        return view('errors.404Error');
    }                                                                            
    public function addLocation(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('addLocation')==$token){
            return view('addLocation')->with('state',State::select('state_name','s_id')->get());
        }
        return view('errors.404Error');
    }   

    public function changePassword(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('changePassword')==$token){
            return view('changePassword');
        }
        return view('errors.404Error');
    }   
}