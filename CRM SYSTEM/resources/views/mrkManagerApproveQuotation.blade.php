<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
@section('import')
    <!-- Include SmartWizard CSS -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />
    
    <!-- Optional SmartWizard theme -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard_theme_dots.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('assets/css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/dropdown.css')}}">
  @endsection
  @section('pageContent')
     <div class="right_col" id="top" role="main">
            <div class="row ">
              <div class="col-md-12 col-xs-12 col-sm-12" >
                <div class="x_panel tab-content">
                  <div class="x_title">
                    <h2>Lead Action And Response</h2>
                         @if(Session::has('succ') || Session::has('succ1') || Session::has('succMsg'))
                  <div class="alert alert-success alert-dismissible fade in col-md-9" role="alert" id="succMsg">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span>
                    </button>
                    <strong>
                        @if(Session::has('succ'))
                            {{Session::get('succ')['succMsg'] }}
                        @endif
                        @if(Session::has('succ1'))
                            {{Session::get('succ1')['succMsg'] }}
                        @endif  
                        @if(Session::has('succMsg'))
                            {{Session::get('succMsg') }}
                        @endif                                    
                    </strong>
                  </div>
                  @endif
                  @if(Session::has('errorMsg'))
                  <div class="alert alert-danger alert-dismissible fade in col-md-9" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>
                    {{ Session::get('errorMsg')}}
                    </strong>
                  </div>
                  @endif
                    <div class="clearfix"></div>
                  </div>
                <div class="x_content">
                @if(Session::has('succ'))
                <fieldset>
                  <legend>Quotation</legend>
                  <fieldset>
                  <legend>Download Quotation</legend>
                    <a href="/downloadQuotation"> Click to Download Quotaion </a> 
                  </fieldset>
                  <br>
                   <fieldset>
                  <legend>Request To Resend Quotation</legend>
                        <form id="quotationForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('MrkManagerOperation@resendRequest',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <?php
                                echo Session::get('succ')['html'];
                            ?>
                        <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" onClick="window.location.reload()" type="button">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Resend">
                          </div>
                        </div>
                        </form>
                  </fieldset>
                </fieldset>
                @endif
                <!--**************************************Create Quotation*********************************************-->
                  <div id="showEditQuotation">
                  <div id="editQuotation" class="collapse edit">
                  
                   <form id="quotationForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('SalesOperation@updateQuotation',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" id="quotation" name="quotation">
                    <!-- SmartWizard html -->
                    <fieldset>
                      <legend>Steps To Create Quotation</legend>
                      <div class="smartwizard">
                      <ul>
                          <li><a href="#qstep-1">Step 1<br /><small>Quotation Info</small></a></li>
                          <li><a href="#qstep-2">Step 2<br /><small>Add Items</small></a></li>
                          <li><a href="#qstep-3">Step 2<br /><small>Taxes Charges And Discount</small></a></li>
                          <li><a href="#qstep-4">Step 2<br /><small>Terms And Condition</small></a></li>
                      </ul>
                    <div>

                    <div id="qstep-1">
                    <fieldset>
                      <legend>Quotation Info</legend>
                      <div id="qform-step-0" role="form" data-toggle="validator">
                      <div class="form-group ">
                        <label class="col-md-3 control-label">Lead<span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                          <input type="text" name="organization_name" id="organization_name" class="form-control" required>
                         <input type="hidden" name="lead" id="quotationLead" class="form-control">
                         
                        </div>
                      </div>

                       <div class="form-group ">
                          <label class="col-md-3 control-label">Address<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <textarea name="address" id="address" class="form-control"></textarea>
                           
                          </div>
                        </div>
                        <div class="form-group ">
                          <label class="col-md-3 control-label">Email<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="email" id="email"  class="form-control">
                          </div>
                        </div>
                        <div class="form-group ">
                          <label class="col-md-3 control-label">Mobile number<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="mobile_no" id="mobile_no"  class="form-control">
                          </div>
                        </div>
                        <div class="form-group ">
                          <label class="col-md-3 control-label">Conract Person Name<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="contact_person_name" id="contact_person_name"  class="form-control">
                          </div>
                      </div>


                        <div class="form-group">
                        <label class="col-md-3 control-label">Order Type<span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <select id="order_type" name="order_type" class="form-control owner "  required>
                               <option value="">--Select Type--</option>
                               <option>Sales</option>
                               <option>Maintainance</option>
                               <option>Shopping Cart</option>
                            </select>
                             <div class="help-block with-errors"></div>
                        </div>
                      </div>

                      <div class="form-group ">
                        <label class="col-md-3 control-label">Valid Date<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            
                           
                          <div class="form-group">
                            <div class='input-group date' id='myDatepicker2'>
                            <input type='text' id="valid_date" name="valid_date" class="form-control"/ required>
                             <div class="help-block with-errors"></div>
                            <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                            </span>  
                          </div>
                        </div>
                           
                          </div>
                      </div>
                      </div>
                      </fieldset>
                      </div><!--End First step-->


                      <div id="qstep-2">
                        <fieldset>
                          <legend>Add Items</legend>
                      <div class="col-md-12 ">
                      <a href="javascript:void(0);" id='anc_add' class="btn btn-info">Add Item</a>
                      <a href="javascript:void(0);" id='anc_rem' class="btn btn-danger">Remove Item</a>
                      <table id="tblItem" class="table table-bordered">
                   
                        <tr>
                          <td><input type="checkbox" id="checkAll" name="chk"></td>
                          <td hidden=""></td>
                          <td hidden=""></td>
                          <td hidden=""></td>
                        
                         <td>Item Site</td>
                          <td>Item Warehouse</td>
                          <td>Item Name/Model Number</td>
                          <td>Discription</td>
                          <td>Quantity   </td>
                          <td>Rate       </td>
                          <td>Amount     </td>
                        </tr>
                      </table>
                      </div>


                        <div class="form-group ">
                          <label class="col-md-8 control-label">Total<span class="required">*</span></label>
                          <div class="col-md-2 col-sm-6 col-xs-12">
                            <input type="text" name="total" id="total"  class="form-control col-md-2" readonly>
                            <input type="hidden" name="total_tax_amount" id="total_tax_amount"  class="form-control col-md-2" >
                          </div>
                      </div>
                        </fieldset>
                      </div><!--End Fourth step-->

                      <div id="qstep-3">
                        <fieldset>
                          <legend>Taxes Charges And Discount</legend>
                          <div id="qform-step-2" role="form" data-toggle="validator">
                           
                             <div class="form-group ">
                          <label class="col-md-3 control-label">Additional Discount Percentage<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="additional_discount" id="additional_discount"  class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Additional Discount Ammount<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="additional_discount_amount" id="additional_discount_amount"  class="form-control" readonly>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>


                           <!--div class="form-group ">
                          <label class="col-md-3 control-label">Taxes Type<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <select name="txType" class="form-control">
                              <option>--Select Tax Type--</option>
                              <option>GST</option>
                              <option>IGST</option>
                            </select>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div-->

                  <div class="form-group ">
                          <label class="col-md-3 control-label">Taxes And Charges<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                              <input type="text" name="taxes_and_charges" id="taxes_and_charges"  class="form-control" readonly= required>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>

                     
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Grand Total<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="grand_total" id="grand_total"  class="form-control" readonly>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>
                      </div>  
                        </fieldset>              

                      </div><!--End Third step-->
                      <div id="qstep-4">
                        <fieldset>
                          <legend>Terms And Condition</legend>
                          <div id="qform-step-3" role="form" data-toggle="validator">
                            <div class="form-group ">
                          <label class="col-md-3 control-label">Terms<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="term_name" id="term_name"  class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Terms Details<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                              <textarea name="term_details" id="term_details" class="editor-wrapper form-control" required></textarea>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>
                      </div>
                        </fieldset>
                      </div><!--End Fourth step-->
                      
                      </div>
                      </div>
                    </fieldset>
                   </form>
                   </div>
                  </div><!--End Quotation     -->

                  <div id="showApproveQuotation">
                  <fieldset id="approve" class="collapse">
                    <legend>Create Opportunity</legend>
                  <form class="form-horizontal form-label-left input_mask" method="post" action="{{action('MrkManagerOperation@approveQuotation',csrf_token())}}" enctype="multipart/form-data" role="form" data-toggle="validator" id="approveForm" accept-charset="utf-8">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <input type="hidden" name="lead" id="approve_lead">

                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Quotation Approve Status<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                          <select id="approve_status" name="approve_status" class="form-control" required>
                                <option value="">--Select Approve Status--</option>
                                  <option value="1">Approved</option>
                                  <option value="0">Disapproved</option>
                              </select>
                              <div class="help-block with-errors"></div>
                         </div>
                      </div>

                       <div class="form-group" id="account" hidden>
                        <label class="control-label col-md-3" for="first-name">Account Name<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                          <select id="approve_account_name" name="account_name" class="form-control">
                                <option value="">--Select Account Name--</option>
                                
                                  
                              </select>
                              <div class="help-block with-errors"></div>
                         </div>
                      </div>
                    <div id="detail" hidden>
                        <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Lead Owner<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="approve_owner" name="owner" class="form-control" readonly >
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>

                     

                       <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Quotation Number<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="approve_quotation_number" name="quotation_number" class="form-control" readonly >
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Organization Name<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="approve_organization_name" name="organization_name" class="form-control" readonly >
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Contact Person Name<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="approve_contact_person_name" name="contact_person_name" class="form-control" readonly required>
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>

                     <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="approve_email" name="email" class="form-control" readonly required>
                           
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Lead Status<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                          <select id="approve_leadStatus" name="status" class="form-control detal">
                                <option value="">--Select Lead Status--</option>
                                  <option value="Not Attempted">Not Attempted</option>
                                  <option value="Attempted">Attempted</option>
                                  <option value="Contacted">Contacted</option>
                                  <option value="New Opportunity">New Opportunity</option>
                                  <option value="Disqualified">Disqualified</option>
                              </select>
                              <div class="help-block with-errors"></div>
                         </div>
                      </div>


                      

                       <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Close Date</label>
                          <div class="form-group col-md-7">
                            <div class="component-box"> 
                                <!--Datepicker with left header example -->
                                <div class="pmd-card pmd-z-depth pmd-card-custom-view">
                                  <div class="pmd-card-body"> 
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                      <input type="text" name="approve_closeDate" data-header-left="true" class="form-control datepicker-left-header detal" />
                                    </div>              
                                  </div>
                                </div> <!--Datepicker with left header example end-->
                              </div>
                            <div class="help-block with-errors"></div>
                       </div>
                     </div>

                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Approve Stages<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                          <select id="approve_stage" name="approve_stage" class="form-control detal" >
                                <option value="">--Select Approve Stage--</option>
                                  <option value="">Identify Opportunity</option>
                                  <option value="Identify Opportunity">Qualified Opportunity</option>
                                  <option value="Assign To Soution Architect">Assign To Soution Architect</option>
                                  <option value="Solution Closed">Solution Closed</option>
                                  <option value="Proposal Sent">Proposal Sent</option>
                                  <option value="Shortlisted">Shortlisted</option>
                                  <option value="Verbal Aggrement">Verbal Aggrement</option>
                                  <option value="Closed Won-Cof Received">Closed Won-Cof Received</option>
                                  <option value="Closed Won-Order Processing">Closed Won-Order Processing</option>
                                  <option value="Closed Won-Partially Won">Closed Won-Partially Won</option>
                                  <option value="Closed Won-Order Accepted">Closed Won-Order Accepted </option>
                                  <option value="Colsed Dropped">Colsed Dropped</option>
                                  <option value="Closed Lost">Closed Lost</option>
                              </select>
                              <div class="help-block with-errors"></div>
                         </div>
                      </div>

                      <div class="form-group" id="reason" hidden>
                        <label class="control-label col-md-3" for="first-name">Reason Lost</label>
                        <div class="col-md-7">
                             <input type="text" id="approve_reasonLost" name="reason_lost" class="form-control">
                            
                         </div>
                      </div>
                    </div>
                      <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" data-toggle="collapse" data-target="#approve" type="reset">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Submit">
                          </div>
                        </div>
                    </form>
                  </fieldset>
                  <br>

                  <fieldset>
                    <legend>All Leads</legend>
                      <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                         
                          <th hidden>Lead id</th>
                          <th hidden>Lead Source</th>
                          <th hidden>Address</th>
                          <th hidden>Approve</th>
                          <th>Quotation Number</th>
                          <th>organization Name</th>
                          <th>Contact Person Name</th>
                          <th>Mobile No</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Owner</th>
                          <th>Resend Quotation Status</th>
                          <th>Quotation Approve status</th>
                          
                        </tr>
                      </thead>

                      <tbody>
                      
                        @if(isset($data))
                            <?php
                                for ($i=0; $i <count($data) ; $i++) {
                                  echo "<tr>";
                                  echo "<td hidden>".$data[$i]['lead_id']."</td>";
                                  echo "<td hidden>".$data[$i]['lead_source']."</td>";
                                  echo "<td hidden>".$data[$i]['address']."</td>";
                                  echo "<td hidden>".$data[$i]['approve_id']."</td>";
                                  echo "<td>".$data[$i]['quotation_id']."</td>";
                                  echo "<td>".$data[$i]['organization_name']."</td>";
                                  echo "<td>".$data[$i]['contact_person_name']."</td>";
                                  echo "<td>".$data[$i]['mobile_no']."</td>";
                                  echo "<td>".$data[$i]['email']."</td>";
                                  echo "<td>".$data[$i]['status']."</td>";
                                  echo "<td>".$data[$i]['full_name']."</td>";
                                   if($data[$i]['resend_status']=='2'){
                                        echo '<td> <a class="btn btn-success btn-xs"  >
                                    <span class="fa fa-check" > Resend</span>
                                    </a></td>';
                                      }
                                      else if($data[$i]['resend_status']=='1'){
                                          echo '<td> <a class="btn btn-success btn-xs"  >
                                    <span class="fa fa-check"> Requested</span>
                                    </a></td>';
                                      }
                                      else{
                                          echo '<td> <a class="btn btn-danger btn-xs"  >
                                    <span class="fa fa-remove" >Not Requested</span>
                                    </a></td>';
                                      }
                                  if($data[$i]['approve_status']==1){
                                        echo '<td> <a class="btn btn-success btn-xs"  >
                                    <span class="fa fa-check" > Approve</span>
                                    </a></td>';
                                      }
                                    else
                                      {
                                        echo '<td> <a class="btn btn-danger btn-xs approve" data-toggle="collapse" data-target="#approve">
                                                  <span class="fa fa-remove" >Approve</span>
                                                </a><a class="btn btn-primary btn-xs editQuotation" data-toggle="collapse" data-target="#editQuotation">
                                    <span class="fa fa-edit" > Edit</span>
                                    </a></td>';
                                      }

                                 echo "</tr>";
            
                              }
                            ?>
                        @endif
                        <!--tr>
                          <td><input type="radio" id="check-all" name="get" class="radio" value="1"></td>
                          <td hidden>1</td>
                          <td>New English School</td>
                          <td>Amol Narayan Tribhuwan</td>
                          <td>9860603677</td>
                          <td>tribhuwan131@gmail.com</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                       </tr>
                       <tbody-->
                       </tbody>
                    </table>
                    </fieldset>
                  </div>
                </div>
              </form>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
  </div>




<!-- ****************************Action Response********************************************-->
<script type="text/javascript">
 $('.editQuotation').click(function(event){
    $('#quotationLead').val($(this).parents().siblings('td').eq(0).text()); 
    $('#quotation').val($(this).parents().siblings('td').eq(4).text()); 
    $('#organization_name').val($(this).parents().siblings('td').eq(5).text());
    $('#address').val($(this).parents().siblings('td').eq(2).text());
    $('#contact_person_name').val($(this).parents().siblings('td').eq(6).text());
    $('#email').val($(this).parents().siblings('td').eq(8).text());
    $('#mobile_no').val($(this).parents().siblings('td').eq(7).text());
    $.ajax({
            url: '/getQuotation/ajax/',
            data:{quotation_id:$(this).parents().siblings('td').eq(4).text()},
            type: "GET",
            dataType: "json",
            success:function(data) {
             
              var quotation=data['quotation'];
              var quotation_items=data['quotation_item'];

              $('#valid_date').val(quotation[0]['valid_date']);
              $('#order_type').val(quotation[0]['order_type']);
              $('#total').val(quotation[0]['total']);
              $('#taxes_and_charges').val(quotation[0]['taxes_and_charges']);
              $('#additional_discount').val(quotation[0]['additional_discount']);
              $('#additional_discount_amount').val(quotation[0]['additional_discount_amount']);
              $('#grand_total').val(quotation[0]['grand_total'])
              $('#term_name').val(quotation[0]['term_name']);
              $('#term_details').val(quotation[0]['term_details']);
             
              $('#total_tax_amount').val(quotation[0]['total_tax_amount']);
              var index=1;
              for(var i=0;i<quotation_items.length;i++){
                $('#tblItem tr').last().after('<tr class="targetfields"><td><input class="chk" type="checkbox" name="chk"></td><td hidden><input type="text" name="code[]" id="code'+index.toString()+'" value="'+quotation_items[i]['code']+'"></td> <td hidden><input type="text" name="tax[]" id="tax'+index.toString()+'" value="'+quotation_items[i]['tax']+'"></td><td hidden><input type="text" name="tax_amount[]" id="tax_amount'+index.toString()+'" value="'+quotation_items[i]['tax_amount']+'"></td><td class="col-md-2"><select id="site'+index.toString()+'" name="site[]" onchange="mySite(this)" class="site form-control"></select></td><td class="col-md-2"><select  id="warehouse'+index.toString()+'" class="warehouse form-control" ></select></td><td class="col-md-2"><select onchange="changeItem(this)" name="item_name[]" id="item_name'+index.toString()+'" class="item_name form-control selectpicker" data-live-search="true"><option value="'+quotation_items[i]['item_id']+'"selected>'+quotation_items[i]['name']+'</option></select></td><td><textarea name="description[]" rows="2" cols="60" class="form-control description" id="description'+index.toString()+'" readonly>'+quotation_items[i]['description']+'</textarea></td><td><input type="text" class="form-control quantity" onkeyup="myQuantity(this)" value="'+quotation_items[i]['quantity']+'"  name="quantity[]" id="quantity'+index.toString()+'" readonly></td><td><input type="text" class="form-control rate" name="rate[]" value="'+quotation_items[i]['rate']+'" id="rate'+index.toString()+'" readonly></td><td><input type="text" id="amount'+index.toString()+'" class="form-control amount" value="'+quotation_items[i]['amount']+'" name="amount[]" readOnly></td></tr>');
               
                  $('.selectpicker').selectpicker('refresh');
                  getSites(index,quotation_items[i]['site_id']);

                  getWarehouse(index,quotation_items[i]['site_id'],quotation_items[i]['warehouse_id']);
                 
                 index+=1;
            }
          }
    });
    $('html, body').animate({
        scrollTop: $("#showEditQuotation").offset().top
    }, 2000);
  });//end edit quotation
    function getSites(index,site_id){
     $.ajax({
              url:'/getSites/ajax',
              type:"GET",
              dataType:"json",
              success:function(data){
                $('#site'+index.toString()).empty();
                $('#site'+index.toString()).append('<option>--Select Site--</option>');
                for(var j=0;j<data.length;j++){
                  $('#site'+index.toString()).append('<option value="'+ data[j]['site_id'] +'">'+ data[j]['site_name'] +'</option>');
                }
                $('#site'+index.toString()).val(site_id);
              }
        });
  }
  function getWarehouse(index,site_id,warehouse_id){
    
    setTimeout(function() {
    $.ajax({
            url: '/getWarehouse/ajax/'+site_id,
            type: "GET",
            dataType: "json",
            success:function(data) { 
           
              $('#warehouse'+index.toString()).empty();
              $('#warehouse'+index.toString()).append('<option value="">--select warehouse--</option>');
              for(var j=0;j<data.length;j++){
                $('#warehouse'+index.toString()).append('<option value="'+ data[j]['warehouse_id'] +'">'+ data[j]['warehouse_name'] +'</option>');
              }
              $('#warehouse'+index.toString()).val(warehouse_id);
            }
    });

  },1000);
  
  }
var val;
function approve(arg){
  val=arg.getAttribute('name');
}
  $(document).ready(function(){
        $('select[name="approve_status"]').on('change', function() {
         
              if($(this).val()=='1'){
                $('#account').show();
                $('#approve_account_name').attr('required',true);
                $('.detal').attr('required',false);
                $('#detail').hide();
              }
              else{
                  $('#account').hide();
                  $('#approve_account_name').attr('required',false);
                  $('.detal').attr('required',false);
                  $('#detail').hide(); 
              }
          }); 
          $('select[name="account_name"]').on('change', function() {
              if($(this).val().length!=0){
                $('#detail').show();
                $('.detal').attr('required',true);
              }
              else{
                  $('#detail').hide();
                  $('.detal').attr('required',false); 
              }
          });

          $('select[name="approve_stage"]').on('change', function() {
              if($(this).val()=='Closed Lost'){
                $('#reason').show();
                $('#approve_reasonLost').attr('required',true);
              }
              else{
                
                  $('#reason').hide(); 
                  $('#approve_reasonLost').attr('required',false);
              }
          });


            $('.approve').click(function(event){
                $.ajax({
                    url: '/getAccounts/ajax/',
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#approve_account_name').empty();
                        $('#approve_account_name').append('<option value=\"\">--Select Account--</option>');
                        for(var i=0;i<data.length;i++){
                            $('#approve_account_name').append('<option value="'+ data[i]['customer_id'] +'">'+ data[i]['account_name'] +'</option>');
                        }
                    }
                  });

                $('#approve_lead').val($(this).parents().siblings('td').eq(0).text());
                $('#approve_owner').val($(this).parents().siblings('td').eq(10).text());
                $('#approve_quotation_number').val($(this).parents().siblings('td').eq(4).text());
                $('#approve_organization_name').val($(this).parents().siblings('td').eq(5).text());
                $('#approve_contact_person_name').val($(this).parents().siblings('td').eq(6).text());
                $('#approve_email').val($(this).parents().siblings('td').eq(8).text());
                $("#leadStatus option:contains(" + $(this).parent().siblings('td').eq(9).text() + ")").attr('selected', 'selected');
                $('html, body').animate({
                  scrollTop: $("#showApproveQuotation").offset().top
                }, 2000);
                //$('#approve').val($(this).parents().siblings('td').eq(3).text());
                //$('#approveForm').submit();
            });

});
</script>
 <!--           *********************Quotation*****************************************************************-->
     <!-- bootstrap-daterangepicker -->
     <script src="{{asset('assets/js/chosen.jquery.min.js')}}"></script>
     <script type="text/javascript">

          $('#cancel').click(function(){
              location.reload();
          });
            $("#anc_add").click(function(){
              $('#tblItem tr').last().after('<tr class="targetfields"><td><input class="chk" type="checkbox" name="chk"></td><td hidden><input type="text" name="code[]" id="code'+$('#tblItem tr').size()+'"></td> <td hidden><input type="text" name="tax[]" id="tax'+$('#tblItem tr').size()+'"></td><td hidden><input type="text" name="tax_amount[]" id="tax_amount'+$('#tblItem tr').size()+'"></td><td class="col-md-2"><select id="site'+$('#tblItem tr').size()+'" name="'+$('#tblItem tr').size()+'" onchange="mySite(this)" class="site form-control"></select></td><td class="col-md-2"><select  id="warehouse'+$('#tblItem tr').size()+'" class="warehouse form-control" ></select></td><td class="col-md-2"><select onchange="changeItem(this)" name="item_name[]" id="item_name'+$('#tblItem tr').size()+'" class="item_name form-control selectpicker" data-live-search="true"></select></td><td><textarea name="description[]" rows="2" cols="60" class="form-control description" id="description'+$('#tblItem tr').size()+'" readonly></textarea></td><td><input type="text" class="form-control quantity" onkeyup="myQuantity(this)"  name="quantity[]" id="quantity'+$('#tblItem tr').size()+'" readonly></td><td><input type="text" class="form-control rate" name="rate[]" id="rate'+$('#tblItem tr').size()+'" readonly></td><td><input type="text" id="amount'+$('#tblItem tr').size()+'" class="form-control amount" name="amount[]" readOnly></td></tr>');
           
                $('.selectpicker').selectpicker('refresh');
                var index=0;
                $("#tblItem .targetfields").each(function() {
                      index+=1;
                });
              
                $.ajax({
                      url:'/getSites/ajax',
                      type:"GET",
                      dataType:"json",
                      success:function(data){
                         $('#site'+index).empty();
                        $('#site'+index).append('<option>--Select Site--</option>');
                        for(var i=0;i<data.length;i++){
                         $('#site'+index).append('<option value="'+ data[i]['site_id'] +'">'+ data[i]['site_name'] +'</option>');
                         }
                      }
                  });
            });
            
            function myQuantity(arg){
             var index=arg.getAttribute('id')[arg.getAttribute('id').length-1];
              $('#amount'+index).val($('#rate'+index).val()*$('#quantity'+index).val());
              $('#tax_amount'+index).val(($('#tax'+index).val()*$('#amount'+index).val())/100);
              var ind=1;
              var amount=0;
              $("#tblItem .targetfields").each(function() {
                 if(!isNaN($("#amount"+ind).val())){
                      amount+= parseInt($("#amount"+ind).val());

                      ind+=1;
                   }
              });
              $("#total").val(amount);
                ind=1;
               amount=0;
              $("#tblItem .targetfields").each(function() {
                 if(!isNaN($("#tax_amount"+ind).val())){
                      amount+= parseInt($("#tax_amount"+ind).val());

                      ind+=1;
                   }
              });
              $("#total_tax_amount").val(amount);

            }
           function mySite(arg){
             var index=arg.getAttribute('id')[arg.getAttribute('id').length-1];
              var siteID = $('#site'+index).val();
              if(siteID) {
                $.ajax({
                    url: '/warehouse/ajax/'+siteID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {  
                        $('#warehouse'+index).empty();
                        $('#warehouse'+index).append('<option value="">--select warehouse--</option>');
                        $.each(data, function(key, value) {
                            $('#warehouse'+index).append('<option value="'+ key +'">'+ value +'</option>');
                        });
                  
                    }
                });
            }else{
                $('#warehouse'+index).empty();
            }
        }
        
          $("#anc_rem").click(function(){
            if($('#tblItem tr').size()>1){
            var checked = jQuery('chk:checked').map(function () {
                            return this.value;
                          }).get();
                  jQuery('.chk:checked').parents('#tblItem tr').remove();
                  $('#checkAll').prop('checked',false);

                  var total = 0;
                  var index;
                  $("#tblItem .targetfields").each(function() {
                  index= $(this).closest('tr').index();
                 });
                var qty = parseInt($("#quantity"+index).val());
                var rate = parseFloat($("#rate"+rate).val());
                var amount = qty * rate;

               $("#amount"+index).val(amount);
               if(!isNaN(amount))
                   total+=amount;
            $("#total").val(total);
            }else{
                return false;
            }
          });

        $("#checkAll").click(function () {
               $('input:checkbox').not(this).prop('checked', this.checked);
         });      
                  
        $("#additional_discount").keyup(function(event){
                        var total=0;
                        var total=parseFloat($("#total").val());
                        var dis=parseFloat($(this).val());
                        var discountAmount=(((dis/100) * total));
                        $("#additional_discount_amount").val(discountAmount);
                        total-=discountAmount;
                      var grandTotal=0;
                      var total=parseFloat($("#grand_total").val());
                      if(isNaN(total)){
                          var total=0;
                          var total=parseFloat($("#total").val());

                          var dis=parseFloat($(this).val());
                          var discountAmount=(((dis/100) * total));
                          $("#additional_discount_amount").val(discountAmount);
                          total-=discountAmount;
                          $("#grand_total").val(total);
                      }
                      else{
                          var tax=parseFloat($(this).val());
                          var grandTotal=((tax * total)/100)+total;
                          $("#grand_total").val(grandTotal);
                      }
                        $("#grand_total").val(total);

                        var grandTotal=0;
                      var total=parseFloat($("#grand_total").val());
                      if(isNaN(total)){
                          var total=0;
                          var total=parseFloat($("#total").val());
                          var dis=parseFloat($(this).val());
                          var discountAmount=(((dis/100) * total));
                          $("#additional_discount_amount").val(discountAmount);
                          total-=discountAmount;
                          $("#grand_total").val(total);
                      }
                      else{
                          var tax=parseFloat($(this).val());
                          var grandTotal=((tax * total)/100)+total;
                          $("#grand_total").val(grandTotal);

                      }
        });

    function myFunction(arg){
       var index=arg.getAttribute('id')[arg.getAttribute('id').length-1];
        $('#item_name'+index).empty();
           //clearTimeout(typingTimer);
            var name = $('#item'+index).val();
           
             // typingTimer = setTimeout(function(){
          
          
              $.ajax({
                      url:'/itemAuto/ajax/',
                      data:{name:name,warehouse:$('#warehouse'+index).val()},
                      type:"GET",
                      dataType:"json",
                      success:function(data){
                    // $('.item_name').empty();
                    $('#item_name'+index).append('<option value="">--select Item--</option>');
                     for(var i=0;i<data.length;i++){
                     $('#item_name'+index).append('<option value="'+ data[i]['item_id'] +'">'+ data[i]['name']+' / '+data[i]['item_code'] +'</option>');
                   }
                        $('#item_name'+index).selectpicker('refresh');
                      }

                  });
      }  

      function changeItem(arg){
        var index=arg.getAttribute('id')[arg.getAttribute('id').length-1];
         
              var itemID = $('#item_name'+index).val();
              if(itemID) {
                $.ajax({
                    url: '/item_infoQuotation/ajax/'+itemID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                     for(var i=0;i<data.length;i++){
                      $('#description'+index).html(data[0]);
                      $('#rate'+index).val(data[1]);
                      $('#taxes_and_charges').val(data[2]);
                      $('#tax'+index).val(data[2]);
                      $('#code'+index).val(data[3]);
                      $('#tax_amount'+index).val(((data[2] * data[1])/100));
                      }
                    $('#quantity'+index).attr("readonly",false);
                    
                    }
                });
            }else{return false;}          
      }
/************************end********************************************************/


/******************************Ajax******************************************/
    
        </script>  
     <!--*******************************************Wizard***************************************************/-->
  <!-- Include jQuery Validator plugin -->
    <script src="{{asset('assets/smart_wizard/validator.min.js')}}"></script>
    <!-- Include SmartWizard JavaScript source -->
    <script type="text/javascript" src="{{asset('assets/smart_wizard/dist/js/jquery.smartWizard.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                                             .addClass('btn btn-info')
                                             .on('click', function(){ 
                                                    if( !$(this).hasClass('disabled')){ 
                                                        var elmForm="";
                                                        
                                                          elmForm = $("#quotationForm");
                                                       
                                                        
                                                        if(elmForm){
                                                            elmForm.validator('validate'); 
                                                            var elmErr = elmForm.find('.has-error');
                                                            if(elmErr && elmErr.length > 0){
                                                                return false;    
                                                            }else{
                                                                elmForm.submit();
                                                                return false;
                                                            }
                                                        }
                                                    }
                                                });
            var btnCancel = $('<button data-toggle=\"collapse\" data-target=\"#editQuotation\"></button>').text('Cancel')
                                             .addClass('btn btn-danger')
                                             .on('click', function(){ 
                                                    $('.smartwizard').smartWizard("reset");
                                                });                         
            
            
            
            // Smart Wizard
            $('.smartwizard').smartWizard({ 
                    selected: 0, 
                    theme: 'dots',
                    transitionEffect:'fade',
                    toolbarSettings: {toolbarPosition: 'bottom',
                                      toolbarExtraButtons: [btnFinish, btnCancel]
                                    },
                    anchorSettings: {
                                markDoneStep: true, // add done css
                                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                                removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                            }
                 });
            
            $(".smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {

                var elmForm="";
                   elmForm = $("#qform-step-" + stepNumber);
               
                
                // stepDirection === 'forward' :- this condition allows to do the form validation 
                // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
                if(stepDirection === 'forward' && elmForm){
                    elmForm.validator('validate'); 
                    var elmErr = elmForm.children('.has-error');
                    if(elmErr && elmErr.length > 0){
                        // Form validation failed
                        return false;    
                    }
                }
                return true;
            });
            
            $(".smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
                // Enable finish button only on last step
                if(stepNumber == 3){ 
                    $('.btn-finish').removeClass('disabled');  
                }else{
                    $('.btn-finish').attribute('hidden');
                }
                
            });                               
        });   

         
    </script> 

  <!--*****************************************Wizard End***************************************************/-->


    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    
   <script>
    $('#myDatepicker2').datetimepicker({
        format: 'YYYY-DD-MM'
    });
  </script>
  @endsection

  