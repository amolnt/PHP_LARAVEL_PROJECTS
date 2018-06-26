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
                        @if(Session::has('succMsg'))
                  <div class="alert alert-success alert-dismissible fade in col-md-9" role="alert" id="succMsg">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>
                        
                        
                      {{Session::get('succMsg') }}
                                                       
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
                                <option value="1">Amol Tribhuwan</option>
                                  
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
                            <input type="submit" class="btn btn-success" value="approveQuotation">
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
                          <th hidden="">Address</th>
                          <th hidden="">Approve</th>
                          <th>Quotation Number</th>
                          <th>organization Name</th>
                          <th>Contact Person Name</th>
                          <th>Mobile No</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Owner</th>
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
                                  echo '<td> <a class="btn btn-danger btn-xs approve" data-toggle="collapse" data-target="#approve">
                                                  <span class="fa fa-remove" >DisApprove</span>
                                                </a></td';
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
  @endsection

  