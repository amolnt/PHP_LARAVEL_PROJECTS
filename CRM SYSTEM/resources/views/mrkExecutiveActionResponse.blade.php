<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
@section('import')
    <!-- Include SmartWizard CSS -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />
    
    <!-- Optional SmartWizard theme -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard_theme_dots.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('assets/css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/dropdown.css')}}">
    <style type="text/css">
        #table_new_followup .dropdown-menu {
    position: sticky;
    float: right;
   
}
 
 #table_today_followup .dropdown-menu {
    position: sticky;
    float: right;
   
}
#table_new_followup .dropdown-menu {
    position: sticky;
    float: right;
   
}
#table_followup .dropdown-menu {
    position: sticky;
    float: right;
   
}
#table_close_leads .dropdown-menu {
    position: sticky;
    float: right;
   
}
#table_archive_leads .dropdown-menu {
    position: sticky;
    float: left;
   
}
.nav-item{
  background-color: #b1d0e7;
}
  </style>
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
                <legend>Download Quotation</legend>
                    <a href="/downloadQuotation"> Click to Download Quotaion </a> 
                </fieldset><br>
                <fieldset>
                <legend>Send Email</legend>
                  <form class="form-horizontal form-label-left input_mask" method="post" action="{{action('Sales@sendQuotation')}}" enctype="multipart/form-data" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <?php
                        echo Session::get('succ')['html'];
                      ?>
                      <div class="form-group ">
                        <label class="col-md-3 control-label">TO</label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="toEmail" class="form-control lead_id" value="{{Session::get('succ')['email']}}" required>
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Subject<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="subject" id="subject" class="form-control" value="Quotation-{{Session::get('succ')['qtn']}}" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                        <label class="col-md-3 control-label">Choose File<span class="required">*</span></label>
                       <div class="btn-group col-md-7">
                        <input type="file" name="file" accept=".pdf" required/>
                      </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Message<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                              <textarea class="editor-wrapper form-control" name="message" id="editor-one" required></textarea>
                         </div>
                        </div>
                      
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a id="cancel" class="btn btn-primary change">Cancel</a>
                          <button type="submit" class="btn btn-success">Send</button>
                        </div>
                      </div>
                </form>
              </fieldset> 
                  @endif
                 <!--**********************************Add In Archive***************************************-->
                  <form method="post" action="{{action('MrkExecutiveOperation@addToArchive',csrf_token())}}" enctype="multipart/form-data" role="form"  id="addToArchiveForm" accept-charset="utf-8">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" id="archiveLead" name="archiveLead">
                  </form>
                 <!--***********************************End Archive*****************************************-->

                   <form class="form-horizontal form-label-left input_mask" method="post" action="{{action('MrkExecutiveOperation@sendToApprove',csrf_token())}}" enctype="multipart/form-data" role="form" data-toggle="validator" id="sendToApproveForm" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="sendToApprove" id="sendToApprove">
                    </form>
                <!--***********************************Create Quotation*********************************************-->
                  <div id="showSendQuotation">
                  <div id="sendQuotation" class="collapse edit">
                  
                   <form id="quotationForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('SalesOperation@addQuotation',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
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
                            <select  name="order_type" class="form-control owner "  required>
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
                            <input type='text' name="valid_date" class="form-control"/ required>
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


                 <div id="showfollow-upAction">
                <fieldset id="follow-upAction" class="collapse">
                <fieldset>
                  <legend>Trail</legend>
                   
                    <fieldset id="action">
                      <legend>Action</legend>
                      <table id="datatable-keytable" class="table table-striped table-bordered action">
                      
                        </table>
                    </fieldset>  
                  
                  </fieldset>
                  <br>
                  <legend>Follow Up</legend>   
                 <form method="post" action="{{action('MrkExecutiveOperation@addAction',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left" role="form" data-toggle="validator" accept-charset="utf-8">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                     
                       <fieldset>
                       <legend>Action</legend>
                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Organization Name<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="action_organization_name" name="organization_name" class="form-control" readonly >
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Contact Person Name<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="action_contact_person_name" name="contact_person_name" class="form-control" readonly required>
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>

                     <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="action_email" name="email" class="form-control" readonly required>
                             <input type="hidden" name="lead" id="action_lead">
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>
                      <div class="form-group">
                    <label class="control-label col-md-3" for="first-name">Action Type </label> 
                    <div class="col-md-7">
                        <label class="checkbox-inline"><input type="checkbox" value="Email" class="checkbox-primary" name="actionType[]">Email</label>
                        <label class="checkbox-inline" ><input type="checkbox" value="Call" name="actionType[]">Call</label>
                        <label class="checkbox-inline"><input type="checkbox" class="checkbox-primary" value="Meeting" name="actionType[]">Meeting</label>
                        <label class="checkbox-inline"><input type="checkbox" value="Text" name="actionType[]" class="checkbox-primary">Text</label>
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Action Discription <span class="required">*</span></label>
                        <div class="col-md-7">
                          <textarea rows="3" id="actionDiscription" name="actionDescription" class="form-control col-md-7 col-xs-12" required></textarea>
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Date and Time </label>
                          <div class="form-group col-md-7">
                            <div class="component-box"> 
          
                                <!--Datepicker with left header example -->
                                <div class="pmd-card pmd-z-depth pmd-card-custom-view">
                                  <div class="pmd-card-body"> 
                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                      <input type="text" name="action_date" data-header-left="true" class="form-control datepicker-left-header" required/>
                                      
                                    </div>              
                                  </div>
                                </div> <!--Datepicker with left header example end-->
                              </div>
                            <div class="help-block with-errors"></div>
                       </div>
                     </div>
                    <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" data-toggle="collapse" data-target="#follow-upAction" type="reset">Cancel</button>
                            <input type="submit" class="btn btn-success" value="AddAction">
                          </div>
                        </div>
                     </fieldset>
                    
                  </form>
                </fieldset>
              </div>

         
         <div id="showfollow-upResponse">
            <fieldset id="follow-upResponse" class="collapse">
            <fieldset>
              <legend>Trail</legend>
              <table id="datatable-responsive" class="table table-striped table-bordered action">
                      
              </table>
            </fieldset>
            <br>
            <legend>Follow Up</legend>   
            <form method="post" action="{{action('MrkExecutiveOperation@addResponse',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left" role="form" data-toggle="validator" accept-charset="utf-8">
                 <input type="hidden" name="_token" value="{{csrf_token()}}">         
              <fieldset>
                <legend>Response</legend>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Organization Name<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="response_organization_name" name="organization_name" class="form-control" readonly >
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Contact Person Name<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="response_contact_person_name" name="contact_person_name" class="form-control" readonly required>
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>

                     <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="response_email" name="email" class="form-control" readonly required>
                             <input type="hidden" name="lead" id="response_lead">
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>


                      <div class="form-group">
                    <label class="control-label col-md-3" for="first-name">Response Type </label> 
                    <div class="col-md-7">
                        <label class="checkbox-inline"><input type="checkbox" value="Email" name="responseType[]" class="checkbox-primary">Email</label>
                        <label class="checkbox-inline"><input type="checkbox" value="Call" name="responseType[]">Call</label>
                        <label class="checkbox-inline"><input type="checkbox" class="checkbox-primary" value="Meeting" name="responseType[]">Meeting</label>
                        <label class="checkbox-inline"><input type="checkbox" value="Text" class="checkbox-primary" name="responseType[]">Text</label> 
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Response Discription <span class="required">*</span></label>
                        <div class="col-md-7">
                          <textarea rows="3" id="equip-desc" name="responseDescription" class="form-control col-md-7 col-xs-12" required=""></textarea>
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>                        


                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Date and Time </label>
                           <div class="form-group col-md-7">
                              <!--Datepicker with left header example -->
                              <div class="pmd-card pmd-z-depth pmd-card-custom-view">
                                <div class="pmd-card-body"> 
                                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <input type="text" name="response_date"  data-header-left="true" class="form-control datepicker-left-header" required />
                                  </div>              
                                </div>
                              </div> <!--Datepicker with left header example end-->
                          <div class="help-block with-errors"></div>

                        </div>
                            </div>

                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Lead Status<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                          <select id="heard" name="status" class="form-control" required>
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

                      <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" data-toggle="collapse" data-target="#follow-upResponse" type="reset">Cancel</button>
                            <input type="submit" class="btn btn-success" value="addResponse">
                          </div>
                        </div>
                    </fieldset>
                    </form>
                    </fieldset>
                    </div>

                    <br>
                    <br>

                    
                       <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
                        <li class="nav-item active">
                          <a class="nav-link active" id="new_folowup_tab" data-toggle="pill" href="#new_followup" role="tab" aria-controls="home">New Followup</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="todays_followup_tab" data-toggle="pill" href="#today_followup" role="tab" aria-controls="profile">Todays Followup</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="followup_tab" data-toggle="pill" href="#followup" role="tab" aria-controls="contact">Followup</a>
                        </li>
                         <li class="nav-item">
                          <a class="nav-link" id="close_leads_tab" data-toggle="pill" href="#close_leads" role="tab" aria-controls="contact">Closed Leads</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="archive_leads_tab" data-toggle="pill" href="#archive_leads" role="tab" aria-controls="contact">Archive Leads</a>
                        </li>
                      </ul>
                      <div id="myTabContent"  class="tab-content">
                        <div  class="tab-pane fade in active " id="new_followup" >
                        <br>
                   
                            <fieldset>
                                <legend>New Follow Up</legend>
                                  <table id="table_new_followup" width="100%" class="table table-striped table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <th hidden>Lead id</th>
                                      <th hidden>Lead Source</th>
                                      <th hidden>Address</th>
                                      <th>organization Name</th>
                                      <th>Contact Person Name</th>
                                      <th>Mobile No</th>
                                      <th>Email</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                      <th>Response</th>
                                      <th>Action</th>
                                       
                                    </tr>
                                  </thead>

                                  <tbody>
                                  
                                   </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <div  class="tab-pane fade" id="today_followup" >
                        <br>
                                                    <fieldset>
                                <legend>Today Follow Up</legend>

                                  <table id="table_today_followup" width="100%" class="table table-striped table-bordered table-hover dataTable no-footer">
                                  <thead>
                                    <tr>
                                      <th hidden>Lead id</th>
                                      <th hidden>Lead Source</th>
                                      <th hidden>Address</th>
                                      <th>organization Name</th>
                                      <th>Contact Person Name</th>
                                      <th>Mobile No</th>
                                      <th>Email</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                      <th>Response</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                 <tbody>
                                   
                                 </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <div  class="tab-pane fade" id="followup" >
                         <br>
                            <fieldset>
                                <legend>Follow Up</legend>
                                  <table id="table_followup" width="100%" class="table table-striped table-bordered table-hover dataTable no-footer">
                                  <thead>
                                    <tr>
                                      <th hidden>Lead id</th>
                                      <th hidden>Lead Source</th>
                                      <th hidden>Address</th>
                                      <th>organization Name</th>
                                      <th>Contact Person Name</th>
                                      <th>Mobile No</th>
                                      <th>Email</th>
                                      <th>Status</th>
                                      <th>Last Action</th>
                                      <th>Last Response</th>
                                      <th>Action</th>
                                       
                                    </tr>
                                  </thead>
                                  <tbody>
                                   </tbody>
                                </table>
                            </fieldset>
                        </div>
                         <div class="tab-pane fade" id="close_leads" >
                          <br>
                              <fieldset>
                                <legend>Close Leads</legend>
                                  <table id="table_close_leads" width="100%" class="table table-striped table-bordered table-hover dt-responsive nowrap dataTable no-footer dtr-inline">
                                  <thead>
                                    <tr>
                                      <th hidden>Lead id</th>
                                      <th hidden>Lead Source</th>
                                      <th hidden>Address</th>
                                      <th>organization Name</th>
                                      <th>Contact Person Name</th>
                                      <th>Mobile No</th>
                                      <th>Email</th>
                                      <th>Status</th>
                                      <th>Last Action</th>
                                      <th>Last Response</th>
                                      <th>Action</th>
                                       
                                    </tr>
                                  </thead>

                                  <tbody>
                                  
                                   </tbody>
                                </table>
                            </fieldset>
                        </div>

                         <div class="tab-pane fade" id="archive_leads" >
                          <br>
                              <fieldset>
                                <legend>Archive Leads</legend>
                                  <table id="table_archive_leads" width="100%" class="table table-striped table-bordered table-hover dt-responsive nowrap dataTable no-footer dtr-inline">
                                  <thead>
                                    <tr>
                                      <th hidden>Lead id</th>
                                      <th hidden>Lead Source</th>
                                      <th hidden>Address</th>
                                      <th>organization Name</th>
                                      <th>Contact Person Name</th>
                                      <th>Mobile No</th>
                                      <th>Email</th>
                                      <th>Status</th>
                                      <th>Last Action</th>
                                      <th>Last Response</th>
                                      <th>Action</th>
                                       
                                    </tr>
                                  </thead>

                                  <tbody>
                                  
                                   </tbody>
                                </table>
                            </fieldset>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

<script src="{{asset('assets/js/bootstrap-dropdownhover.min.js')}}"></script>

<!-- ****************************Action Response********************************************-->
<script type="text/javascript">

  $(document).ready(function(){
       $('table').on('click', '.archive', function(){
        
        $('#archiveLead').val($(this).parents().siblings('td').eq(0).text());
        $('#addToArchiveForm').submit();
      });
      $('#table_new_followup').DataTable({
        order:[],
         pageResize: true
      });
      $('#table_today_followup').DataTable({
        order:[]
      });
      $('#table_followup').DataTable({
          order:[]
      });
      $('#table_close_leads').DataTable({
        order:[]
      });
      $('#table_archive_leads').DataTable({
        order:[]
      });
/****************************************New Follow Up******************************************/
    var new_followup_table = $('#table_new_followup').DataTable();  
    var new_followup_info=new_followup_table.page.info();
    $.ajax({
             url: '/newFollowUp/ajax/',
             type: "GET",
               data: {start:new_followup_info.start,end:new_followup_info.length},
              dataType: "json",
              success:function(data) { 
                new_followup_table.page(new_followup_info.page).clear().draw();
                new_followup_table.rows.add($(data)).draw();
              }
    });   
    $('select[name="table_new_followup_length"]').on('change', function() {
      
      var new_followup_table = $('#table_new_followup').DataTable();  
      var new_followup_info=new_followup_table.page.info();
  
        $.ajax({
             url: '/newFollowUp/ajax/',
             type: "GET",
              data: {start:0,end:new_followup_info.length},
              dataType: "json",
              success:function(data) { 
                new_followup_table.page(new_followup_info.page).clear().draw();
                new_followup_table.rows.add($(data)).draw();
              }
          });          
         
    });
  /* $("#table_new_followup_filter").on("keyup", 'input',function () {

     });*/
    $("#table_new_followup_paginate").on('click', 'a', function() {
      var new_followup_table = $('#table_new_followup').DataTable();  
      var new_followup_info=new_followup_table.page.info();
        $.ajax({
             url: '/newFollowUp/ajax/',
             type: "GET",
               data: {start:new_followup_info.end,end:new_followup_info.length},
              dataType: "json",
              success:function(data) { 
                new_followup_table.rows.add($(data)).draw();
              }
        }); 
    });
/***********************************End New Follow Up*************************************************/
/************************************Today Follow Up**************************************************/   $('#todays_followup_tab').click(function(){
          var today_followup_table = $('#table_today_followup').DataTable();  
          var today_followup_info=today_followup_table.page.info();
          $.ajax({
                   url: '/todayFollowUp/ajax/',
                   type: "GET",
                     data: {start:today_followup_info.start,end:today_followup_info.length},
                    dataType: "json",
                    success:function(data) { 
                      today_followup_table.page(today_followup_info.page).clear().draw();
                      today_followup_table.rows.add($(data)).draw();
                    }
            });
    });
    $('select[name="table_today_followup_length"]').on('change', function() {
      var today_followup_table = $('#table_today_followup').DataTable();  
      var today_followup_info=today_followup_table.page.info();
      $.ajax({
             url: '/todayFollowUp/ajax/',
             type: "GET",
               data: {start:0,end:today_followup_info.length},
              dataType: "json",
              success:function(data) { 
                today_followup_table.page(today_followup_info.page).clear().draw();
                today_followup_table.rows.add($(data)).draw();
              }
        });         
    });
   /* $("input[type='search']").on("keyup", function () {
                alert();
     });*/
    $("#table_today_followup_paginate").on('click', 'a', function() {
      var today_followup_table = $('#table_today_followup').DataTable();  
      var today_followup_info=today_followup_table.page.info();
      $.ajax({
             url: '/todayFollowUp/ajax/',
             type: "GET",
               data: {start:today_followup_info.end,end:today_followup_info.length},
              dataType: "json",
              success:function(data) { 
                today_followup_table.rows.add($(data)).draw();
              }
        });   
    });

/**********************************End Today Follow Up************************************************/
/***************************************Follow Up******************************************************/
$('#followup_tab').click(function(){
          var followup_table = $('#table_followup').DataTable();  
          var followup_info=followup_table.page.info();
          $.ajax({
                   url: '/followUp/ajax/',
                   type: "GET",
                     data: {start:followup_info.start,end:followup_info.length},
                    dataType: "json",
                    success:function(data) { 
                      followup_table.page(followup_info.page).clear().draw();
                      followup_table.rows.add($(data)).draw();
                    }
            });
    });
    $('select[name="table_followup_length"]').on('change', function() {
      var followup_table = $('#table_followup').DataTable();  
      var followup_info=followup_table.page.info();
      $.ajax({
             url: '/followUp/ajax/',
             type: "GET",
               data: {start:0,end:followup_info.length},
              dataType: "json",
              success:function(data) { 
                followup_table.page(followup_info.page).clear().draw();
                followup_table.rows.add($(data)).draw();
              }
        });                
    });
   /* $("input[type='search']").on("keyup", function () {
                alert();
     });*/
    $("#table_followup_paginate").on('click', 'a', function() {
      var followup_table = $('#table_followup').DataTable();  
      var followup_info=followup_table.page.info();
      $.ajax({
             url: '/followUp/ajax/',
             type: "GET",
               data: {start:followup_info.end,end:followup_info.length},
              dataType: "json",
              success:function(data) { 
                followup_table.rows.add($(data)).draw();
              }
        });   
    }); 
/**********************************End Follow Up*******************************************************/
/**********************************Close Leads**********************************************************/
  $('#close_leads_tab').click(function(){
          var close_leads_table = $('#table_close_leads').DataTable();  
          var close_leads_info=close_leads_table.page.info();
          $.ajax({
                   url: '/closeLeads/ajax/',
                   type: "GET",
                     data: {start:close_leads_info.start,end:close_leads_info.length},
                    dataType: "json",
                    success:function(data) { 
                      close_leads_table.page(close_leads_info.page).clear().draw();
                      close_leads_table.rows.add($(data)).draw();
                    }
            });
    });
    $('select[name="table_close_leads_length"]').on('change', function() {
      var close_leads_table = $('#table_close_leads').DataTable();  
      var close_leads_info=close_leads_table.page.info();
      $.ajax({
             url: '/closeLeads/ajax/',
             type: "GET",
               data: {start:0,end:close_leads_info.length},
              dataType: "json",
              success:function(data) { 
                close_leads_table.page(close_leads_info.page).clear().draw();
                close_leads_table.rows.add($(data)).draw();
              }
        });                
    });
  /*  $("input[type='search']").on("keyup", function () {
                alert();
     });*/
    $("#table_close_leads_paginate").on('click', 'a', function() {
      var close_leads_table = $('#table_close_leads').DataTable();  
      var close_leads_info=close_leads_table.page.info();
      $.ajax({
             url: '/closeLeads/ajax/',
             type: "GET",
               data: {start:close_leads_info.end,end:close_leads_info.length},
              dataType: "json",
              success:function(data) { 
                close_leads_table.rows.add($(data)).draw();
              }
        });   
    }); 
/**********************************End Close Leads*****************************************************/

/**********************************Archive Leads*******************************************************/
   $('#archive_leads_tab').click(function(){

          var archive_leads_table = $('#table_archive_leads').DataTable();  
          var archive_leads_info=archive_leads_table.page.info();
          $.ajax({
                   url: '/archiveLeads/ajax/',
                   type: "GET",
                     data: {start:archive_leads_info.start,end:archive_leads_info.length},
                    dataType: "json",
                    success:function(data) { 
                      archive_leads_table.page(archive_leads_info.page).clear().draw();
                      archive_leads_table.rows.add($(data)).draw();
                    }
            });
    });
    $('select[name="table_archive_leads_length"]').on('change', function() {
      var archive_leads_table = $('#table_archive_leads').DataTable();  
      var archive_leads_info=archive_leads_table.page.info();
      $.ajax({
             url: '/archiveLeads/ajax/',
             type: "GET",
               data: {start:0,end:archive_leads_info.length},
              dataType: "json",
              success:function(data) { 
                archive_leads_table.page(archive_leads_info.page).clear().draw();
                archive_leads_table.rows.add($(data)).draw();
              }
        });                
    });
  /*  $("input[type='search']").on("keyup", function () {
                alert();
     });*/
    $("#table_archive_leads_paginate").on('click', 'a', function() {
      var archive_leads_table = $('#table_archive_leads').DataTable();  
      var archive_leads_info=archive_leads_table.page.info();
      $.ajax({
             url: '/archiveLeads/ajax/',
             type: "GET",
               data: {start:archive_leads_info.end,end:archive_leads_info.length},
              dataType: "json",
              success:function(data) { 
                archive_leads_table.rows.add($(data)).draw();
              }
        });   
    }); 
/*************************************End Archive Leads************************************************/
        $('table').on('click', '.follow-upAction', function(){
           $.ajax({
                    url: '/getAction/ajax/'+$(this).parents().siblings('td').eq(0).text(),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                     
                       $('#datatable-keytable').empty();
                       $('#datatable-keytable').append(data);
                    }
                });
              $('#action_organization_name').val($(this).parents().siblings('td').eq(3).text());
              $('#action_contact_person_name').val($(this).parents().siblings('td').eq(4).text());
              $('#action_email').val($(this).parents().siblings('td').eq(6).text());
               $('#action_lead').val($(this).parents().siblings('td').eq(0).text());
              
              $('html, body').animate({
                scrollTop: $("#showfollow-upAction").offset().top
              }, 2000);
        });
          
          $('table').on('click', '.follow-upResponse', function(){
              $.ajax({
                    url: '/getAction/ajax/'+$(this).parents().siblings('td').eq(0).text(),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                       $('#datatable-responsive').empty();
                       $('#datatable-responsive').append(data);
                    }
                });
              $('#response_organization_name').val($(this).parents().siblings('td').eq(3).text());
              $('#response_contact_person_name').val($(this).parents().siblings('td').eq(4).text());
              $('#response_email').val($(this).parents().siblings('td').eq(6).text());
              $('#response_lead').val($(this).parents().siblings('td').eq(0).text());
              $('html, body').animate({
                scrollTop: $("#showfollow-upResponse").offset().top
              }, 2000);
          }); 
           
          $('table').on('click', '.sendQuotation', function(){
            $('#quotationLead').val($(this).parents().siblings('td').eq(0).text()); 
              $('#organization_name').val($(this).parents().siblings('td').eq(3).text());
              $('#address').val($(this).parents().siblings('td').eq(2).text());
              $('#contact_person_name').val($(this).parents().siblings('td').eq(4).text());
              $('#email').val($(this).parents().siblings('td').eq(6).text());
              $('#mobile_no').val($(this).parents().siblings('td').eq(5).text());

              $('html, body').animate({
                scrollTop: $("#showSendQuotation").offset().top
              }, 2000);
          });     
        });
  $(document).ready(function() {
      $('html, body').animate({
              scrollTop: $("#top").offset().top
          }, 2000);
      $('#lead').hide();
      $('#ar').hide();
        $('select[name="actionLead"]').on('change', function() {
          $('#actionLeadDiscription').val("");
          $('#responseLeadDiscription').val("");
            var leadId = $(this).val();
            if(leadId) {
                $.ajax({
                    url: '/leadDiscription/ajax/'+leadId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      $('#actionLeadDiscription').val(data[0]['description']);
                      $('#responseLeadDiscription').val(data[0]['description']);
                      $('select[name="responseLead"]').empty();
                      $('select[name="responseLead"]').append('<option value="'+ $('#actionLead').val() +'">'+ $('#actionLead option:selected').text() +'</option>'); 
                    }
                });
            }else{
              $('#actionLeadDiscription').val("");
              $('#responseLeadDiscription').val("");
              $('select[name="responseLead"]').empty();
            }
        }); 
   });
</script>
<!-- *************************End Action Response**************************************************-->
    <!--           *********************Quotation*****************************************************************-->
     <!-- bootstrap-daterangepicker -->
     <script src="{{asset('assets/js/chosen.jquery.min.js')}}"></script>
     <script type="text/javascript">

          $('#cancel').click(function(){
              location.reload();
          });
            $("#anc_add").click(function(){
              $('#tblItem tr').last().after('<tr class="targetfields"><td><input class="chk" type="checkbox" name="chk"></td><td hidden><input type="text" name="code[]" id="code'+$('#tblItem tr').size()+'"></td> <td hidden><input type="text" name="tax[]" id="tax'+$('#tblItem tr').size()+'"></td><td hidden><input type="text" name="tax_amount[]" id="tax_amount'+$('#tblItem tr').size()+'"></td><td class="col-md-2"><select id="site'+$('#tblItem tr').size()+'" name="'+$('#tblItem tr').size()+'" onchange="mySite(this)" class="site form-control"></select></td><td class="col-md-2"><select  id="warehouse'+$('#tblItem tr').size()+'" class="warehouse form-control" ><option>--Select Warehouse--</option></select></td><td class="col-md-2"><select onchange="changeItem(this)" name="item_name[]" id="item_name'+$('#tblItem tr').size()+'" class="item_name form-control selectpicker" data-live-search="true" readonly></select></td><td><textarea name="description[]" rows="2" cols="60" class="form-control description" id="description'+$('#tblItem tr').size()+'" readonly></textarea></td><td><input type="text" class="form-control quantity" onkeyup="myQuantity(this)"  name="quantity[]" id="quantity'+$('#tblItem tr').size()+'" readonly></td><td><input type="text" class="form-control rate" name="rate[]" id="rate'+$('#tblItem tr').size()+'" readonly></td><td><input type="text" id="amount'+$('#tblItem tr').size()+'" class="form-control amount" name="amount[]" readOnly></td></tr>');
           
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
                    url: '/getWarehouse/ajax/'+siteID,
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
            var btnCancel = $('<button data-toggle=\"collapse\" data-target=\"#sendQuotation\"></button>').text('Cancel')
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