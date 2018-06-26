<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;

use App\User_Location;
use App\Equipments;
use App\Request_call;
use App\UserLogin;
use App\Area;
use App\State;
use App\Place_Order;
use Auth;
use Crypt;

class CustomController extends Controller
{
    public function getEquipments(Request $request,$id){
    	return json_encode(Equipments::select('equ_id','equ_name')->where('a_id','=',$id)->where('usr_id','=',Auth::user()->user_id)->get());
    }
    public function getDiscription($id){
    	return json_encode(Equipments::select('equ_discription')->where('equ_id','=',$id)->get());
    }

    public function getBarChart(Request $request){
            $arr=array(array('open'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('1'))->where('status','=','Open')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'allocate'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('1'))->where('status','=','Allocate')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'close'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('1'))->where('status','=','Close')->where('usr_id','=',Auth::user()->user_id)->count()),
                        array('open'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('2'))->where('status','=','Open')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'allocate'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('2'))->where('status','=','Allocate')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'close'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('2'))->where('status','=','Close')->where('usr_id','=',Auth::user()->user_id)->count()),
                        array('open'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('3'))->where('status','=','Open')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'allocate'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('3'))->where('status','=','Allocate')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'close'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('3'))->where('status','=','Close')->where('usr_id','=',Auth::user()->user_id)->count()),
                        array('open'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('4'))->where('status','=','Open')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'allocate'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('4'))->where('status','=','Allocate')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'close'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('4'))->where('status','=','Close')->where('usr_id','=',Auth::user()->user_id)->count()),
                        array('open'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('5'))->where('status','=','Open')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'allocate'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('5'))->where('status','=','Allocate')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'close'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('5'))->where('status','=','Close')->where('usr_id','=',Auth::user()->user_id)->count()),
                        array('open'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('6'))->where('status','=','Open')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'allocate'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('6'))->where('status','=','Allocate')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'close'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('6'))->where('status','=','Close')->where('usr_id','=',Auth::user()->user_id)->count()),
                        array('open'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('7'))->where('status','=','Open')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'allocate'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('7'))->where('status','=','Allocate')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'close'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('7'))->where('status','=','Close')->where('usr_id','=',Auth::user()->user_id)->count()),
                        array('open'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('8'))->where('status','=','Open')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'allocate'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('8'))->where('status','=','Allocate')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'close'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('8'))->where('status','=','Close')->where('usr_id','=',Auth::user()->user_id)->count()),
                        array('open'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('9'))->where('status','=','Open')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'allocate'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('9'))->where('status','=','Allocate')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'close'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('9'))->where('status','=','Close')->where('usr_id','=',Auth::user()->user_id)->count()),
                        array('open'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('10'))->where('status','=','Open')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'allocate'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('10'))->where('status','=','Allocate')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'close'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('10'))->where('status','=','Close')->where('usr_id','=',Auth::user()->user_id)->count()),
                        array('open'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('11'))->where('status','=','Open')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'allocate'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('11'))->where('status','=','Allocate')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'close'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('11'))->where('status','=','Close')->where('usr_id','=',Auth::user()->user_id)->count()),
                        array('open'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('12'))->where('status','=','Open')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'allocate'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('12'))->where('status','=','Allocate')->where('usr_id','=',Auth::user()->user_id)->count(),
                              'close'=>Request_call::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('12'))->where('status','=','Close')->where('usr_id','=',Auth::user()->user_id)->count()));
            return json_encode($arr);
    }

    public function getDoughnutChart(Request $request){
       
        $arr=array('laptop'=>Place_Order::where('product_type','LIKE','Laptop')->whereRaw('year(`created_at`) = ?', array(date('Y')))->where('user_id','=',Auth::user()->user_id)->count(),
                   'desktop'=>Place_Order::where('product_type','LIKE','Desktop')->whereRaw('year(`created_at`) = ?', array(date('Y')))->where('user_id','=',Auth::user()->user_id)->count(),
                   'tab'=>Place_Order::where('product_type','LIKE','Tab')->count(),
                    'printer'=>Place_Order::where('product_type','LIKE','Printer')->whereRaw('year(`created_at`) = ?', array(date('Y')))->where('user_id','=',Auth::user()->user_id)->count(),
                    'scanner'=>Place_Order::where('product_type','LIKE','Scanner')->whereRaw('year(`created_at`) = ?', array(date('Y')))->where('user_id','=',Auth::user()->user_id)->count(),
                    'software'=>Place_Order::where('product_type','LIKE','Software')->whereRaw('year(`created_at`) = ?', array(date('Y')))->where('user_id','=',Auth::user()->user_id)->count(),
                    'network'=>Place_Order::where('product_type','LIKE','Network_Device')->whereRaw('year(`created_at`) = ?', array(date('Y')))->where('user_id','=',Auth::user()->user_id)->count(),
                    'other'=>Place_Order::where('product_type','LIKE','Other')->whereRaw('year(`created_at`) = ?', array(date('Y')))->where('user_id','=',Auth::user()->user_id)->count());
        return json_encode($arr);
    }

    public function getPieChart(Request $request){
        $arr=array('laptop'=>Equipments::where('equ_type','LIKE','Laptop')->where('usr_id','=',Auth::user()->user_id)->count(),
                   'desktop'=>Equipments::where('equ_type','LIKE','Desktop')->where('usr_id','=',Auth::user()->user_id)->count(),
                   'tab'=>Equipments::where('equ_type','LIKE','Tab')->where('usr_id','=',Auth::user()->user_id)->count(),
                    'printer'=>Equipments::where('equ_type','LIKE','Printer')->where('usr_id','=',Auth::user()->user_id)->count(),
                    'scanner'=>Equipments::where('equ_type','LIKE','Scanner')->where('usr_id','=',Auth::user()->user_id)->count(),
                    'software'=>Equipments::where('equ_type','LIKE','Software')->where('usr_id','=',Auth::user()->user_id)->count(),
                    'network'=>Equipments::where('equ_type','LIKE','Network_Device')->where('usr_id','=',Auth::user()->user_id)->count(),
                    'other'=>Equipments::where('equ_type','LIKE','Other')->where('usr_id','=',Auth::user()->user_id)->count());
        return json_encode($arr);
    }
    public function addRequest(Request $request){

        if(Auth::check()){
            $l_id=User_Location::select('a_id')->where('usr_id','=',Auth::user()->user_id)->distinct()->get();
            $arr=[];
            for($i=0;$i<count($l_id);$i++){
                $arr[$i]=Area::select('area_name','a_id')->where('a_id','=',$l_id[$i]['a_id'])->get()[0];
            }

    	   $file=$request->file('file');
    	   if(!empty($file)){
    		  if($file->getClientOriginalExtension()!='jpg'){
    		      return redirect()->back()->with('message','upload valid file');
    		    }

    		      if($file->getSize()>=204800){
            	       return redirect()->back()->with('message','file size exceed')->with('locations',$arr);
    		      }
    		      $request_call->problem_snapshot=base64_encode(file_get_contents(Input::file('file')->getRealPath()));
    	   }
    	   $request_call=new Request_call();
    	   $request_call->a_id=Input::get('area');
    	   $request_call->equ_id=Input::get('equipments');
            $request_call->usr_id=Auth::user()->user_id;
    	   $request_call->problem= Input::get('problem');
    	   $request_call->save();
    	   return redirect()->back()->with('succMsg','request save succesfully'); 
        }
        return view('errors.404Error');
    }


    public function changePassword(Request $req){
        if(Auth::check()){
            if(password_verify($req['oldPassword'],UserLogin::select('password')->where('user_id','=',Auth::user()->user_id)->get()[0]['password']))
            {
                UserLogin::where('user_id',Auth::user()->user_id)->update(['password'=>bcrypt(Input::get('newPassword'))]);
                return redirect()->back()->with('succMsg','password change successfully');
            }
            else
                return redirect()->back()->with('errorMsg','old password incorrect');
        } 
        return view('errors.404Error');
    }

    public function addLocation(Request $request){
        if(Auth::check()){
            $location=new User_Location();
            $location->usr_id=Auth::user()->user_id;
            $location->s_id=Input::get('state');
            $location->d_id=Input::get('district');
            $location->c_id=Input::get('city');
            $location->a_id=Input::get('area');
            $location->address1=Input::get('address1');
            $location->address2=Input::get('address2');
            $location->pincode=Input::get('pincode');
            $location->save();

            return redirect()->back()->with('succMsg','location add successfully');
        }
        return view('errors.404Error');
    }


    public function addEquipment(Request $request){
        if(Auth::check()){
            $equipment= new Equipments();
            $equipment->a_id=Input::get('area');
            $equipment->usr_id=Auth::user()->user_id;
            $equipment->equ_type=Input::get('equ_type');
            $equipment->equ_name=Input::get('equ_name');
            $equipment->model_no=Input::get('model_no');
            $equipment->serial_no=Input::get('serial_no');
            $equipment->equ_discription=Input::get('equ_discription');
            $equipment->save();

            return redirect()->back()->with('succMsg','equipment add successfully');
        }
        return view('errors.404Error');
    }


    public function placeOrder(Request $request){
        if(Auth::check()){
            $plOrder= new Place_Order();
            $plOrder->user_id=Auth::user()->user_id;
            $plOrder->product_type=Input::get('product_type');
            $plOrder->product_name=Input::get('product_name');
            $plOrder->model_no=Input::get('model_no');
            $plOrder->serial_no=Input::get('serial_no');
            $plOrder->discription=Input::get('discription');
            $plOrder->save();
            return redirect()->back()->with('succMsg','place order successfully');
        }
        return view('errors.404Error');
    }

     public function updateEquipment(Request $request){
        if(Auth::check()){
            Equipments::where('equ_id','=',Input::get('equipment'))->update(['a_id'=>Input::get('area'),'usr_id'=>Auth::user()->user_id,'equ_type'=>Input::get('equ_type'),'equ_name'=>Input::get('equ_name'),'model_no'=>Input::get('model_no'),'serial_no'=>Input::get('serial_no'),'equ_discription'=>Input::get('equ_discription')]);

            return redirect()->back()->with('succMsg','equipment updated successfully');
        }
        return view('errors.404Error');
    }

    public function getEquipment(Request $request,$id){
        return json_encode(Equipments::select('a_id','equ_type','equ_name','model_no','serial_no','equ_discription')->get()[0]);
    }
}