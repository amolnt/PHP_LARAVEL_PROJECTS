<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item_site;
use App\Item_Warehouse;
use App\Item_Brand;
use App\Item_Category;
use App\ItemHSN;
use App\ServiceSAC;
use App\ServiceType;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
class ProductionMasterOperation extends Controller
{
   public function addSite(Request $request)
    {   if(count($request->all())<=0)
        {
         return view('addSite')->with('sites',Item_site::all());
        }
        else{
        $site = new Item_site();
        $site->site_name=$request['site_name'];
        $site->save();
        return view('addSite')->with('sites',Item_site::all());
        }
    }

    public function updateSite(Request $request)
    {
        Item_site::where('site_id','=',$request['site_id'])->update(['site_name'=>$request['site_name']]);
        return view('addSite')->with('sites',Item_site::all()); 
    }

    public function addWarehouse(Request $request)
    {
    	if(count($request->all())<=0)
    	{
    		return view('addWarehouse')->with('warehouse',Item_Warehouse::select('item_warehouse.warehouse_id','item_warehouse.warehouse_name','item_warehouse.incharge','item_site.site_name')->join('item_site','item_warehouse.site_id','=','item_site.site_id')->get());
    	}
    	else
    	{
    		$warehuse = new Item_Warehouse();
    		$warehuse->warehouse_name=$request['warehouse_name'];
    		$warehuse->site_id=$request['site_name'];
        $warehouse->incharge=$request['incharge'];
    		$warehuse->save();
    		return view('addWarehouse')->with('warehouse',Item_Warehouse::select('item_warehouse.warehouse_id','item_warehouse.warehouse_name','item_warehouse.incharge','item_site.site_name')->join('item_site','item_warehouse.site_id','=','item_site.site_id')->get());
    	}
    }
    public function updateWarehouse(Request $request)
    {
    	Item_Warehouse::where('warehouse_id','=',$request['warehouse_id'])->update(['warehouse_name'=>$request['warehouse_name'],'site_id'=>$request['site_name'],'incharge'=>$request['incharge']]);
    	return view('addWarehouse')->with('warehouse',Item_Warehouse::select('item_warehouse.warehouse_id','item_warehouse.warehouse_name','item_warehouse.incharge','item_site.site_name')->join('item_site','item_warehouse.site_id','=','item_site.site_id')->get());
    }
   public function addBrand(Request $request)
   {
   	if(count($request->all())<=0)
   	{
   		return view('addBrand')->with('brands',Item_Brand::all());
   	}
   	else{
   	$brand= new Item_Brand();
   	$brand->manufacturer_name=$request['manufacturer_name'];
   	$brand->brand_name=$request['brand_name'];
   	$brand->save();	
   	return view('addBrand')->with('brands',Item_Brand::all());
   		}
   
   }

   public function updateBrand(Request $request)
   {
   
   	Item_brand::where('brand_id','=',$request['brand_id'])->update(['brand_name'=>$request['brand_name'],'manufacturer_name'=>$request['manufacturer_name']]);
   	return view('addBrand')->with('brands',Item_Brand::all());
   }

   public function addCategory(Request $request)
   {
   
   	if(count($request->all())<=0)
   	{
   		return view('addCategory')->with('categorys',Item_Category::all());
   	}
   	else{
   		$category = new Item_Category();
   		$category->category_name=$request['category_name'];
   		$category->save();
   	return view('addCategory')->with('categorys',Item_Category::all());	
   	}
   }

   public function updateCategory(Request $request)
   {
   	Item_Category::where('category_id','=',$request['category_id'])->update(['category_name'=>$request['category_name']]);
   	return view('addCategory')->with('categorys',Item_Category::all());	
   }

   public function addItemHSN(Request $request)
   {
      if(count($request->all())<=0)
    {
      return view('addItemHSN')->with('itemhsn',ItemHSN::all());
    }
    else
    {
      $hsn = new ItemHSN();
      $hsn->item_hsn_code=$request['item_hsn_code'];
      $hsn->item_gst=$request['item_gst'];
      $hsn->name=$request['item_description'];
      $hsn->save();
     return view('addItemHSN')->with('itemhsn',ItemHSN::all());
    }
   }

   public function updateItemHSN(Request $request)
   { 
    ItemHSN::where('item_hsn_id','=',$request['item_hsn_id'])->update(array('item_hsn_code'=>$request['item_hsn_code'],'item_gst'=>$request['item_gst'],'name'=>$request['item_description']));
    return view('addItemHSN')->with('itemhsn',ItemHSN::all());
   }

   public function addServiceSAC(Request $request)
   {
    if(count($request->all())<=0)
    {
      return view('addServiceSAC')->with('servicesac',ServiceSAC::select('service_sac_gst.service_sac_id','service_sac_gst.service_sac_code','service_sac_gst.service_gst','service_sac_gst.service_description','service_type.type_name')->join('service_type','service_sac_gst.type_id','=','service_type.type_id')->get());
    }
    else
    {
      $sac= new ServiceSAC();
      $sac->service_sac_code=$request['service_sac_code'];
      $sac->service_gst=$request['service_gst'];
      $sac->service_type=$request['service_type'];
      $sac->service_description=$request['service_description'];
      $sac->save();
    return view('addServiceSAC')->with('servicesac',ServiceSAC::select('service_sac_gst.service_sac_id','service_sac_gst.service_sac_code','service_sac_gst.service_gst','service_sac_gst.service_description','service_type.type_name')->join('service_type','service_sac_gst.type_id','=','service_type.type_id')->get());
    }
    
   }

   public function updateServiceSAC(Request $request)
   {
    ServiceSAC::where('service_sac_id','=',$request['service_sac_id'])->update(array('service_sac_code'=>$request['service_sac_code'],'service_gst'=>$request['service_gst'],'service_type'=>$request['service_type'],'service_description'=>$request['service_description']));
    return view('addServiceSAC')->with('servicesac',ServiceSAC::all());

   }
}
