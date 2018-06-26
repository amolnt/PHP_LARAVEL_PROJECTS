<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Services;
use App\Item_Stock;
use App\Item_Warehouse;
use App\ItemBrand;
use App\ItemHSN;
use App\ServiceSAC;
use App\ServiceType;
use App\ItemType;
use App\Item_Site;
use App\Item_Brand;
use App\Item_Category;


class ProductionInventory extends Controller
{	
	   public function viewItems(Request $request)
	   {	
	  return view('productionGoods')->with('item',Item::select('production_item.item_id','production_item.serial_no','production_item_hsn_gst.name','production_item_type.type_name','production_item.item_code','production_item.description','production_item.item_price','production_item.item_quantity','production_item.default_uom','production_item.purchased_date','production_item.warrenty_terms','production_item.is_active','production_item_hsn_gst.item_gst','production_item_brand.brand_name')->join('production_item_hsn_gst','production_item.item_hsn_id','=','production_item_hsn_gst.item_hsn_id')->join('production_item_brand','production_item.brand_id','=','production_item_brand.brand_id')->join('production_item_type','production_item.type_id','=','production_item_type.type_id')->get());
	   }
	   
	public function viewServices(Request $request)
	{
		 return view('productionAddServices')->with('services',Services::select('production_services.service_id','production_services.description','production_services.service_charge','production_service_type.type_name','production_service_sac_gst.service_description')->join('production_service_type','production_services.type_id','=','production_service_type.type_id')->join('production_service_sac_gst','production_services.service_sac_id','=','production_service_sac_gst.service_sac_id')->get());
	}

	public function viewStock(Request $request)
	{	

		$stock= Item_Stock::select('production_item_hsn_gst.name','production_item_warehouse.warehouse_name','production_item_warehouse.incharge','production_item_stock.quantity_in_hand','production_item_stock.stock_id')->join('production_item_hsn_gst','production_item_stock.item_hsn_id','=','production_item_hsn_gst.item_hsn_id')->join('production_item_warehouse','production_item_stock.warehouse_id','=','production_item_warehouse.warehouse_id')->get();

		return view('productionViewStock')->with('stock',$stock);
	}

	 public function showSite()
    {
        return view('productionAddSite')->with('sites',Item_site::all());     
    }

    public function showWarehouse()
    {
    	return view('productionAddWarehouse')->with('warehouse',Item_Warehouse::select('production_item_warehouse.warehouse_id','production_item_warehouse.warehouse_name','production_item_warehouse.incharge','production_item_site.site_name')->join('production_item_site','production_item_warehouse.site_id','=','production_item_site.site_id')->get());
    }

    public function showBrand()
    {
    	return view('productionAddBrand')->with('brands',Item_Brand::all());
    }

    public function showCategory()
    {
    	return view('productionAddCategory')->with('categorys',Item_Category::all());
    }
    public function showItemHSN()
    {
        return view('productionAddItemHSN')->with('itemhsn',ItemHSN::all());
    }

    public function showServiceSAC()
    {
      return view('productionAddServiceSAC')->with('servicesac',ServiceSAC::select('production_service_sac_gst.service_sac_id','production_service_sac_gst.service_sac_code','production_service_sac_gst.service_gst','production_service_sac_gst.service_description','production_service_type.type_name')->join('production_service_type','production_service_sac_gst.type_id','=','production_service_type.type_id')->get());
    }
}
