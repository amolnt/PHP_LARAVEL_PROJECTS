<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\systemAdmin_assetModel;
use App\systemAdmin_accessory;
use App\systemAdmin_asset;
use App\systemAdmin_component;
use App\systemAdmin_consumable;
use App\systemAdmin_license;
use App\systemAdmin_location;
use App\UserLogin;
class SysAdminOperation extends Controller
{

/***********************************Add Operation********************************************************************************/
    public function addAsset(Request $request,$token=null){
    	if(Auth::check() && $token!=null){

    		$asset=new systemAdmin_asset();
    		$asset->model=$request->input('model');
            $asset->category=$request->input('category');
    		$asset->status=$request->input('status');
    		$asset->serial=$request->input('serial');
    		$asset->asset_name=$request->input('asset_name');
    		$asset->purchase_date=$request->input('purchase_date');
    		$asset->supplier=$request->input('supplier');
    		$asset->order_number=$request->input('order_number');
    		$asset->purchase_cost=$request->input('purchase_cost');
    		$asset->warranty=$request->input('warranty');
            $asset->notes=$request->input('notes');
            $asset->location=$request->input('location');
            $asset->created_by=Auth::user()->emp_id;
    		$asset->save();


            if(Input::has('employee')){
                UserLogin::where('emp_id','=',$request->input('employee'))->update(['isDeploy'=>'1','updated_by'=>Auth::user()->emp_id]);
                systemAdmin_asset::where('asset_id','=',$asset->id)->update(['emp_id'=>$request->input('employee'),'updated_by'=>Auth::user()->emp_id]);
            }
    		return redirect()->back()->with('succMsg','Asset Added Successfully');
    	}
    	else
    		return view('errors.404Error');
    }


    public function addAssetModel(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            $assetModel=new systemAdmin_assetModel();
            $assetModel->name=$request->input('addModel_name');
            $assetModel->manufacture=$request->input('addManufacture');
            $assetModel->category=$request->input('addCategory');
            $assetModel->model_number=$request->input('addModel_number');
            $assetModel->created_by=Auth::user()->emp_id;
            $assetModel->save();

            return redirect()->back()->with('succMsg','Asset Model Added Successfully');
        }
        else
            return view('errors.404Error');
    }
    public function addLocation(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            
            $location=new systemAdmin_location();
            $location->location_name=$request->input('addLocation_name');
            $location->city_id=$request->input('addCity');
            $location->country_id=$request->input('addCountry');
            $location->created_by=Auth::user()->emp_id;
            $location->save();

            return redirect()->back()->with('succMsg','Location Added Successfully');
        }
        else
            return view('errors.404Error');
    }


     public function addComponent(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            $component=new systemAdmin_component();
            $component->component_name=$request->input('component_name');
            $component->category=$request->input('category');
            $component->quantity=$request->input('quantity');
            $component->serial=$request->input('serial');
            $component->location=$request->input('location');
            $component->order_number=$request->input('order_number');
            $component->purchase_date=$request->input('purchase_date');
            $component->purchase_cost=$request->input('purchase_cost');
            $component->created_by=Auth::user()->emp_id;
            $component->save();

            return redirect()->back()->with('succMsg','Component Added Successfully');
        }
        else
            return view('errors.404Error');
    }


     public function addConsumable(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            $consumable=new systemAdmin_consumable();
            $consumable->consumable_name=$request->input('consumable_name');
            $consumable->category=$request->input('category');
            //$consumable->manufacture=$request->input('manufacture');
           // $consumable->location=$request->input('location');
           // $consumable->model_number=$request->input('model_number');
            $consumable->item_number=$request->input('item_number');
            $consumable->order_number=$request->input('order_number');
            $consumable->purchase_date=$request->input('purchase_date');
            $consumable->purchase_cost=$request->input('purchase_cost');
            $consumable->quantity=$request->input('quantity');
            $consumable->created_by=Auth::user()->emp_id;
            $consumable->save();

            return redirect()->back()->with('succMsg','Consumable Added Successfully');
        }
        else
            return view('errors.404Error');
    }


     public function addAccessory(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            $accessory=new systemAdmin_accessory();
            $accessory->accessory_name=$request->input('accessory_name');
            $accessory->category=$request->input('category');
            $accessory->supplier=$request->input('supplier');
            $accessory->manufacture=$request->input('manufacture');
            $accessory->location=$request->input('location');
            $accessory->model_number=$request->input('model_number');
            $accessory->order_number=$request->input('order_number');
            $accessory->purchase_date=$request->input('purchase_date');
            $accessory->purchase_cost=$request->input('purchase_cost');
            $accessory->quantity=$request->input('quantity');
            $accessory->created_by=Auth::user()->emp_id;
            $accessory->save();

            return redirect()->back()->with('succMsg','accessory Added Successfully');
        }
        else
            return view('errors.404Error');
    }
     public function addLicense(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            $license=new systemAdmin_license();
            $license->software_name=$request->input('software_name');
            $license->product_key=$request->input('product_key');
            $license->manufacture=$request->input('manufacture');
            $license->license_to_name=$request->input('license_to_name');
            $license->license_to_email=$request->input('license_to_email');
            $license->supplier=$request->input('supplier');
            $license->order_number=$request->input('order_number');
            $license->purchase_cost=$request->input('purchase_cost');
            $license->purchase_date=$request->input('purchase_date');
            $license->expiry_date=$request->input('expire_date');
            $license->termination_date=$request->input('termination_date');
            $license->purchase_order_number=$request->input('purchase_order_number');
            $license->notes=$request->input('notes');
            $license->created_by=Auth::user()->emp_id;
            $license->save();

            return redirect()->back()->with('succMsg','License Added Successfully');
        }
        else
            return view('errors.404Error');
    }


    /***********************************End Add Operation**********************************************************/


    /***********************************update Operation**************************************************************/
      public function updateAsset(Request $request,$token=null){
        if(Auth::check() && $token!=null){

           systemAdmin_asset::where('asset_id','=',$request->input('asset'))->update(['model'=>$request->input('model'),'category'=>$request->input('category'),'status'=>$request->input('status'),'serial'=>$request->input('serial'),'asset_name'=>$request->input('asset_name'),'purchase_date'=>$request->input('purchase_date'),'supplier'=>$request->input('supplier'),'order_number'=>$request->input('order_number'),'purchase_cost'=>$request->input('purchase_cost'),'warranty'=>$request->input('warranty'),'notes'=>$request->input('notes'),'location'=>$request->input('location'),'updated_by'=>Auth::user()->emp_id]);
            if(Input::get('status')=='Ready To Deploy'){
                UserLogin::where('emp_id','=',$request->input('employee'))->update(['isDeploy'=>'1']);
                systemAdmin_asset::where('asset_id','=',$request->input('asset'))->update(['emp_id'=>$request->input('employee'),'updated_by'=>Auth::user()->emp_id]);
            }
            else{
                systemAdmin_asset::where('asset_id','=',$request->input('asset'))->update(['emp_id'=>null]);
                UserLogin::where('emp_id','=',$request->input('employee'))->update(['isDeploy'=>'0','updated_by'=>Auth::user()->emp_id]);
            }


            return redirect()->back()->with('succMsg','Asset Updated Successfully');
        }
        else
            return view('errors.404Error');
    }


     public function updateAssetModel(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            systemAdmin_assetModel::where('model_id','=',$request->input('model'))->update(['name'=>$request->input('editModel_name'),
                            'manufacture'=>$request->input('editManufacture'),
                            'category'=>$request->input('editCategory'),
                            'model_number'=>$request->input('editModel_number'),'updated_by'=>Auth::user()->emp_id]);
            return redirect()->back()->with('succMsg','Asset Model Updated Successfully');
        }
        else
            return view('errors.404Error');
    }

     public function updateLocation(Request $request,$token=null){

        if(Auth::check() && $token!=null){
            systemAdmin_location::where('location_id','=',$request->input('location'))->update(['location_name'=>$request->input('editLoaction_name'),
                            'city_id'=>$request->input('editCity'),
                            'country_id'=>$request->input('editCountry'),'updated_by'=>Auth::user()->emp_id]);
            return redirect()->back()->with('succMsg','Location Updated Successfully');
        }
        else
            return view('errors.404Error');
    }


    public function updateComponent(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            systemAdmin_component::where('component_id','=',$request->input('component'))->update(['component_name'=>$request->input('component_name'),'category'=>$request->input('category'),'quantity'=>$request->input('quantity'),'serial'=>$request->input('serial'),'location'=>$request->input('location'),'order_number'=>$request->input('order_number'),'purchase_date'=>$request->input('purchase_date'),'purchase_cost'=>$request->input('purchase_cost'),'updated_by'=>Auth::user()->emp_id]);
            return redirect()->back()->with('succMsg','Component Updated Successfully');
        }
        else
            return view('errors.404Error');
    }
     public function updateConsumable(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            systemAdmin_consumable::where('consumable_id','=',$request->input('consumable'))->update(['consumable_name'=>$request->input('consumable_name'),'category'=>$request->input('category'),'item_number'=>$request->input('item_number'),'order_number'=>$request->input('order_number'),'purchase_date'=>$request->input('purchase_date'),'purchase_cost'=>$request->input('purchase_cost'),'quantity'=>$request->input('quantity'),'updated_by'=>Auth::user()->emp_id]);
            return redirect()->back()->with('succMsg','Consumable Updated Successfully');
        }
        else
            return view('errors.404Error');
    }


     public function updateAccessory(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            systemAdmin_accessory::where('accessory_id','=',$request->input('accessory'))->update(['accessory_name'=>$request->input('accessory_name'),'category'=>$request->input('category'),'supplier'=>$request->input('supplier'),'manufacture'=>$request->input('manufacture'),'location'=>$request->input('location'),'model_number'=>$request->input('model_number'),'order_number'=>$request->input('order_number'),'purchase_date'=>$request->input('purchase_date'),'purchase_cost'=>$request->input('purchase_cost'),'quantity'=>$request->input('quantity'),'updated_by'=>Auth::user()->emp_id]);

            return redirect()->back()->with('succMsg','Accessory Updated Successfully');
        }
        else
            return view('errors.404Error');
    }
     public function updateLicense(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            systemAdmin_license::where('license_id','=',$request->input('license'))->update(['software_name'=>$request->input('software_name'),'product_key'=>$request->input('product_key'),'manufacture'=>$request->input('manufacture'),'license_to_name'=>$request->input('license_to_name'),'license_to_email'=>$request->input('license_to_email'),'supplier'=>$request->input('supplier'),'order_number'=>$request->input('order_number'),'purchase_cost'=>$request->input('purchase_cost'),'purchase_date'=>$request->input('purchase_date'),'expiry_date'=>$request->input('expire_date'),'termination_date'=>$request->input('termination_date'),'purchase_order_number'=>$request->input('purchase_order_number'),'notes'=>$request->input('notes'),'updated_by'=>Auth::user()->emp_id]);
            return redirect()->back()->with('succMsg','License Updated Successfully');
        }
        else
            return view('errors.404Error');
    }



    /***********************************end update Operation***********************************************************/
}
