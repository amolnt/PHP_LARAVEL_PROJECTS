<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Quotation;
use App\Quotation_Item;
use App\SalesOrder;
use App\SalesOrder_Item;
use App\Item;
use Illuminate\Support\Facades\Input;
//use App\Mail\Item_Quotation;
//use Mail;
//use App\Mail\Item_Quotation;
//use App\Mail\Quotation;
//use Dompdf\Dompdf;
use NumberToWords\NumberToWords;
class SalesOperation extends Controller
{
    /***********************Author:Amol Tribhuwan****************************************/
    public function addQuotation(Request $request,$token=null){
    	if(Auth::check() && $token!=null){
    		$quotation=new Quotation();
    		$quotation->emp_id=Auth::user()->emp_id;
    		$quotation->lead_id=$request->input('lead');
    		$quotation->order_type=$request->input('order_type');
    		$quotation->taxes_and_charges=$request->input('taxes_and_charges');
    		$quotation->additional_discount=$request->input('additional_discount');
            $quotation->total=$request->input('total');
            $quotation->total_tax_amount=$request->input('total_tax_amount');
            $quotation->additional_discount_amount=$request->input('additional_discount_amount');
    		$quotation->grand_total=$request->input('grand_total');
    		$quotation->term_name=$request->input('term_name');
    		$quotation->term_details=$request->input('term_details');
            $quotation->valid_date=$request->input('valid_date');
            $quotation->created_by=Auth::user()->emp_id;
    		$quotation->save();
			
			$id=$quotation->id;
    		$result=[];
    		for($i=0;$i<count($request->input('item_name'));$i++){
    			$result[]=array('quotation_id'=>$quotation->id,
                                'code'=>$request->input('code')[$i],
                                'tax'=>$request->input('tax')[$i],
                                'tax_amount'=>$request->input('tax_amount')[$i],
    						  'item_id'=>$request->input('item_name')[$i],
                              'description'=>$request->input('description')[$i],
    						  'quantity'=>$request->input('quantity')[$i],
    						  'rate'=>$request->input('rate')[$i],
    						  'amount'=>$request->input('amount')[$i]);

                  $pdf[]=array('description'=>$request->input('description')[$i],
                             'code'=>$request->input('code')[$i],
                             'tax_amount'=>$request->input('tax_amount')[$i],
                             'tax'=>$request->input('tax')[$i],
                             'amount'=>$request->input('amount')[$i]);
    		}
    		Quotation_Item::insert($result);
    		 $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $word=$numberTransformer->toWords($request->input('grandTotal'));

    		$data[]=array('organization_name'=>$request->input('organization_name'),
    					'contact_person_name'=>$request->input('contact_person_name'),
    					'address'=>$request->input('address'),
    					'valid_date'=>$request->input('valid_date'),
    					'total'=>$request->input('total'),
    					'grand_total'=>$request->input('grandTotal'),
    					'terms'=>$request->input('term_name'),
    					'term_details'=>$request->input('term_details'),
    					'qtn'=>$id,
                        'taxes_and_charges'=>$request->input('taxes_and_charges'),
                        'additional_discount'=>$request->input('additional_discount'),
                        'additional_discount_amount'=>$request->input('additional_discount_amount'),
                        'total_tax_amount'=>$request->input('total_tax_amount'),
                        'total_in_words'=>$word);

    		$html="<input type=\"hidden\" name=\"quotation\" value=\"".$id."\">";
           
    		$pdfData[]=array('data'=>$data,'result'=>$pdf);
    		$request->session()->put('pdfData',$pdfData);
    		$request->session()->save();
            
            return redirect()->back()->with('succ',['succMsg'=>'Quotation Added Successfully','email'=>$request->input('email'),'qtn'=>$id,'html'=>$html]);
    	}
    	else
    		return view('errors.404Error');
    }
     public function updateQuotation(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            Quotation::where('quotation_id','=',$request->input('quotation'))->update(['order_type'=>$request->input('order_type'),'taxes_and_charges'=>$request->input('taxes_and_charges'),'additional_discount'=>$request->input('additional_discount'),'total'=>$request->input('total'),'total_tax_amount'=>$request->input('total_tax_amount'),'additional_discount_amount'=>$request->input('additional_discount_amount'),'grand_total'=>$request->input('grand_total'),'term_name'=>$request->input('term_name'),'term_details'=>$request->input('term_details'),'valid_date'=>$request->input('valid_date'),'updated_by'=>Auth::user()->emp_id]);
            
            for($i=0;$i<count($request->input('item_name'));$i++){
                Quotation_Item::where('quotation_id','=',$request->input('quotation'))->update(['code'=>$request->input('code')[$i],'tax'=>$request->input('tax')[$i],'tax_amount'=>$request->input('tax_amount')[$i],'item_id'=>$request->input('item_name')[$i],'description'=>$request->input('description')[$i],'quantity'=>$request->input('quantity')[$i],'rate'=>$request->input('rate')[$i],'amount'=>$request->input('amount')[$i]]);

                  $pdf[]=array('description'=>$request->input('description')[$i],
                             'code'=>$request->input('code')[$i],
                             'tax_amount'=>$request->input('tax_amount')[$i],
                             'tax'=>$request->input('tax')[$i],
                             'amount'=>$request->input('amount')[$i]);
            }
            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $word=$numberTransformer->toWords($request->input('grandTotal'));

            $data[]=array('organization_name'=>$request->input('organization_name'),
                        'contact_person_name'=>$request->input('contact_person_name'),
                        'address'=>$request->input('address'),
                        'valid_date'=>$request->input('valid_date'),
                        'total'=>$request->input('total'),
                        'grand_total'=>$request->input('grandTotal'),
                        'terms'=>$request->input('term_name'),
                        'term_details'=>$request->input('term_details'),
                        'qtn'=>$request->input('quotation'),
                        'taxes_and_charges'=>$request->input('taxes_and_charges'),
                        'additional_discount'=>$request->input('additional_discount'),
                        'additional_discount_amount'=>$request->input('additional_discount_amount'),
                        'total_tax_amount'=>$request->input('total_tax_amount'),
                        'total_in_words'=>$word);

            $html="<input type=\"hidden\" name=\"quotation\" value=\"".$request->input('quotation')."\">";
           
            $pdfData[]=array('data'=>$data,'result'=>$pdf);
            $request->session()->put('pdfData',$pdfData);
            $request->session()->save();
            
            return redirect()->back()->with('succ',['succMsg'=>'Quotation Updated Successfully','email'=>$request->input('email'),'qtn'=>$request->input('quotation'),'html'=>$html]);
        }
        else
            return view('errors.404Error');
    }
    /************************************Add to datatbase****************************/
    public function addSalesOrder(Request $request,$token=null){
        if(Auth::check() && $token!=null){
            $sales=new SalesOrder();
            $sales->emp_id=Auth::user()->emp_id;
            $sales->lead_id=$request->input('salesOrderead');
            $sales->purchaseOrder=$request->input('purchaseOrder');
            $sales->order_type=$request->input('order_type');
            $sales->taxes_and_charges=$request->input('txAndChrg');
            $sales->additional_discount=$request->input('adsDisPer');
            $sales->total=$request->input('total');
            $sales->grand_total=$request->input('grandTotal');
            $sales->term_name=$request->input('terms');
            $sales->term_details=$request->input('term_details');
            $sales->delivery_date=$request->input('delivery_date');
            $sales->save();
                
            $id=$sales->id;
            $result=[];
            $pdf=[];
            for($i=0;$i<count($request->input('item_name'));$i++){
                $result[]=array('slorder_id'=>$sales->id,
                                'production_type'=>$request->input('type')[$i],
                                'item_id'=>$request->input('item_name')[$i],
                                'description'=>$request->input('description')[$i],
                                'quantity'=>$request->input('quantity')[$i],
                                'rate'=>$request->input('rate')[$i],
                                'amount'=>$request->input('amount')[$i]);
                $pdf[]=array('description'=>$request->input('description')[$i],
                             'code'=>$request->input('code')[$i],
                             'tax_amount'=>$request->input('tax_amount')[$i],
                             'tax'=>$request->input('tax')[$i],
                             'amount'=>$request->input('amount')[$i]);
            }
            
            SalesOrder_Item::insert($result);
            
            $data[]=array('organization_name'=>$request->input('organization_name'),
                        'contact_person_name'=>$request->input('contact_person_name'),
                        'address'=>$request->input('address'),
                        'delivery_date'=>$request->input('delivery_date'),
                        'total'=>$request->input('total'),
                        'grand_total'=>$request->input('grandTotal'),
                        'terms'=>$request->input('terms'),
                        'term_details'=>$request->input('term_details'),
                        'so'=>$id,
                        'purchaseOrder'=>$request->input('purchaseOrder'),
                        'taxes_and_charges'=>$request->input('txAndChrg'),
                        'additional_discount'=>$request->input('adsDisPer'));
            
            $html="<input type=\"hidden\" name=\"salesOrder\" value=\"".$id."\">";

            $pdfData[]=array('data'=>$data,'result'=>$pdf);
            $request->session()->put('pdfData',$pdfData);
            $request->session()->save();

            return redirect()->back()->with('succ',['succMsg'=>'Sales Order Add Successfully','email'=>$request->input('email'),'so'=>$id,'type'=>'salesOrder','html'=>$html]);   
        }
        else
            return view('errors.404Error');
    }
    /****************************************End Amol***************************************************************/

    /***************************************Author:Rakesh Kamble******************************************************/

    /*******************************************End Kamble*************************************************************/
}
