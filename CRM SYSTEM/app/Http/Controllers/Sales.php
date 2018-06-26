<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Lead;
use Mail;
use App\Mail\Item_Quotation;
use App\Mail\Item_SalesOrder;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Input;
use App\Production_Item;
use App\Quotation_Item;
use App\Quotation;
use App\SalesOrder_Item;
use App\SalesOrder;
use App\Production_Item_Site;
use App\Production_Item_Warehouse;
use App\Production_Services;
use NumberToWords\NumberToWords;
use App\Quotation_Approve;
class Sales extends Controller
{
    /*******************************Author:Amol Tribhuwan*********************************************/
    public function showSendQuotation(Request $request,$token=null){
    	if(Auth::check() && $request->session()->get('sendQuotation')==$token){
    		return view('salesSendQuotation')->with('lead',Lead::select('lead_id','lead_source','contact_person_name','organization_name','mobile_no','email','address','status','description')->get());
    	}
    }
    public function showViewQuotation(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('viewQuotation')==$token){
            return view('salesViewQuotation')->with('quotation',Lead::select('quotation.quotation_id','lead.contact_person_name','lead.email','lead.address','lead.mobile_no','lead.phone_no','quotation.sendStatus')->join('quotation','lead.lead_id','=','quotation.lead_id')->where('quotation.emp_id','=',Auth::user()->emp_id)->get());
        }
    }

    public function showSendSalesOrder(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('sendSalesOrder')==$token){
            return view('salesSendSalesOrder')->with('lead',Lead::select('lead_id','lead_source','contact_person_name','organization_name','mobile_no','email','address','status','description')->where('status','=','Customer')->get());
        }
    }

    public function showViewSalesOrder(Request $request,$token=null){
        if(Auth::check() && $request->session()->get('viewSalesOrder')==$token){
            return view('salesViewSalesOrder')->with('salesOrder',Lead::select('sales_order.slorder_id','lead.contact_person_name','lead.email','lead.address','lead.mobile_no','lead.phone_no','sales_order.sendStatus')->join('sales_order','lead.lead_id','=','sales_order.lead_id')->where('sales_order.emp_id','=',Auth::user()->emp_id)->get());
        }
    }

    //public function send(Request $request){
    //	Mail::to('tribhuwan131@gmail.com')->send(new Quotation());
    //}

    public function downloadQuotation(Request $request)
    {   
            $data=$request->session()->get('pdfData');

            $d=$data[0]['data'];
       		$dompdf = new Dompdf();
        	$dompdf->loadHtml(view('emails.quotation')->with('data',$data[0]['data'])->with('result',$data[0]['result'])->render());
  			// (Optional) Setup the paper size and orientation   
        	$dompdf->setPaper('A4', 'portrait');
  			// Render the HTML as PDF
        	$dompdf->render();

  			// Output the generated PDF to Browser
        	$dompdf->stream('Quotation-'.$d[0]['qtn'].'.pdf');
    }
    public function showQu(Request $request){
    	return view('emails.quotation');
    }
	public function sendQuotation(Request $request){
        if(Auth::check()){
            $data=$request->session()->get('pdfData');

            Mail::to($request->input('toEmail'))->send(new Item_Quotation($data,$request->input('subject'),$request->input('message'),base64_encode(file_get_contents($request->file('file')->getRealPath()))));  //call to Mailable class and class in App/Mail/Item_Quotation
            $request->session()->forget('pdfData');//remove session
            \App\Quotation::where('quotation_id','=',$request->input('quotation'))->update(['sendStatus'=>'1']);
            return redirect()->back()->with('succ1',['succMsg'=>'Quotation Sent Successfully']);
        }
        return view('errors.404Error');
    }
    public function resendQuotation(Request $request){
        if(Auth::check()){
            $data=$request->session()->get('pdfData');

            Mail::to($request->input('toEmail'))->send(new Item_Quotation($data,$request->input('subject'),$request->input('message'),base64_encode(file_get_contents($request->file('file')->getRealPath()))));  //call to Mailable class and class in App/Mail/Item_Quotation
            $request->session()->forget('pdfData');//remove session
            Quotation_Approve::where('quotation_id','=',$request->input('quotation'))->update(['resend_status'=>'2','updated_by'=>Auth::user()->emp_id]);
            return redirect()->back()->with('succ1',['succMsg'=>'Quotation Sent Successfully']);
        }
        return view('errors.404Error');
    }


    public function downloadSalesOrder(Request $request)
    {   
            $data=$request->session()->get('pdfData');
            $d=$data[0]['data'];
            
            $dompdf = new Dompdf();
            $dompdf->loadHtml(view('emails.salesOrder')->with('data',$data[0]['data'])->with('result',$data[0]['result']));
            // (Optional) Setup the paper size and orientation   
            $dompdf->setPaper('A4', 'portrait');
            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream('SalesOrder-'.$d[0]['so'].'.pdf');
    }
    public function sendSalesOrder(Request $request){

        if(Auth::check()){
            $data=$request->session()->get('pdfData');
            Mail::to($request->input('toEmail'))->send(new Item_SalesOrder($data,$request->input('subject'),$request->input('message'),base64_encode(file_get_contents($request->file('file')->getRealPath()))));  //call to mailable class and class in App/Mail/Item_SalesOrder
            $request->session()->forget('pdfData');
             \App\SalesOrder::where('slorder_id','=',$request->input('salesOrder'))->update(['sendStatus'=>'1']);
            return redirect()->back()->with('succ1',['succMsg'=>'Sales Order Send Successfully']);
        }
        return view('errors.404Error');
    }



    /*********************************************************Ajax***************************************************/
     public function getItems(Request $request)
    {
          $item=Production_Item::select('production_item_hsn_gst.name','production_item.item_id as item_id','production_item.item_code')->join('production_item_hsn_gst','production_item.item_hsn_id','=','production_item_hsn_gst.item_hsn_id')->where('production_item_hsn_gst.name','LIKE','%'.$request->input('name').'%')->where('production_item_stock.warehouse_id','=',$request->input('warehouse'))->join('production_item_stock','production_item.item_id','=','production_item_stock.item_id')->get();
        return json_encode($item);
    }


      public function getItemDiscription($id)
    {
        $item_descr=Production_Item::where('production_item.item_id','=',$id)->select('production_item.item_code','production_item.item_price','production_item.serial_no','production_item.description','production_item_hsn_gst.item_hsn_code','production_item_hsn_gst.item_gst')->join('production_item_hsn_gst','production_item.item_hsn_id','=','production_item_hsn_gst.item_hsn_id')->get();

        $item_rate=Production_Item::where('item_id','=',$id)->select('item_price')->get();
        $list="";
        foreach ($item_descr as $key => $value) {
            $list.="Company:".$value['description']."\r\n ".
           "Item code/Model No:".$value['item_code']."\r\n ".
           "Serial No:".$value['serial_no']."\r\n ";
          $item_rate=$value['item_price'];
          $gst=$value['item_gst'];  
        }
        $arr=array($list,$item_rate,$gst,$item_descr[0]['item_hsn_code']);
        return json_encode($arr);
    }

     public function getQuotationItemDiscription($id)
    {
        $item_descr=Production_Item::where('production_item.item_id','=',$id)->select('production_item.item_code','production_item.item_price','production_item.serial_no','production_item.description','production_item_hsn_gst.item_hsn_code','production_item_hsn_gst.item_gst')->join('production_item_hsn_gst','production_item.item_hsn_id','=','production_item_hsn_gst.item_hsn_id')->get();

       $item_rate=Production_Item::where('item_id','=',$id)->select('item_price')->get();
        $list="";
        foreach ($item_descr as $key => $value) {
            $list.="Company:".$value['description']."\r\n ".
           "Item code/Model No:".$value['item_code']."\r\n ";
          
          $item_rate=$value['item_price'];
          $gst=$value['item_gst'];  
        }
        $arr=array($list,$item_rate,$gst,$item_descr[0]['item_hsn_code']);
        return json_encode($arr);
    }

     public function setQuotationSession(Request $request)
    {   
        $quotation=Quotation::select('lead.organization_name','lead.contact_person_name','lead.address','quotation_id as qtn','additional_discount_amount','valid_date','total_tax_amount','order_type','taxes_and_charges','additional_discount','total','grand_total','term_name as terms','term_details')->where('quotation_id','=',$request->input('quotation_id'))->join('lead','quotation.lead_id','=','lead.lead_id')->get();
        $quotation_items=Quotation_Item::select('quotation_items.code','quotation_items.tax','quotation_items.tax_amount','production_item_site.site_name','production_item_site.site_id','production_item_warehouse.warehouse_id','production_item_warehouse.warehouse_name','production_item_hsn_gst.name','production_item.item_id as item_id','quotation_items.description','quotation_items.quantity','quotation_items.rate','quotation_items.amount')->where('quotation.quotation_id','=',$request->input('quotation_id'))->join('quotation','quotation_items.quotation_id','=','quotation.quotation_id')->join('production_item','quotation_items.item_id','=','production_item.item_id')->join('production_item_stock','production_item.item_id','=','production_item_stock.item_id')->join('production_item_site','production_item_stock.site_id','=','production_item_site.site_id')->join('production_item_warehouse','production_item_stock.warehouse_id','=','production_item_warehouse.warehouse_id')->join('production_item_hsn_gst','production_item.item_hsn_id','=','production_item_hsn_gst.item_hsn_id')->get();
         $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $word=$numberTransformer->toWords($quotation[0]['grand_total']);
        $quotation[0]['total_in_words']=$word;
        $pdfData[]=array('data'=>$quotation,'result'=>$quotation_items);
        $request->session()->put('pdfData',$pdfData);
        $request->session()->save();
            
        return $quotation;
    }
     public function setSalesOrderSession(Request $request)
    {
        $result=SalesOrder_Item::select('production_item_hsn_gst.name as item_name','description','quantity','rate','amount')->join('production_item_hsn_gst','sales_items.item_hsn_id','=','production_item_hsn_gst.item_hsn_id')->where('slorder_id','=',$request->input('salesOrder'))->get();
        $data=salesOrder::select('lead.organization_name','lead.contact_person_name','lead.address','sales_order.delivery_date','sales_order.total','sales_order.grand_total','sales_order.term_name as terms','sales_order.term_details','sales_order.slorder_id as so','sales_order.taxes_and_charges','sales_order.additional_discount','sales_order.purchaseOrder')->join('lead','sales_order.lead_id','=','lead.lead_id')->where('sales_order.slorder_id','=',$request->input('salesOrder'))->get();
        $pdfData[]=array('data'=>$data,'result'=>$result);
        $request->session()->put('pdfData',$pdfData);
        $request->session()->save();

          
        return $data;
    }

     public function getSites(Request $request)
    {

       $site=Production_Item_Site::select('site_name','site_id')->get();
        return json_encode($site);
    }

    public function getWarehouse($id)
    {
        $warehouse =Production_Item_Warehouse::where('site_id','=',$id)->pluck('warehouse_name','warehouse_id');
        return json_encode($warehouse); 
    }

    
     public function service_infoAjax($id)
    {

        $service_descr=Production_Services::where('service_id','=',$id)->select('production_services.description','production_services.service_charge','production_service_sac_gst.service_sac_code','production_service_sac_gst.service_gst')->join('production_service_sac_gst','production_services.service_sac_id','=','production_service_sac_gst.service_sac_id')->get();
        return $service_descr;
    }
     public function serviceAutoAjax($service)
    {
        if(count($service)!=0)
        {
            $services=Production_Services::select('production_service_sac_gst.service_description','production_services.service_id')->join('production_service_sac_gst','production_services.service_sac_id','=','production_service_sac_gst.service_sac_id')->where('production_service_sac_gst.service_description','LIKE','%'.$service.'%')->get();
            return json_encode($services);
        }   
    }
    public function getQuotation(Request $request){

        $quotation=Quotation::select('quotation_id','additional_discount_amount','valid_date','total_tax_amount','order_type','taxes_and_charges','additional_discount','total','grand_total','term_name','term_details')->where('quotation_id','=',$request->input('quotation_id'))->get();
        $quotation_items=Quotation_Item::select('quotation_items.code','quotation_items.tax','quotation_items.tax_amount','production_item_site.site_name','production_item_site.site_id','production_item_warehouse.warehouse_id','production_item_warehouse.warehouse_name','production_item_hsn_gst.name','production_item.item_id as item_id','quotation_items.description','quotation_items.quantity','quotation_items.rate','quotation_items.amount')->where('quotation.quotation_id','=',$request->input('quotation_id'))->join('quotation','quotation_items.quotation_id','=','quotation.quotation_id')->join('production_item','quotation_items.item_id','=','production_item.item_id')->join('production_item_stock','production_item.item_id','=','production_item_stock.item_id')->join('production_item_site','production_item_stock.site_id','=','production_item_site.site_id')->join('production_item_warehouse','production_item_stock.warehouse_id','=','production_item_warehouse.warehouse_id')->join('production_item_hsn_gst','production_item.item_hsn_id','=','production_item_hsn_gst.item_hsn_id')->get();
            $arr=array('quotation'=>$quotation,'quotation_item'=>$quotation_items);
            return json_encode($arr);
    }
    /******************************************************End Ajax************************************************/

    /*************************************************End Amol*******************************************************/






    /**********************************Author:Rakesh Kamble********************************************************/

    
    /************************************End Kamble*******************************************************************/
}
