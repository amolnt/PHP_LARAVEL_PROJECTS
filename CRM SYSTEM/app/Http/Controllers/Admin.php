<?php

namespace App\Http\Controllers;
/******************************************ALL FUNCTION ARE ACCESS USING AJAX*******************************/
/***********************************************Author:Amol Tribhuwan*****************************************/
use Illuminate\Http\Request;
use App\Roles;
use Auth;
use App\Menu;
use App\SubMenu;
use App\Department;
use App\District;
use App\City;
use App\Area;
use App\ACL;
use Config;
use App\Area_type;
use App\Country;
use App\Post;
use App\State;
use App\UserLogin;
class Admin extends Controller
{
    
    public function getSuperior(Request $request,$id){
    	if(Auth::check() ){
    		$split=str_split(Roles::select('hr_level')->where('role_id','=',$id)->get()[0]['hr_level']);
    		if(intval($split[1])!=0){
    			return json_encode($split[0]."".(string)(intval($split[1])-1));//split superior string and decrease in one to superior
    		}
    	}
    	else
    		return view('errors.404Error');	
    }
    public function getMenuSubMenu(Request $request){
        if(Auth::check()){
            $menu=Menu::select('menu_id','menu_name')->where('dept_id','=',$request->input('dept_id'))->get();
            $subMenu=SubMenu::select('subMenu_id','subMenu_name')->where('dept_id','=',$request->input('dept_id'))->get();
            /********************base case**************************/
            if(count($menu)==0 && count($subMenu)==0){
                return;
            }
            else{
                    $tr="";
                    for ($i=0; $i < count($menu); $i++) { 
                        $tr.="<tr>";
                        $tr.="<td><label class=\"checkbox-inline\"><input type=\"checkbox\" value=\"".$menu[$i]['menu_id']." \" name=\"menu".(string)$i;
                        $tr.="\">".$menu[$i]['menu_name']."</label></td>";
                        $tr.="<td>";
                        for ($j=0; $j <count($subMenu) ; $j++) { 
                            $tr.="<label class=\"checkbox-inline\"><input type=\"checkbox\" value=\"".$subMenu[$j]['subMenu_id']." \" name=\"subMenu".(string)$i;
                            $tr.="[]\">".$subMenu[$j]['subMenu_name']."</label>";
                        }
                        $tr.="</td></tr>";
                    }
                    return json_encode($tr); 
            }
        }
        else
            return view('errors.404Error');
    }
     public function getDistrict(Request $request)
    {
        if(Auth::check() ){
            return json_encode(District::select('district_name','district_id')->get());
        }
    }

    public function getState(Request $request)
    {
        if(Auth::check()){
            
            return json_encode(State::select('state_name','state_id')->get());
        }
    }

    public function getArea($id)
    {
        if(Auth::check() ){   
            return json_encode(Area::where('c_id','=',$id)->pluck('area_name','area_id'));
        }
    }

    public function getAdminArea(Request $request)
    {
        if(Auth::check() ){   
            return json_encode(Area::select('area_name','area_id')->get());
        }
    }
    

    public function getEditMenuSubMenu(Request $request){
        if(Auth::check() ){
            $menus = Menu::where('dept_id','=',$request['dept'])->select('menu_id','menu_name')->get();
            $submenus= SubMenu::where('dept_id','=',$request['dept'])->select('subMenu_id','subMenu_name')->get();       
            $tr="";
            for($i=0;$i<count($menus);$i++){
                $tr.="<tr><td><label class=\"checkbox-inline\"><input type=\"checkbox\" value=\"".$menus[$i]['menu_id']."\" name=\"menu".(string)$i;
                /******To check in acl to menu already exists or not if exists then default checked********/
                if(ACL::where('menu_id','=',$menus[$i]['menu_id'])->where('emp_id','=',$request['emp'])->where('isShow','=','1')->exists()){
                        $tr.="\"  checked>".$menus[$i]['menu_name']."</label></td>";
                    }
                    else{
                        $tr.="\">".$menus[$i]['menu_name']."</label></td>";
                    }
            $tr.="<td>";
            for($j=0;$j<count($submenus);$j++){
                $tr.="<label class=\"checkbox-inline\"><input type=\"checkbox\" value=\"".$submenus[$j]['subMenu_id']."\" name=\"subMenu".(string)$i."[]\"";
                /******To check in acl to subMenu already exists or not if exists then default checked******/
                 if(ACL::where('subMenu_id','=',$submenus[$j]['subMenu_id'])->where('menu_id','=',$menus[$i]['menu_id'])->where('emp_id','=',$request['emp'])->where('isShow','=','1')->exists()){
                        $tr.=" checked>".$submenus[$j]['subMenu_name']."</label>";
                    }
                    else{
                        $tr.=">".$submenus[$j]['subMenu_name']."</label>";
                    }
                }
                $tr.="</td></tr>";
            }
            return json_encode($tr);
            }
        else
            return view('errors.404Error');
    }

    public function getCountry(Request $request){
        return json_encode(Country::select('country_id','country_name')->get());
    }

    public function getAreaType(Request $request){
        return json_encode(Area_type::select('area_type_id','area_name')->get());
    }
    
    public function getDepartment(Request $request){
        return json_encode(Department::select('dept_id','dept_name')->get());
    }
    public function getPost(Request $request){
        return json_encode(Post::select('post_id','post_name')->get());
    }
    
    public function getEmployeeUsername(Request $request){
        return json_encode(UserLogin::select('username')->where('emp_id','=',$request->input('emp'))->get()[0]['username']);

    }

    public function getEmployeePost(Request $request){
        return json_encode(UserLogin::select('post_id')->where('emp_id','=',$request->input('emp'))->get()[0]['post_id']);        
    }
    public function getEmployeeDepartment(Request $request){
        return json_encode(UserLogin::select('dept_id')->where('emp_id','=',$request->input('emp'))->get()[0]['dept_id']);
        
    }
    public function getEmployeeAreaType(Request $request){
        return json_encode(UserLogin::select('area_type_id')->where('emp_id','=',$request->input('emp'))->get()[0]['area_type_id']);
        
    }
    public function getEmployeeArea(Request $request){
        return json_encode(UserLogin::select('area_id')->where('emp_id','=',$request->input('emp'))->get()[0]['area_id']);
        
    }

    public function getITAdminCount(Request $request){
        $arr=array('total_employee'=>UserLogin::all()->count(),'total_males'=>UserLogin::all()->where('gender','=','male')->count(),'total_females'=>UserLogin::all()->where('gender','=','female')->count(),'total_department'=>Department::all()->count(),'total_role'=>Roles::all()->count(),'total_post'=>Post::all()->count());
        return json_encode($arr);
    }
     public function getMonthWiseEmployeeCreated(Request $request){
        $arr=array(array('total'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('1'))->count(),
                            'male'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('1'))->where('gender','=','male')->count(),
                            'female'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('1'))->where('gender','=','female')->count()),
                    array('total'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('2'))->count(),
                            'male'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('2'))->where('gender','=','male')->count(),
                            'female'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('2'))->where('gender','=','female')->count()),
                    array('total'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('3'))->count(),
                            'male'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('3'))->where('gender','=','male')->count(),
                            'female'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('3'))->where('gender','=','female')->count()),
                    array('total'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('4'))->count(),
                            'male'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('4'))->where('gender','=','male')->count(),
                            'female'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('4'))->where('gender','=','female')->count()),
                    array('total'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('5'))->count(),
                            'male'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('5'))->where('gender','=','male')->count(),
                            'female'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('5'))->where('gender','=','female')->count()),
                    array('total'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('6'))->count(),
                            'male'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('6'))->where('gender','=','male')->count(),
                            'female'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('6'))->where('gender','=','female')->count()),
                    array('total'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('7'))->count(),
                            'male'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('7'))->where('gender','=','male')->count(),
                            'female'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('7'))->where('gender','=','female')->count()),
                    array('total'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('8'))->count(),
                            'male'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('8'))->where('gender','=','male')->count(),
                            'female'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('8'))->where('gender','=','female')->count()),
                    array('total'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('9'))->count(),
                            'male'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('9'))->where('gender','=','male')->count(),
                            'female'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('9'))->where('gender','=','female')->count()),
                    array('total'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('10'))->count(),
                            'male'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('10'))->where('gender','=','male')->count(),
                            'female'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('10'))->where('gender','=','female')->count()),
                    array('total'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('11'))->count(),
                            'male'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('11'))->where('gender','=','male')->count(),
                            'female'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('11'))->where('gender','=','female')->count()),
                    array('total'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('12'))->count(),
                            'male'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('12'))->where('gender','=','male')->count(),
                            'female'=>UserLogin::whereRaw('year(`created_at`) = ?', array(date('Y')))->whereRaw('month(`created_at`) = ?', array('12'))->where('gender','=','female')->count()));
        return json_encode($arr);
    }
    public function getDepartmentWiseEmployeeCount(Request $request){
        $dept_name=UserLogin::select('department.dept_name','employee.dept_id')->distinct()->join('department','employee.dept_id','=','department.dept_id')->get();
        $arr;
        for ($i=0; $i <count($dept_name) ; $i++) { 
            $arr[]=array('dept_name'=>$dept_name[$i]['dept_name'],
                          'count'=>UserLogin::where('dept_id','=',$dept_name[$i]['dept_id'])->count());
        }
        return json_encode($arr);
    }
    public function getPostWiseEmployeeCount(Request $request){

         $post_name=UserLogin::select('post.post_name','employee.post_id')->distinct()->join('post','employee.post_id','=','post.post_id')->get();
        $arr;
        for ($i=0; $i <count($post_name) ; $i++) { 
            $arr[]=array('post_name'=>$post_name[$i]['post_name'],
                          'count'=>UserLogin::where('post_id','=',$post_name[$i]['post_id'])->count());
        }
        return json_encode($arr);
    }
/********************************************End Amol ****************************************************************/
}
