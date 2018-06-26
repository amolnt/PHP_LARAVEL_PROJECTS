<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales Invoice</title>

        <style>
        page[size="A4"] {  
              width: 21cm;
              height: 29.7cm; 
                }
            #just-line-break {
                white-space: pre-line;
            }
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
           * {
                 -webkit-box-sizing: border-box;
                 -moz-box-sizing: border-box;
                 box-sizing: border-box;
            }

            .m-b-md {
                margin-top: 80px;
                padding-left: 5%;
                padding-right:5%;
                word-wrap: break-word;
            }
            table {
                    border-collapse: collapse;
                    border-spacing: 0;
                    width: 100%;
                    border: 1px solid #034f4d;
                }

            th, td {
                    text-align: left;
                     padding: 8px;
                     color:black;
                }
            table,tr,td{
                 color:black;
            }
           .theads th{background-color: #d3e8e6}
           .subhead td{background-color:#dcf4f2}
           .mhead th{color:#136663}

        
        </style>
</head>

<body>
    <page size="A4">
    <div style="overflow-x:auto;" class="m-b-md">
        <table fram="box" border="1">
            <tr class="mhead">
                <th colspan="9"><center><h2>Sales Order</h2>
                                        </center></th>
            </tr>
            <tr>
                <td colspan="3" >
                <address><font face="Raleway">
                @if(isset($data)){{$data[0]['organization_name']}}@endif<br>
                @if(isset($data)){{$data[0]['contact_person_name']}}@endif<br>
                @if(isset($data)){{$data[0]['address']}}@endif<br></font>
              </address>
                </td>
                <td colspan="6"><p>
                Delivery Date:@if(isset($data)){{$data[0]['delivery_date']}}@endif<br>
                Prchase Order:@if(isset($data)){{$data[0]['purchase_order']}}@endif<br>
                Sales Order No:@if(isset($data)){{$data[0]['qtn']}}@endif</p></td>
            </tr>
            <tr class="theads">
                <th rowspan="2">Sr No</th>
                <th rowspan="2">Description</th>
                <th rowspan="2">Hsn/Sac</th>
                <th rowspan="2">Taxable Value</th>
                <th colspan="2">CGSt</th>
                <th colspan="2">SGST</th>
                <th rowspan="2">Total</th>
            </tr>
            <tr class="subhead">
                <td>Rate</td>
                <td>Amt</td>
                <td>Rate</td>
                <td>Amt</td>
            </tr>
            <?php $i=0 ?>
            @if(isset($result))
            @foreach($result as $key=>$value)
            <?php $i++ ?>
            <tr>
                <td>{{$i}}</td>
                <td>{{$value['description']}}</td>
                <td>{{$value['code']}}</td>
                <td>{{$value['tax_amount']}}</td>
                <td>{{$value['tax']}}</td>
                <td>{{$value['tax_amount']/2}}</td>
                <td>{{$value['tax']}}</td>
                <td>{{$value['tax_amount']/2}}</td>
                <td>{{$value['amount']}}</td>
            </tr>
            @endforeach
            @endif
            <tr>
                <td colspan="2"></td>
                <td>Total</td>
                <td colspan="2"></td>
                <td>@if(isset($data)){{$data[0]['total_tax_amount']/2}} @endif</td>
                <td></td>
                <td>@if(isset($data)){{$data[0]['total_tax_amount']/2}}@endif</td>

                <td>@if(isset($data)){{$data[0]['total']}}@endif</td>
            </tr>       
            <tr>
                <td colspan="3">Total Invoice Value In Words<br>
                @if(isset($data)){{$data[0]['total_in_words']}}@endif Rupees Only</td>
                <td colspan="5">
                <br>
                    Additional Discount<br>
                    Additional Discount Amount<br>
                    Total Amount Before Tax<br>
                    Add. CGST <br>                    
                    Add. CGST <br>                  
                    Tax Amount <br>                   
                    Total Amount After Tax
                </td>
                <td>
                @if(isset($data)){{$data[0]['additional_discount']}}@endif %<br>
                @if(isset($data)){{$data[0]['additional_discount_amount']}}@endif<br>
                @if(isset($data)){{$data[0]['total']}}@endif <br>
                @if(isset($data)){{$data[0]['taxes_and_charges']/2}}@endif %<br>
                @if(isset($data)){{$data[0]['taxes_and_charges']/2}}@endif %<br>
                @if(isset($data)){{$data[0]['total_tax_amount']}}@endif
                @if(isset($data)){{$data[0]['grand_total']}}@endif
                                    
                </td>
            </tr>
            <tr>
                <td colspan="9"><b>Terms And Condition:</b><br> 
                <p><h4><b>Term Title:</b>@if(isset($data)){{$data[0]['terms']}}@endif </h2></p>
            <p>@if(isset($data)){{$data[0]['term_details']}}@endif</p></td>
            </tr>
            <tr>
                <td colspan="9"><b>Time:</b><br><br><?php echo Carbon\Carbon::now();?></td>
            </tr>
            <tr>
                <td colspan="9"><b>Details:</b><br></td>    
            </tr>
           
        </table>
    </div>
    </page>
</body>
</html>