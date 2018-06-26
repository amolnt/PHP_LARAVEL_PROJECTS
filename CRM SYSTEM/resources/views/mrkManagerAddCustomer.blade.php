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
                    <h2>Add Customer</h2>
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
                  <div id="showAddCustomer">
                  <fieldset id="addCustomer" class="collapse">
                    <legend>Create Customer</legend>
                  <form class="form-horizontal form-label-left input_mask" method="post" action="{{action('MrkManagerOperation@addCustomer',csrf_token())}}" enctype="multipart/form-data" role="form" data-toggle="validator" id="approveForm" accept-charset="utf-8">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <input type="hidden" name="lead" id="lead">


                        <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Lead Owner<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="owner" name="owner" class="form-control" readonly >
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>

                     

                     
                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Organization Name<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="organization_name" name="organization_name" class="form-control" readonly >
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Contact Person Name<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="contact_person_name" name="contact_person_name" class="form-control" readonly required>
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>

                     <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                             <input type="text" id="email" name="email" class="form-control" readonly required>
                           
                             <div class="help-block with-errors"></div>
                         </div>
                      </div>

                       <div class="form-group" >
                        <label class="control-label col-md-3" for="first-name">Account Name<span class="required">*</span></label>
                        <div class="col-md-7">
                             <input type="text" id="account_name" name="account_name" class="form-control" required>
                         </div>
                      </div>

                      <div class="form-group" >
                        <label class="control-label col-md-3" for="first-name">CIN Number<span class="required">*</span></label>
                        <div class="col-md-7">
                             <input type="text" id="CIN" name="CIN" class="form-control" required>
                         </div>
                      </div>

                      <div class="form-group" >
                        <label class="control-label col-md-3" for="first-name">GST Number<span class="required">*</span></label>
                        <div class="col-md-7">
                             <input type="text" id="GST" name="GST" class="form-control" required>
                         </div>
                      </div>
                    
                      <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" data-toggle="collapse" data-target="#addCustomer" type="reset">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Add">
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
              
                       
                          <th>organization Name</th>
                          <th>Contact Person Name</th>
                          <th>Mobile No</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Owner</th>
                          <th>Action</th>
                          
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
                               
                                 
                                  echo "<td>".$data[$i]['organization_name']."</td>";
                                  echo "<td>".$data[$i]['contact_person_name']."</td>";
                                  echo "<td>".$data[$i]['mobile_no']."</td>";
                                  echo "<td>".$data[$i]['email']."</td>";
                                  echo "<td>".$data[$i]['status']."</td>";
                                  echo "<td>".$data[$i]['full_name']."</td>";
                                 echo '<td><a class="btn btn-primary btn-xs addCustomer" data-toggle="collapse" data-target="#addCustomer"><span class="fa fa-plus">Add</span></td>';
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




<!-- ****************************Add Customer********************************************-->
<script type="text/javascript">

  $(document).ready(function(){
            $('.addCustomer').click(function(event){
                $('#lead').val($(this).parents().siblings('td').eq(0).text());
                $('#owner').val($(this).parents().siblings('td').eq(8).text());
                $('#organization_name').val($(this).parents().siblings('td').eq(3).text());
                $('#contact_person_name').val($(this).parents().siblings('td').eq(4).text());
                $('#email').val($(this).parents().siblings('td').eq(6).text());
                $('#account_name').val($(this).parents().siblings('td').eq(3).text());
                $('html, body').animate({
                  scrollTop: $("#showAddCustomer").offset().top
                }, 2000);
                //$('#approve').val($(this).parents().siblings('td').eq(3).text());
                //$('#approveForm').submit();
            });

});
</script>
  @endsection

  