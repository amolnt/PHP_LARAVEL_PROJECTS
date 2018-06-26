<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item_Category;
use App\Item_Group;
use App\Item_Brand;
use App\Item_site;
use App\Item_Stock;
use App\Item_Warehouse;
use App\ItemHSN;
use App\ServiceSAC;
use App\ServiceType;
use App\ItemType;
use App\Item;
class ProductionInventoryAjax extends Controller
{
    public function categoryAjax()
    {
    	$category=Item_Category::pluck('category_name','category_id');
    	return json_encode($category);
    }
    public function groupAjax()
    {
    	$group=Item_Group::pluck('group_name','group_id');
    	return json_encode($group);
    }
    public function brandAjax()
    {
    	$brand=Item_Brand::pluck('brand_name','brand_id');
    	return json_encode($brand);
    }
    public function siteAjax()
    {
        $site=Item_site::pluck('site_name','site_id');
        return json_encode($site);
    }

    public function warehouseAjax($id)
    {
    $warehouse =Item_Warehouse::where('site_id','=',$id)->pluck('warehouse_name','warehouse_id');
    return json_encode($warehouse); 
    }

    public function service_typeAjax()
    {
        $service_type=ServiceType::pluck('type_name','type_id');
        return json_encode($service_type);
    }

    public function service_nameAjax($id)
    {
        $service_name=ServiceSAC::where('type_id','=',$id)->pluck('service_description','service_sac_id');
        return json_encode($service_name);
    }
    public function sacAjax($id)
    {
        $sac=ServiceSAC::where('service_sac_id','=',$id)->pluck('service_sac_code');
        $gst=ServiceSAC::where('service_sac_id','=',$id)->pluck('service_gst');
        $arr=array($sac,$gst);
        return json_encode($arr);
    }

    public function hsnAjax($id)
    {
        $hsn=ItemHSN::where('item_hsn_id','=',$id)->pluck('item_hsn_code');
        return json_encode($hsn);
    }
    public function item_nameAjax($id)
    {
       $name=ItemHSN::where('type_id', '=',$id)->pluck('name','item_hsn_id');
       return json_encode($name);
    }
    public function item_typeAjax()
    {
        $type=ItemType::pluck('type_name','type_id');
        return json_encode($type);
    }

    public function stockAlertAjax()
    {
       $item_id=Item_Stock::select('item_hsn_gst.name','item_warehouse.warehouse_name')->join('item_hsn_gst','item_stock.item_hsn_id','=','item_hsn_gst.item_hsn_id')->join('item_warehouse','item_stock.warehouse_id','=','item_warehouse.warehouse_id')->whereRaw('item_stock.quantity_in_hand <= item_stock.threshold_limit')->get();
        $list="";
        if(count($item_id)!=0){
         $list.="<h5>Items in low quantity:";
           foreach($item_id as $key=>$value)
        {
           $list.=$value['name'].",In ".$value['warehouse_name']."</h5>";  
        }
        return $list;
      }
      else{return ;}
    }

    public function itemAutoAjax($name)
    {
        $item=Item::select('item_hsn_gst.name','item.item_id')->join('item_hsn_gst','item.item_hsn_id','=','item_hsn_gst.item_hsn_id')->where('item_hsn_gst.name','LIKE','%'.$name.'%')->get();
     
        return json_encode($item);
    }
}
