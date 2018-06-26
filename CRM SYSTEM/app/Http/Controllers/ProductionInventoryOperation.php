<?php

namespace App\Http\Controllers;
use App\Item;
use App\Item_Stock;
use App\Services;
use App\ItemHSN;
use App\ServiceSAC;
use App\ServiceType;
use App\ItemType;
use Illuminate\Http\Request;

class ProductionInventoryOperation extends Controller
{
    public function addItem(Request $request)
    {
    	$item = new Item();
        $item->type_id=$request['item_type'];
    	$item->category_id=$request['item_category'];
    	$item->group_id=$request['item_group'];
    	$item->brand_id=$request['item_brand'];
    	$item->item_hsn_id=$request['item_name'];
    	$item->item_code=$request['item_code'];
        $item->serial_no=$request['serial_no'];
    	$item->description=$request['item_description'];
    	$item->item_price=$request['item_price'];
    	$item->item_quantity=$request['item_quantity'];
    	$item->default_uom=$request['item_uom'];
    	$item->pack_size=$request['pack_size'];
    	$item->warrenty_terms=$request['warrenty_terms'];
    	$item->purchased_date=$request['purchased_date'];
    	$item->save();

    	$stock=new Item_Stock();
    	$id=$item->id;
    	if(Item_Stock::where('item_code','=',$request['item_code'])->where('warehouse_id','=',$request['warehouse_name'])->exists()){
    	  Item_Stock::where('item_code','=',$request['item_code'])->where('warehouse_id','=',$request['warehouse_name'])->increment('quantity_in_hand',$request['item_quantity']);
    	}
    	else{
        $stock->item_hsn_id=$request['item_name'];      
    	$stock->item_id=$id;
        $stock->site_id=$request['site_name'];
    	$stock->warehouse_id=$request['warehouse_name'];
    	$stock->item_code=$request['item_code'];
    	$stock->quantity_in_hand=$request['item_quantity'];
    	$stock->save();	
    		}
    		return view('goods')->with('item',Item::select('item.item_id','item.serial_no','item_hsn_gst.name','item_type.type_name','item.item_code','item.description','item.item_price','item.item_quantity','item.default_uom','item.purchased_date','item.warrenty_terms','item.is_active','item_hsn_gst.item_gst','item_brand.brand_name')->join('item_hsn_gst','item.item_hsn_id','=','item_hsn_gst.item_hsn_id')->join('item_brand','item.brand_id','=','item_brand.brand_id')->join('item_type','item.type_id','=','item_type.type_id')->get());
    	}
    	
        public function updateItem(Request $request)
        {
            Item::where('item_id','=',$request['item_id'])->update(array(
                'description'=>$request['item_description'],
                'item_price'=>$request['item_price'],
                'default_uom'=>$request['item_uom'],
                'purchased_date'=>$request['purchased_date'],
                'warrenty_terms'=>$request['warrenty_terms'],
                ));

           return view('goods')->with('item',Item::select('item.item_id','item.serial_no','item_hsn_gst.name','item_type.type_name','item.item_code','item.description','item.item_price','item.item_quantity','item.default_uom','item.purchased_date','item.warrenty_terms','item.is_active','item_hsn_gst.item_gst','item_brand.brand_name')->join('item_hsn_gst','item.item_hsn_id','=','item_hsn_gst.item_hsn_id')->join('item_brand','item.brand_id','=','item_brand.brand_id')->join('item_type','item.type_id','=','item_type.type_id')->get());
        }

        public function addServices(Request $request)
        {
            if(count($request->all())<=0)
            {
                return view('addServices')->with('services',Services::select('services.description','services.service_charge','service_type.type_name','service_sac_gst.service_description')->join('service_type','services.type_id','=','service_type.type_id')->join('service_sac_gst','services.service_sac_id','=','service_sac_gst.service_sac_id')->get());
            }
            else
            {
                
                $service = new Services();
                $service->type_id=$request['service_type'];
                $service->service_sac_id=$request['service_name'];
                $service->description=$request['description'];
                $service->service_charge=$request['service_charge'];
                
                $service->save();
                return view('addServices')->with('services',Services::select('services.service_id','services.description','services.service_charge','service_type.type_name','service_sac_gst.service_description')->join('service_type','services.type_id','=','service_type.type_id')->join('service_sac_gst','services.service_sac_id','=','service_sac_gst.service_sac_id')->get());
            }
        }

        public function updateServices(Request $request)
        {
            Services::where('service_id','=',$request['service_id'])->update(array('type_id'=>$request['service_type'],'service_sac_id'=>$request['service_name'],
                'description'=>$request['description'],
                'service_charge'=>$request['service_charge'],
               ));
           
            return view('addServices')->with('services',Services::select('services.service_id','services.description','services.service_charge','service_type.type_name','service_sac_gst.service_description')->join('service_type','services.type_id','=','service_type.type_id')->join('service_sac_gst','services.service_sac_id','=','service_sac_gst.service_sac_id')->get());
        }
}
