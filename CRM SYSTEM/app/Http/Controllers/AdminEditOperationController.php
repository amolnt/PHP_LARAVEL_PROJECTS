<?php
/*************************************Author:Amol Tribhuwan************************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\State;
use App\District;
use App\City;
use App\Area;
use App\Department;
use App\Roles;
use App\ACL;
use App\Menu;
use App\UserLogin;
use Crypt;
use Config;
use Mcrypt;
use App\Work_charge;
use App\Post;
class AdminEditOperationController extends Controller
{

	public function updateState(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
    		State::where('state_id','=',$request->input('editState_id'))->update(['state_name'=>$request->input('editState_name'),'state_code'=>$request->input('editState_code'),'updated_by'=>Auth::user()->emp_id]);

    		return redirect()->back()->with('succMsg','Record Update Successfully');
    	}
    	else
    		return view('errors.404Error');	
    }

    public function updateDistrict(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
    		District::where('district_id','=',$request->input('editDistrict_id'))->update(['state_id'=>$request->input('editState'),'district_name'=>$request->input('editDistrict_name'),'updated_by'=>Auth::user()->emp_id]);
    		return redirect()->back()->with('succMsg','record update successfully');
    	}
    	else
    		return view('errors.404Error');	
    }

    public function updateCity(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
    		City::where('city_id','=',$request->input('editCity_id'))->update(['district_id'=>$request->input('editDistrict'),'city_name'=>$request->input('editCity_name'),'updated_by'=>Auth::user()->emp_id]);
    		return redirect()->back()->with('succMsg','record update successfully');
    	}
    	else
    		return view('errors.404Error');	
    }

    public function updateArea(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
    		Area::where('area_id','=',$request->input('editArea_id'))->update(['city_id'=>$request->input('editCity'),'area_name'=>$request->input('editArea_name'),'updated_by'=>Auth::user()->emp_id]);
    		return redirect()->back()->with('succMsg','record update successfully');
    	}
    	else
    		return view('errors.404Error');	
    }

    public function updateDepartment(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
    		Department::where('dept_id','=',$request->input('editDepartment_id'))->update(['dept_name'=>$request->input('editDepartment_name'),'updated_by'=>Auth::user()->emp_id]);
    		return redirect()->back()->with('succMsg','record update successfully');
    	}
    	else
    		return view('errors.404Error');	
    }

    public function updateRole(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
    		Roles::where('role_id','=',$request->input('editRole_id'))->update(['role_name'=>$request->input('editRole_name'),'hr_level'=>$request->input('editRole_level'),'updated_by'=>Auth::user()->emp_id]);
    		return redirect()->back()->with('succMsg','record update successfully');
    	}
    	else
    		return view('errors.404Error');	
    }
    public function updateEmployee(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            
            $area=null;
            if($request->input('areaType')==1){$area=$request->input('global'); }else if($request->input('areaType')==2){$area=$request->input('country');}else if($request->input('areaType')==3){$area=$request->input('state');}else{$area=$request->input('district');}

            if($request->input('check')=="chk"){
                UserLogin::where('emp_id','=',$request->input('emp'))->update(['full_name' => $request->input('full_name'),
                                                                                'dob' =>$request->input('dob'),
                                                                                'email' =>$request->input('email'),
                                                                                'mobile' =>$request->input('mobile'),
                                                                                'qualification'=>$request->input('qualification'),
                                                                                'username'=>$request->input('username'),
                                                                                'password'=>bcrypt($request->input('newPassword')),
                                                                                'post_id'=>$request->input('post'),
                                                                                'dept_id'=>$request->input('department'),
                                                                                'area_type_id'=>$request->input('areaType'),
                                                                                'area_id'=>$area,'updated_by'=>Auth::user()->emp_id]);
            }else{
                UserLogin::where('emp_id','=',$request->input('emp'))->update(['full_name' => $request->input('full_name'),
                                                                                'dob' =>$request->input('dob'),
                                                                                'email' =>$request->input('email'),
                                                                                'mobile' =>$request->input('mobile'),
                                                                                'qualification'=>$request->input('qualification'),
                                                                                'username'=>$request->input('username'),
                                                                                'post_id'=>$request->input('post'),
                                                                                'dept_id'=>$request->input('department'),
                                                                                'area_type_id'=>$request->input('areaType'),
                                                                                'area_id'=>$area,'updated_by'=>Auth::user()->emp_id]);
            }
            $acl_id=ACL::select('acl_id')->where('emp_id','=',$request->input('emp'))->get();
            for($i=0;$i<Menu::where('dept_id','=',$request->input('department'))->count();$i++){
                    if(Input::has('subMenu'.(string)$i) && Input::has('menu'.(string)$i) ){

                    for($j=0;$j<count($request->input('subMenu'.(string)$i));$j++){
                        /*****************check for menu under submenu is exists********************/
                       if(ACL::where('emp_id','=',$request->input('emp'))->where('menu_id','=',$request->input('menu'.(string)$i))->where('subMenu_id','=',$request->input('subMenu'.(string)$i)[$j])->exists()){
                            $del=0;
                            
                            foreach ($acl_id as $key => $value) {
                                if($value['acl_id']==ACL::select('acl_id')->where('emp_id','=',$request->input('emp'))->where('menu_id','=',$request->input('menu'.(string)$i))->where('subMenu_id','=',$request->input('subMenu'.(string)$i)[$j])->get()[0]['acl_id']){
                                    
                                    ACL::where('acl_id','=',$value['acl_id'])->update(['isShow'=>1,'updated_by'=>Auth::user()->emp_id]);
                                    unset($acl_id[$del]['acl_id']);
                                    }
                                    $del++;
                                }
                        }
                        else{
                               /*************To add new sub menus*************************/
                               ACL::insert(array('emp_id'=>$request->input('emp'),
                                                'menu_id'=>$request->input('menu'.(string)$i),
                                                'subMenu_id'=>$request->input('subMenu'.(string)$i)[$j],
                                                'isShow'=>1,'created_by'=>Auth::user()->emp_id));
                            }

                        }

                        /**************if not select the submenu then hide that submenu********************/
                       /* for($k=0;$k<count($acl_id);$k++){
                            if(count($acl_id[$k]['acl_id'])!=0){
                                ACL::where('acl_id','=',$acl_id[$k]['acl_id'])->update(['isShow'=>0]);
                                unset($acl_id[$k]['acl_id']);
                            }
                        }*/
                }
                else{
                    if(Input::has('menu'.(string)$i)){
                        if(!ACL::where('emp_id','=',$request->input('emp'))->where('menu_id','=',$request->input('menu'.(string)$i))->exists()){
                               /*************To add new menus*************************/
                               ACL::insert(array('emp_id'=>$request->input('emp'),
                                                'menu_id'=>$request->input('menu'.(string)$i),
                                                'isShow'=>1,'created_by'=>Auth::user()->emp_id));
                            }
                    else{

                        /*******************if i select only on menu then check that menu submenu showing status if 1 then change to 0******************/
                        if(ACL::select('acl_id')->where('menu_id','=',$request->input('menu'.(string)$i))->where('isShow','=','0')->where('emp_id','=',$request->input('emp'))->exists()){
                            
                            $menuAcl=ACL::select('acl_id')->where('menu_id','=',$request->input('menu'.(string)$i))->where('isShow','=','0')->where('emp_id','=',$request->input('emp'))->get();
                                
                                for($l=0;$l<count($menuAcl);$l++){
                                for($m=0;$m<count($acl_id);$m++){
                                  if(count($acl_id[$m]['acl_id'])!=0){  
                                   if($acl_id[$m]['acl_id']==$menuAcl[$l]['acl_id']){
                                        ACL::where('acl_id','=',$acl_id[$m]['acl_id'])->update(['isShow'=>1,'updated_by'=>Auth::user()->emp_id]);
                                        unset($acl_id[$m]['acl_id']);
                                    }
                                }
                            }
                        }   
                        }//end 1 to 0  1:show 0:hide
                    }//end if menu aleady exists
                  }//end if request menu[] variable is exists
                }//else for if not select submenu under menu
            }//end for
            /**************************if hide menu wise************************************************/
            for($k=0;$k<count($acl_id);$k++){
                if(count($acl_id[$k]['acl_id'])!=0){
                ACL::where('acl_id','=',$acl_id[$k]['acl_id'])->update(['isShow'=>0,'updated_by'=>Auth::user()->emp_id]);
                    
                }
            }
            return redirect()->back()->with('succMsg','record update successfully');
        }
        else
            return view('errors.404Error'); 
    }

    public function updateWorkCharge(Request $request,$token=null){
        if(Auth::check() && $token!=null){
           Work_charge::where('charge_id','=',$request->input('charge'))->update(['charge_name'=>$request->input('editCharge_name'),'updated_by'=>Auth::user()->emp_id]);
            return redirect()->back()->with('succMsg','record updated Successfully');
        }
        else
            return view('errors.404Error');
    }
    public function updatePost(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            Post::where('post_id','=',$request->input('post'))->update(['role_id'=>$request->input('editRole'),
                                                                        'charge_id'=>$request->input('editWorkCharge'),
                                                                        'post_name'=>$request->input('editPost_name'),
                                                                        'superior'=>$request->input('editSuperior'),'updated_by'=>Auth::user()->emp_id]);
            return redirect()->back()->with('succMsg','record updated Successfully');
        }
        else
            return view('errors.404Error');
    }
    /**********************************End Amol*****************************************************************************/
}
