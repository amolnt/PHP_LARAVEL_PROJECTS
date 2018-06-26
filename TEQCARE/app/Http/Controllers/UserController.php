<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use App\Menu;
use App\ACL;
use App\SubMenu;

use Auth;
class UserController extends Controller
{
     public $Navigations="\t<div id=\"sidebar-menu\" class=\"main_menu_side hidden-print main_menu\">\n\t<div class=\"menu_section\">\n\t<ul class=\"nav side-menu\">";
    
    public function index(Request $request){

        $acl=new ACL();
        $Menu=new Menu();

        if(Auth::check()){          
            $Menu_id=$acl->select('menu_id')->where('user_id','=',Auth::user()->user_id)->distinct()->get();//only gets a distict menu allocated in employee
            
            for ($i=0; $i <count($Menu_id) ; $i++) {   
                $this->Navigations.="\t<li><a><i class=\"".$Menu->select('class')->where('menu_id','=',$Menu_id[$i]['menu_id'])->get()[0]['class']."\"></i>".$Menu->select('menu_name')->where('menu_id','=',$Menu_id[$i]['menu_id'])->get()[0]['menu_name']."<span class=\"fa fa-chevron-down\"></span></a>\n";
                $this->Navigations.=$this->SubMenu($Menu_id[$i]['menu_id'],Auth::user()->user_id,$request);//build sumbmenus under menu
               
                $this->Navigations.="\t</li>\n";
            }
            $this->Navigations.="</ul></div></div>";

           $request->session()->put('navigation',$this->Navigations);//set priveledges on master page
            /**************************Admin***************************************/
            //if(Auth::user()->dept_id==Config::get('checkAuth.admin')['dept_id'] && Auth::user()->post_id==Config::get('checkAuth.admin')['post_id'])
             // return redirect('/home/admin/dashboard');
            /*************************Mrketing Executive***************************/
            //if(Auth::user()->dept_id==Config::get('checkAuth.mrkExecutive')['dept_id'] || Auth::user()->dept_id==Config::get('checkAuth.mrkManager')['dept_id'])
              //return redirect('/home/mrk/dashboard');
            /************************Supervisor***************************/
            //if(Auth::user()->dept_id==Config::get('checkAuth.supervisor')['dept_id'] || Auth::user()->post_id==Config::get('checkAuth.supervisor')['post_id'])
              //return redirect('/home/supervisor/dashboard');
            /************************Engineer***************************************/
             //if(Auth::user()->dept_id==Config::get('checkAuth.engineer')['dept_id'] || Auth::user()->post_id==Config::get('checkAuth.engineer')['post_id'])
              //return redirect('/home/engineer/dashboard');
            //$request-session()->flush();
            return redirect('home/dashboard/'.$request->session()->get('dashboard'));
        }
        return view('errors.404Error');
    }
    /********************************To build SubMenu************************************************/
    public function SubMenu($Menu_id,$user_id,$request){

        $acl=new ACL();
        $SubMenu=new SubMenu();
        $nav="";
        $SubMenu_id=$acl->select('subMenu_id')->where('user_id','=',$user_id)->where('menu_id','=',$Menu_id)->get();
        if(count($SubMenu_id)!=null){
            $nav.="\t\t<ul class=\"nav child_menu\">\n";
            for ($j=0; $j <count($SubMenu_id) ; $j++) { 
                $value=$SubMenu->select('subMenu_name','sessionName','Url','class')->where('subMenu_id','=',$SubMenu_id[$j]['subMenu_id'])->get();
                $token=str_random(60);//generate random token with length 60
                $request->session()->put($value[0]['sessionName'],$token);//set each submenu session
               
                $nav.="\t\t\t<li><a href=\"/home/".$value[0]['Url']."/".$token."\"> <i class=\"".$value[0]['class']."\"></i>".$value[0]['subMenu_name']."</a></li>\n";
            }
            $nav.="\t\t</ul>\n";    
            return $nav;
        }
        return;
    }
}