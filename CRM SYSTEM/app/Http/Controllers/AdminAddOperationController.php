<?php

namespace App\Http\Controllers;
/************************************Author:Amol Tribhuwan***********************************************/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\State;
use App\District;
use App\City;
use App\Area;
use App\Department;
use App\Roles;
use App\UserLogin;
use App\ACL;
use App\Menu;
use App\Work_charge;
use App\Post;
use Config;
class AdminAddOperationController extends Controller
{
    public function addState(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
            if(State::where('state_name','=',$request->input('addState_name'))->exists())
                return redirect()->back()->with('errorMsg','State Already Exists');
    		$state=new State();
    		$state->state_name=$request->input('addState_name');
    		$state->state_code=$request->input('addState_code');
            $state->created_by=Auth::user()->emp_id;
    		$state->save();
    		return redirect()->back()->with('succMsg','record add successfully');
    	}
    	else
    		return view('errors.404Error');
    }

    public function addDistrict(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
            if(District::where('district_name','=',$request->input('addDistrict_name'))->where('state_id','=',$request->input('addState'))->exists())
                return redirect()->back()->with('errorMsg','District  Already Exists');
    		$district=new District();
    		$district->state_id=$request->input('addState');
    		$district->district_name=$request->input('addDistrict_name');
            $district->created_by=Auth::user()->emp_id;
    		$district->save();
    		return redirect()->back()->with('succMsg','record add successfully');
    	}
    	else
    		return view('errors.404Error');
    }

    public function addCity(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
            if(City::where('city_name','=',$request->input('addCity_name'))->where('district_id','=',$request->input('addDistrict'))->exists())
                return redirect()->back()->with('errorMsg','City Already Exists');
    		$city=new City();
    		$city->district_id=$request->input('addDistrict');
    		$city->city_name=$request->input('addCity_name');
            $city->created_by=Auth::user()->emp_id;
    		$city->save();
    		return redirect()->back()->with('succMsg','record add successfully');
    	}
    	else
    		return view('errors.404Error');
    }

    public function addArea(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
            if(Area::where('area_name','=',$request->input('addArea_name'))->where('city_id','=',$request->input('addCity'))->exists())
                return redirect()->back()->with('errorMsg','Area Already Exists');
    		$area=new Area();
    		$area->city_id=$request->input('addCity');
    		$area->area_name=$request->input('addArea_name');
            $area->created_by=Auth::user()->emp_id;
    		$area->save();
    		return redirect()->back()->with('succMsg','record add successfully');
    	}
    	else
    		return view('errors.404Error');
    }

   
    public function addDepartment(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
            if(Department::where('dept_name','=',$request->input('addDepartment_name'))->exists())
                return redirect()->back()->with('errorMsg','Department Already Exists');
    		$department=new Department();
    		$department->dept_name=$request->input('addDepartment_name');
            $department->created_by=Auth::user()->emp_id;
    		$department->save();
    		return redirect()->back()->with('succMsg','record add successfully');
    	}
    	else
    		return view('errors.404Error');
    }

    public function addRole(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
            if(Roles::where('role_name','=',$request->input('addRole_name'))->exists())
                return redirect()->back()->with('errorMsg','Role Already Exists');
    		$role=new Roles();
    		$role->role_name=$request->input('addRole_name');
            $role->hr_level=$request->input('addRole_level');
            $role->created_by=Auth::user()->emp_id;
    		$role->save();
    		return redirect()->back()->with('succMsg','record add successfully');
    	}
    	else
    		return view('errors.404Error');
    }

    
    public function addEmployee(Request $request,$token=null){

        if(Auth::check() && $token!=null){
            if(Userlogin::where('username','=',$request['username'])->exists())
                return redirect()->back()->with('errorMsg','Username Already Exists');

            $emp = new UserLogin();
            $emp->full_name=$request['full_name'];
            $emp->gender=$request['gender'];
            $emp->dob=$request['dob'];
            $emp->email=$request['email'];
            $emp->mobile=$request['mobile'];
            $emp->qualification=$request['qualification'];
            $emp->permenent_address=$request['permenent_address'];
            $emp->username=$request['username'];
            $emp->password=bcrypt($request['password']);
            $emp->dept_id=$request['department'];
            $emp->post_id=$request['post'];
            $emp->area_type_id=$request['areaType'];
            if($request['areaType']==1){$emp->area_id=$request['global']; }else if($request['areaType']==2){$emp->area_id=$request['country'];}else if($request['areaType']==3){$emp->area_id=$request['state'];}else{$emp->area_id=$request['district'];}
            $emp->created_by=Auth::user()->emp_id;
            $emp->save();
            
            $result=[];
            for($i=0;$i<Menu::where('dept_id','=',$request->input('department'))->count();$i++){

                    if(Input::has('subMenu'.(string)$i)){
                        for($j=0;$j<count($request->input('subMenu'.(string)$i));$j++){
                         $result[]=array('emp_id'=>$emp->emp_id,
                                            'menu_id'=>$request->input('menu'.(string)$i),
                                            'subMenu_id'=>$request->input('subMenu'.(string)$i)[$j]);
                             }
                        }
                        else{
                                if(Input::has('menu'.(string)$i))
                                    ACL::insert(array('emp_id'=>$emp->emp_id,'menu_id'=>$request->input('menu'.(string)$i)));
                        }
                   }
            
            ACL::insert($result);
            return redirect()->back()->with('succMsg','Employee Added Successfully');
        }
        else
            return view('errors.404Error');
    }



    public function addWorkCharge(Request $request,$token=null){

        if(Auth::check() && $token!=null){
            $work=new Work_charge();
            $work->charge_name=$request->input('addCharge_name');
            $work->created_by=Auth::user()->emp_id;
            $work->save();
            return redirect()->back()->with('succMsg','Work Charge Added Successfully');
        }
        else
            return view('errors.404Error');
    }
    public function addPost(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            $post=new Post();
            $post->role_id=$request->input('addRole');
            $post->charge_id=$request->input('addWorkCharge');
            $post->post_name=$request->input('addPost_name');
            $post->superior=$request->input('addSuperior');
            $post->created_by=Auth::user()->emp_id; 
            $post->save();
            return redirect()->back()->with('succMsg','Post Added Successfully');
        }
        else
            return view('errors.404Error');
    }
    /*******************************************End Amol**************************************************************/
}