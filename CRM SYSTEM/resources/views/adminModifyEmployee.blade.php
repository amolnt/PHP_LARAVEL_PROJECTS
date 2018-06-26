<!---Author:Amol Tribhuwan********************************-->
  @extends('master.master')
  @section('import')
    <!-- Include SmartWizard CSS -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />
    
    <!-- Optional SmartWizard theme -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard_theme_dots.css')}}" rel="stylesheet" type="text/css" />
    @endsection
  @section('pageContent')
<div class="right_col" role="main">
                      <div class="row">
                       <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="x_panel">
                           <div class="x_title">
                             <h2>Edit Employee</h2>
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
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                  
                   <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('AdminEditOperationController@updateEmployee',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <!-- SmartWizard html -->
                    <div id="show">
                    <fieldset id="edit" class="collapse">
                      <legend>Steps Verification</legend>
                      <div id="smartwizard">
                      <ul>
                          <li><a href="#step-1">Step 1<br /><small>Edit Employee</small></a></li>
                          <li><a href="#step-2">Step 2<br /><small>Edit Authentication Field</small></a></li>
                          <li><a href="#step-3">Step 2<br /><small>Edit Work Charge</small></a></li>
                          <li><a href="#step-4">Step 2<br /><small>Edit Previledges</small></a></li>
                      </ul>
                    <div>

                    <div id="step-1">
                    <fieldset>
                      <legend>Edit Employee</legend>
                      <div id="form-step-0" role="form" data-toggle="validator">
                      <input type="hidden" name="emp" id="emp">
                      <div class="form-group ">
                        <label class="col-md-3 control-label">Full Name <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full Name" required>
                        <div class="help-block with-errors"></div>
                      </div>
                      </div>

                      
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date Of Birth <span class="required">*</span></label>
                              <div class='col-md-7 col-sm-6 col-xs-12'>
                                <div class="form-group">
                        <div class='input-group date' id='myDatepicker2'>
                            <input type='text' id="dob" name="dob" class="form-control" required />
                            <span class="input-group-addon">
                               <span class="fa fa-calendar"></span>
                            </span>
                            
                        </div>
                    </div>
                    <div class="help-block with-errors"></div>
                              </div>
                         </div>
                                          
                      <div class="form-group">
                      <label class="col-md-3 control-label">Email <span class="required">*</span></label>
                      <div class="col-md-7 col-sm-6 col-xs-12">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email ID" required>
                        <div class="help-block with-errors"></div>
                      </div>
                      </div>

                      <div class="form-group">
                      <label class="col-md-3 control-label">Mobile <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input  type="tel" name="mobile" pattern="[789][0-9]{9}" class="form-control" id="mobile" placeholder="Mobile No" required>
                        <div class="help-block with-errors"></div>
                      </div>
                      </div>
                        
                      <div class="form-group">
                        <label class="col-md-3 control-label">Qualification<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                        <input type="fname" name="qualification" class="form-control" id="qualification" placeholder="Qualification" required>
                        <div class="help-block with-errors"></div>
                          </div>
                      </div>    

                      </div>
                      </fieldset>
                      </div><!--End First step-->


                      <div id="step-2">
                        <fieldset>
                          <legend>Authentication Field</legend>
                          <div id="form-step-1" role="form" data-toggle="validator"> 
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3"  for="first-name">Username<span class="required">*</span>
                                </label>
                              <div class="col-md-7 col-sm-7 col-xs-9">
                                <input type="text" class="form-control" id="username" name="username" required>
                                <div class="help-block with-errors"></div>
                              </div>
                          </div>

                           <div class="form-group col-md-8" align="center">
                                <label class="checkbox" style="color: #000;"><input id="chk" type="checkbox" value="chk" name="check">Update New Password
                                </label>
                              <div class="col-md-7 col-sm-7 col-xs-9">
                                 
                                <div class="help-block with-errors"></div>
                              </div>
                          </div>
                      
                          
                          <div id="pass" class="form-group col-md-12" hidden>
                          <label class="control-label col-md-3 col-sm-3 col-xs-3" for="first-name">Password<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-9">
                          <input type="hidden" class="form-control" id="password" name="password" required>
                          <input type="text" class="form-control" id="newPassword" name="newPassword" hidden="true">
                          <div class="help-block with-errors"></div>
                         </div>
                        </div>                  
                        </div>
                        </fieldset>
                      </div><!--End Fourth step-->

                      <div id="step-3">
                        <fieldset>
                          <legend>Work Charge</legend>
                          <div id="form-step-2" role="form" data-toggle="validator">
                           <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3" for="first-name">Department<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-9">
                          <select id="department" name="department" class="form-control" required>
                          <option value="">--Select Department--</option>
                          
                          </select>
                          <div class="help-block with-errors"></div>
                         </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-xs-3 col-sm-3" for="first-name">Post<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-9">
                          <select id="post" name="post" class="form-control" required>
                          </select>
                          <div class="help-block with-errors"></div>
                         </div>
                      </div>  
                      </div>  
                        </fieldset>              

                      </div><!--End Third step-->
                      <div id="step-4">
                        <fieldset>
                          <legend>Previledges</legend>
                          <div id="form-step-3" role="form" data-toggle="validator">
                          <div class="form-group">
                          <label class="control-label col-md-3 col-xs-3 col-sm-3" for="first-name">Area Type<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-9">
                          <select id="areaType" name="areaType" class="form-control" required="">
                          <option value="">--Select Area Type--</option>
                          </select>
                          <div class="help-block with-errors"></div>
                         </div>
                      </div>

                      <div class="form-group" id="gbl" hidden>
                          <label class="control-label col-md-3 col-xs-3 col-sm-3" for="first-name">Global<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-9">
                          <select id="global" name="global" class="form-control">
                          <option>--Select Global--</option>
                          <option value="0">All</option>
                          </select>
                          <div class="help-block with-errors"></div>
                         </div>
                      </div> 
                      <div class="form-group" id="cntry" hidden>
                          <label class="control-label col-md-3 col-xs-3 col-sm-3" for="first-name">Country<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-9">
                          <select id="country" name="country" class="form-control">
                          <option>--Select Country--</option>
                            @if(isset($country))
                            @foreach($country as $key => $value)
                                <option value="{{$value['country_id']}}">{{$value['country_name']}}</option>
                            @endforeach
                          @endif
                          </select>
                          <div class="help-block with-errors"></div>
                         </div>
                      </div> 
                      <div class="form-group" id="sta" hidden>
                          <label class="control-label col-md-3 col-xs-3 col-sm-3" for="first-name">State<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-9">
                          <select id="state" name="state" class="form-control">
                          <option>--Select State--</option>
                          @if(isset($state))
                            @foreach($state as $key => $value)
                                <option value="{{$value['s_id']}}">{{$value['state_name']}}</option>
                            @endforeach
                          @endif
                          </select>
                          <div class="help-block with-errors"></div>
                         </div>
                      </div> 
                      <div class="form-group" id="dis" hidden>
                          <label class="control-label col-md-3 col-xs-3 col-sm-3" for="first-name">District<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-9">
                          <select id="district" name="district" class="form-control">
                          <option>--Select District--</option>
                            @if(isset($district))
                            @foreach($district as $key => $value)
                                <option value="{{$value['d_id']}}">{{$value['district_name']}}</option>
                            @endforeach
                          @endif
                          </select>
                          <div class="help-block with-errors"></div>
                         </div>
                      </div> 

                        <br>
                        <fieldset>
                        <legend id="acl"></legend>
                         <table id="dataTable" name="datatable" class="table table-striped table-bordered" style="margin-top: 0%;">                   
                          </table>
                        </fieldset>
                          </div>
                        </fieldset>
                      </div><!--End Fourth step-->
                      
                      </div>
                      </div>
                    </fieldset>
                    </div>
                   </form>
                   <br>
                   <fieldset>
                    <legend>All Employee </legend>
                      <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th hidden>Employee</th>
                          <th>Employee Name</th>
                          <th>Date Of Birth</th>
                          <th>Mobile Number</th>
                          <th>Email</th>
                          <th>Qualification</th>
                           <th>Department Name</th>
                          <th>Post Name</th>
                          <th></th>
                        </tr>
                      </thead> 
                       <tbody>

                      @if(isset($employee))
                        <?php
                            for ($i=1; $i < count($employee); $i++) { 
                              echo "<tr>";
                              echo "<td hidden>".$employee[$i]['emp_id']."</td>";
                              echo "<td>".$employee[$i]['full_name']."</td>";
                              echo "<td>".$employee[$i]['dob']."</td>";
                              echo "<td>".$employee[$i]['mobile']."</td>";
                              echo "<td>".$employee[$i]['email']."</td>";
                              echo "<td>".$employee[$i]['qualification']."</td>";
                               echo "<td>".$employee[$i]['dept_name']."</td>";
                              echo "<td>".$employee[$i]['post_name']."</td>";
                              echo "<td> <a  class=\"btn btn-primary btn-xs editEmployee\" data-toggle=\"collapse\" data-target=\"#edit\"><i class=\"fa fa-edit\" ></i> <span>Edit</span></a></td>";
                            }
                        ?>     
                      @endif
                        </tbody>
                    </table>
                    </fieldset>
                  </div> 
                  </div>
                </div>
          </div>
        </div>
    <script type="text/javascript">
        
        $(document).ready(function() {
           $("html, body").animate({ scrollTop: 0 }, "slow");
        });
    </script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    
   <script>
    $('#myDatepicker2').datetimepicker({
        format: 'YYYY-DD-MM'
    });
  </script>


  <!--*******************************************Wizard***************************************************/-->
  <!-- Include jQuery Validator plugin -->
    <script src="{{asset('assets/smart_wizard/validator.min.js')}}"></script>
    <!-- Include SmartWizard JavaScript source -->
    <script type="text/javascript" src="{{asset('assets/smart_wizard/dist/js/jquery.smartWizard.min.js')}}"></script>

    <script type="text/javascript">

        $(document).ready(function(){
         
            /***********************check area Type********************************************************/
          $('select[name="areaType"]').on('change', function() {
                if($('#areaType').val()==1){
                  $('#gbl').show();
                  $('#cntry').hide();
                  $('#sta').hide();
                  $('#dis').hide();  
                }else if($('#areaType').val()==2){
                  $('#gbl').hide();
                  $('#cntry').show();
                  $('#sta').hide();
                  $('#dis').hide();  
                } else if($('#areaType').val()==3){
                  $('#gbl').hide();
                  $('#cntry').hide();
                  $('#sta').show();
                  $('#dis').hide();
                } else if($('#areaType').val()==4){
                  $('#gbl').hide();
                  $('#cntry').hide();
                  $('#sta').hide();
                  $('#dis').show();
                }

          });
/**********************************Ajax for get  field values *********************************************************/
            $.ajax({
                    url: '/getDepartment/ajax/',
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#department').empty();
                        $('#department').append('<option value=\"\">--Select Department--</option>');
                        for(var i=1;i<data.length;i++){
                            $('#department').append('<option value="'+ data[i]['dept_id'] +'">'+ data[i]['dept_name'] +'</option>');
                        }
                    }
                  });
                    
                  $.ajax({
                    url: '/getPost/ajax/',
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                          $('#post').empty();
                          $('#post').append('<option value=\"\">--Select Post--</option>');
                          for(var i=1;i<data.length;i++){
                            $('#post').append('<option value="'+ data[i]['post_id'] +'">'+ data[i]['post_name'] +'</option>');
                          };

                      }
                  });

                  $.ajax({
                    url: '/getAreaType/ajax/',
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                          $('#areaType').empty();
                          $('#areaType').append('<option value=\"\">--Select Area Type--</option>');
                         for(var i=0;i<data.length;i++){
                            $('#areaType').append('<option value="'+ data[i]['area_type_id'] +'">'+ data[i]['area_name'] +'</option>');
                          };

                      }
                  });

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                                             .addClass('btn btn-info')
                                             .on('click', function(){ 
                                                    if( !$(this).hasClass('disabled')){ 
                                                        var elmForm = $("#myForm");
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
            var btnCancel = $('<button data-toggle=\"collapse\" data-target=\"#edit\"></button>').text('Cancel')
                                             .addClass('btn btn-danger')
                                             .on('click', function(){ 
                                                    $('#smartwizard').smartWizard("reset");
                                                });                         
            
            
            
            // Smart Wizard
            $('#smartwizard').smartWizard({ 
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
            
            $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                var elmForm = $("#form-step-" + stepNumber);
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
            
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
                // Enable finish button only on last step
                if(stepNumber == 3){ 
                    $('.btn-finish').attr('disabled',false);  
                }else{
                    $('.btn-finish').attr('disabled',true);
                }
                /*****************check steps number and get stepwise ajax requests***************************/
                if(stepNumber==1){
                  $.ajax({
                      url: '/getEmployeeUsername/ajax/',
                      data:{emp:$('#emp').val()},
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                        $('#username').val(data);
                      }
                  });

                  $('#acl').text("Acl For "+$("#department option[value='"+$('#department').val() +"']").text() );

                  $('#dataTable').empty();
                  $.ajax({
                      url: '/getEditMenuSubMenu/ajax/',
                      data:{dept:$('#department').val(),emp:$('#emp').val()},
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                        $('#dataTable').append(data);
                      }
                  });
                }

                if(stepNumber==2){
                  
                  $.ajax({
                      url: '/getEmployeePost/ajax/',
                      data:{emp:$('#emp').val()},
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                        $('#post').val(data);
                      }
                  });
                }

                if(stepNumber==3){

                  $.ajax({
                      url: '/getEmployeeArea/ajax/',
                      data:{emp:$('#emp').val()},
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                        if($('#areaType').val()==1){
                          
                          $('#gbl').show();
                          $('#cntry').hide();
                          $('#sta').hide();
                          $('#dis').hide();
                          $('#global').val(data);
                        }
                        else if($('#areaType').val()==2){
                          
                          $('#gbl').hide();
                          $('#cntry').show();
                          $('#sta').hide();
                          $('#dis').hide(); 
                          $('#country').val(data);
                          
                        }
                        else if($('#areaType').val()==3){
                          
                          $('#gbl').hide();
                          $('#cntry').hide();
                          $('#sta').show();
                          $('#dis').hide(); 
                          $('#state').val(data);
                        }
                        else if($('#areaType').val()==4){ 
                          $('#gbl').hide();
                          $('#cntry').hide();
                          $('#sta').hide();
                          $('#dis').show(); 
                          $('#district').val(data);
                        }
                      }
                  });
                }
            });                               
        });   
    </script> 
 <!--*****************************************#step-1Wizard End***************************************************/-->
    <script type="text/javascript">
      $(document).ready(function(){
        /********************this function call to click edit button and set current selected row values********************************/
          $('.editEmployee').click(function(){
            $('#smartwizard').smartWizard("reset");
              $('#emp').val($(this).parent().siblings('td').eq(0).text());
              $('#full_name').val($(this).parent().siblings('td').eq(1).text());
              $('#dob').val($(this).parent().siblings('td').eq(2).text());
              $('#mobile').val($(this).parent().siblings('td').eq(3).text());
              $('#email').val($(this).parent().siblings('td').eq(4).text());
              $('#qualification').val($(this).parent().siblings('td').eq(5).text());
              
              $.ajax({
                      url: '/getEmployeeDepartment/ajax/',
                      data:{emp:$('#emp').val()},
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                        $('#department').val(data);
                      }
                  });


                $.ajax({
                      url: '/getEmployeeAreaType/ajax/',
                      data:{emp:$('#emp').val()},
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                        $('#areaType').val(data);
                      }
                  });

              $('html, body').animate({
                scrollTop: $("#show").offset().top
              }, 2000);
          });

           $('#chk').change(function(){
              if(this.checked){
                $('#newPassword').val("");
                $('#pass').show();
              }
              else{
                $('#newPassword').val("");
                $('#pass').hide();
              }
          });

           /***********************************if i click department then get a acl data means menus and submenus***************************/
          $('select[name="department"]').on('change', function() {
            $('#acl').text("Acl For "+$("#department option[value='"+$('#department').val() +"']").text() );
             $('#dataTable').empty();
                  $.ajax({
                      url: '/getMenuSubMenu/ajax/',
                      data:{dept_id:$('#department').val()},
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                      $('#dataTable').append(data);
                }
            });
        });
      });
    </script>   
 @endsection