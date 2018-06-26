<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Assets;
use App\Department;
use App\UserLogin;
use App\City;
use App\Country;
use App\systemAdmin_assetModel;
use App\systemAdmin_accessory;
use App\systemAdmin_asset;
use App\systemAdmin_component;
use App\systemAdmin_consumable;
use App\systemAdmin_license;
use App\systemAdmin_location;
use App\systemAdmin_manufacture;
class SysAdmin extends Controller
{
    public function showAddAsset(Request $request,$token=null){
    	
    	if(Auth::check() && $request->session()->get('addAsset')==$token){	
    		return view('systemAdminAddAsset')->with('model',systemAdmin_assetModel::select('model_id','name','model_number')->get())->with('location',systemAdmin_location::select('location_id','location_name')->get());
    	}
		else
			return view('errors.404Error');
    }
    public function showEditAsset(Request $request,$token=null){

    	if(Auth::check() && $request->session()->get('editAsset')==$token){

    		return view('systemAdminUpdateAsset')->with('model',systemAdmin_assetModel::select('model_id','name','model_number')->get())->with('location',systemAdmin_location::select('location_id','location_name')->get())->with('assets',systemAdmin_asset::select('systemAdmin_asset.asset_id','systemAdmin_assetModel.name as mname','systemAdmin_assetModel.model_number','systemAdmin_asset.category','status','serial','asset_name','purchase_date','supplier','order_number','purchase_cost','warranty','notes','systemAdmin_location.location_name as lname','employee.full_name')->join('systemAdmin_location','systemAdmin_asset.location','=','systemAdmin_location.location_id')->join('systemAdmin_assetModel','systemAdmin_asset.model','=','systemAdmin_assetModel.model_id')->leftjoin('employee','systemAdmin_asset.emp_id','=','employee.emp_id')->get())->with('employee',UserLogin::select('emp_id','full_name')->get());
    	}
		else
			return view('errors.404Error');
    }

    public function showAssetModel(Request $request,$token=null){

        if(Auth::check() && $request->session()->get('assetModel')==$token){
            return view('systemAdminAssetModel')->with('manufacture',systemAdmin_manufacture::select('manufacture_id','manufacture_name')->get())->with('model',systemAdmin_assetModel::select('model_id','name','systemAdmin_manufacture.manufacture_name','category','model_number')->join('systemAdmin_manufacture','systemAdmin_assetModel.manufacture','=','systemAdmin_manufacture.manufacture_id')->get());
        }
        else
            return view('errors.404Error');
    }

    public function showLocation(Request $request,$token=null){

        if(Auth::check() && $request->session()->get('location')==$token){

            return view('systemAdminLocation')->with('city',City::select('city_id','city_name')->get())->with('country',Country::select('country_id','country_name')->get())->with('location',systemAdmin_location::select('location_id','location_name','city.city_name','country.country_name')->join('city','systemAdmin_location.city_id','=','city.city_id')->join('country','systemAdmin_location.country_id','=','country.country_id')->get());
        }
        else
            return view('errors.404Error');
    }


     public function showAddComponent(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('addComponent')==$token){
            return view('systemAdminAddComponent')->with('location',systemAdmin_location::select('location_id','name')->get());
        }
        else
            return view('errors.404Error');
    }

     public function showEditComponent(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('editComponent')==$token){
            return view('systemAdminUpdateComponent')->with('component',systemAdmin_component::select('component_id','component_name','category','quantity','serial','order_number','purchase_date','purchase_cost','systemAdmin_location.name')->join('systemAdmin_location','systemAdmin_component.location','=','systemAdmin_location.location_id')->get())->with('location',systemAdmin_location::select('location_id','location_name')->get());
        }
        else
            return view('errors.404Error');
    }


    public function showAddConsumable(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('addConsumable')==$token){
            return view('systemAdminAddConsumable')->with('location',systemAdmin_location::select('location_id','location_name')->get())->with('manufacture',systemAdmin_manufacture::select('manufacture_id','manufacture_name')->get());
        }
        else
            return view('errors.404Error');
    }

    public function showEditConsumable(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('editConsumable')==$token){
           return view('systemAdminUpdateConsumable')->with('location',systemAdmin_location::select('location_id','location_name')->get())->with('manufacture',systemAdmin_manufacture::select('manufacture_id','manufacture_name')->get())->with('consumable',systemAdmin_consumable::select('consumable_id','consumable_name','category','model_number','item_number','order_number','purchase_date','purchase_cost','quantity')->get());
        }
        else
            return view('errors.404Error');
    }


    public function showAddAccessory(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('addAccessory')==$token){
            return view('systemAdminAddAccessory')->with('location',systemAdmin_location::select('location_id','location_name')->get())->with('manufacture',systemAdmin_manufacture::select('manufacture_id','manufacture_name')->get());
        }
        else
            return view('errors.404Error');
    }

    public function showEditAccessory(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('editAccessory')==$token){
           return view('systemAdminUpdateAccessory')->with('location',systemAdmin_location::select('location_id','location_name')->get())->with('manufacture',systemAdmin_manufacture::select('manufacture_id','manufacture_name')->get())->with('accessory',systemAdmin_accessory::select('accessory_id','accessory_name','category','supplier','systemAdmin_manufacture.manufacture_name','systemAdmin_location.name','model_number','order_number','purchase_date','purchase_cost','quantity')->join('systemAdmin_location','systemAdmin_accessory.location','=','systemAdmin_location.location_id')->join('systemAdmin_manufacture','systemAdmin_accessory.manufacture','=','systemAdmin_manufacture.manufacure_id')->get());
        }
        else
            return view('errors.404Error');
    }


    public function showAddLicense(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('addLicense')==$token){
            return view('systemAdminAddLicense')->with('location',systemAdmin_location::select('location_id','location_name')->get())->with('manufacture',systemAdmin_manufacture::select('manufacure_id','manufacure_name')->get());
        }
        else
            return view('errors.404Error');
    }

    public function showEditLicense(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('editLicense')==$token){
           return view('systemAdminUpdateLicense')->with('location',systemAdmin_location::select('location_id','location_name')->get())->with('manufacture',systemAdmin_manufacture::select('manufacure_id','manufacure_name')->get())->with('license',systemAdmin_license::select('license_id','software_name','product_key','systemAdmin_manufacture.manufacure_name','license_to_name','license_to_email','supplier','order_number','purchase_cost','purchase_date','expiry_date','termination_date','purchase_order_number','notes')->join('systemAdmin_manufacture','systemAdmin_license.manufacture','=','systemAdmin_manufacture.manufacure_id')->get());
        }
        else
            return view('errors.404Error');
    }

    public function showAllocateAssets(Request $request,$token=null){
    	
    	if(Auth::check() && $request->session()->get('allocateAssets')==$token){
    		return view('systemAdminAllocateAsset')->with('department',Department::select('dept_id','dept_name')->get());
    	}
		else
			return view('errors.404Error');
    }

    public function getAsset(Request $request){
    	return json_encode(Assets::select('asset_id','asset_name','asset_address')->where('asset_type','=',$request->input('asset'))->where('isAllocate','=','0')->get());
    }
    public function getEmployee(Request $request){
    	return json_encode(UserLogin::select('emp_id','full_name')->where('isDeploy','=','0')->get());
    }
}
