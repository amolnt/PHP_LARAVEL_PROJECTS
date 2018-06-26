  @extends('master.master')
  @section('import')
    <!-- Include SmartWizard CSS -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />
    
    <!-- Optional SmartWizard theme -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard_theme_dots.css')}}" rel="stylesheet" type="text/css" />
    @endsection
  @section('pageContent')
    <style type="text/css">.error {
    width:500px;
    height:20px;
    height:auto;
    position:absolute;
    left:50%;
    margin-left:-100px;
    bottom:10px;
    background-color: #f7a5a5;
    color: #F0F0F0;
    font-family: Calibri;
    font-size: 20px;
    padding:10px;
    text-align:center;
    border-radius: 2px;
    -webkit-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
    -moz-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
    box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);</style>
        <div class="right_col" role="main">
                      <div class="row">
                       <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="x_panel">
                           <div class="x_title">
                             <h2>Notification</h2>
                    @if(Session::has('succ') || Session::has('succ1'))
                  <div class="alert alert-success alert-dismissible fade in col-md-9" role="alert" id="succMsg">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>
                        @if(Session::has('succ'))
                            {{Session::get('succ')['succMsg'] }}
                        @endif
                        @if(Session::has('succ1'))
                            {{Session::get('succ1')['succMsg'] }}
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
                   <div class='error' style='display:none'></div>
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
               
                 
                  <div id="show">
                  <div id="items" class="collapse">
                  
                   <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('ProductionInventoryOperation@addItem',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <!-- SmartWizard html -->
                    <fieldset>
                      <legend>Add Items</legend>
                      <!--div id="smartwizard">
                      <ul>
                          <li><a href="#step-1">Step 1<br /><small>Quotation Info</small></a></li>
                          <li><a href="#step-2">Step 2<br /><small>Add Items</small></a></li>
                          <li><a href="#step-3">Step 2<br /><small>Taxes Charges And Discount</small></a></li>
                          <li><a href="#step-4">Step 2<br /><small>Terms And Condition</small></a></li>
                      </ul-->
                 
                      <div>
                <div id="step-1">
                    <fieldset>
                      <legend>Item Info</legend>
                      <div class="form-group">
                          <label class="col-md-3 control-label">Item Type<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <select name="item_type" class="item_type form-control" required>
                                <option>--Select Type--</option>
                                </select>
                            </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Item Name<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <select name="item_name" class="item_name form-control" required>
                                <option>--Select Name--</option>
                                </select>
                            </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Item Brand<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <select id="item_brand" name="item_brand" class="form-control" required>
                                <option>--Select Brand--</option>
                                </select>
                            </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">HSN code<span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="item_hsn_code"  class="item_hsn_code form-control" readonly>
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>
                         
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Item Code/Model NO<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="item_code"  class="form-control" >
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Serial NO<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="serial_no"  class="form-control" >
                            <div class="help-block with-errors"></div>
                          </div>
                      </div>
                      
                       <div class="form-group">
                          <label class="col-md-3 control-label">Item Category<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <select id="item_category" name="item_category" class="form-control" required>
                                <option>--Select Category--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">Item Group<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <select id="item_group" name="item_group" class="form-control" required>
                                <option>--Select Group--</option>
                                </select>
                            </div>
                        </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Item Quantity<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="item_quantity"  class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div> 
 
                      <div class="form-group ">
                        <label class="col-md-3 control-label">Item Description<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <textarea name="item_description" class="form-control" rows="3"></textarea>
                            </div>
                      </div>      
                  </fieldset>
              </div><!--End First step-->

                <div id="step-3">
                  <fieldset>
                    <legend>Pricing And Taxes</legend>
                      <div id="form-step-2" role="form" data-toggle="validator">
                           
                      <div class="form-group ">
                        <label class="col-md-3 control-label">Item Price<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="item_price"  class="form-control">
                          </div>
                      </div>
                     
                  </div>  
                </fieldset>              
              </div><!--End Third step-->

             <div id="step-4">
                  <fieldset>
                    <legend>Storage Location</legend>
                      <div id="form-step-2" role="form" data-toggle="validator">
                           
                      <div class="form-group ">
                        <label class="col-md-3 control-label">Site Name<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <select  name="site_name" class="site_name form-control" required>
                                <option>--Select Site--</option>
                            </select>
                          </div>
                      </div>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Warehouse Name<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <select  name="warehouse_name" class="warehouse_name form-control" required>
                                <option>--Select Warehouse--</option>
                            </select>
                          </div>
                      </div>

                  </div>  
              </fieldset>              
             </div><!--End fourth step-->
                      
            <div id="step-5">
              <fieldset>
                <legend>Purchasing Information</legend>
                  <div id="form-step-3" role="form" data-toggle="validator">
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Purchased date<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="purchased_date" class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Warrenty Terms<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="warrenty_terms" class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Pack Size<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="pack_size" id="pack_size"  class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Item UOM<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="item_uom" class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary cancel">Cancel</button>
                          <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </div>

                </div>
              </fieldset>
            </div><!--End Fifth step-->
                      
          </div>
        </div>
      </fieldset>
      </form>
      </div>
      </div>

                 <div id="show1">
                  <div id="editItem" class="collapse">
                  <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('ProductionInventoryOperation@updateItem',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    
                    <fieldset>
                      <legend>Edit Item</legend>
                    
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Item Code<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="item_code" id="item_code"  class="form-control" readonly>
                            <input type="hidden" name="item_id" id="item_id">
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Item Quantity<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="item_quantity" id="item_quantity"  class="form-control" readonly>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>

                      <div class="form-group ">
                        <label class="col-md-3 control-label">Item Description<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <textarea name="item_description" class="form-control" rows="3" id="item_description"></textarea>
                            </div>
                      </div>

                      <div class="form-group ">
                        <label class="col-md-3 control-label">Item Price<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="item_price" id="item_price"  class="form-control">
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Item UOM<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="item_uom" id="item_uom"  class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Purchased date<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="purchased_date" id="purchased_date"  class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Warrenty Terms<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="warrenty_terms" id="warrenty_terms"  class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>   
                  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary cancel">Cancel</button>
                          <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </div>
                     </fieldset>  
                     </form>            
                  </div>
                 </div> 

                  <a data-toggle="collapse" class="item btn btn-info btn-xs" data-target="#items">Add Items</a>
                   <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Actions</th>
                          <th hidden>Item ID</th>
                          <th>ItemType</th>
                          <th>Item name</th>
                          <th>Brand Name</th>
                          <th>Item Code</th>
                          <th>Serial No</th>
                          <th>Item description</th>
                          <th>Item Price(&#x20B9;)</th>
                          <th>GST(%)</th>
                          <th>Item Quantity</th>
                          <th>UOM</th>
                          <th>Purchsed date</th>
                          <th>Warrenty Terms</th>
                          
                        </tr>
                      </thead>
                   
                      <tbody>
                      @if(isset($item))
                      @foreach($item as $key=>$value)
                        <tr>
                          <td>
                            <a data-toggle="collapse" class="item btn btn-info btn-xs" data-target="#editItem">Edit</a>
                          </td>
                          <td hidden>{{$value['item_id']}}</td>
                          <td>{{$value['type_name']}}</td>
                          <td>{{$value['name']}}</td>
                          <td>{{$value['brand_name']}}</td>
                          <td>{{$value['item_code']}}</td>
                          <td>{{$value['serial_no']}}</td>
                          <td>{{$value['description']}}</td>
                          <td>{{$value['item_price']}}</td>
                          <td>{{$value['item_gst']}}</td>
                          <td>{{$value['item_quantity']}}</td>
                          <td>{{$value['default_uom']}}</td>
                          <td>{{$value['purchased_date']}}</td>
                          <td>{{$value['warrenty_terms']}}</td>
                          
                       </tr>
                       @endforeach
                       @endif
                       
                          </tbody>
                    </table>
                  </div> 
                  
                  </div>
                </div>
          </div>
        



    <script type="text/javascript">

          $('.cancel').click(function(){
              location.reload();
          });
          $(document).ready(function(){
          //var timer, delay = 30000;
          //timer = setInterval(function(){
            $.ajax({
                      url:'/stockAlert/ajax',
                      type:"GET",
                      dataType:"text",
                      success:function(data){
                     $('.error').html(data);   
                    $('.error').stop().fadeIn(400).delay(3000).fadeOut(400);
                      }
                  });
         // }, delay);
              $('.item').click(function(){
                  $.ajax({
                      url:'/item_type/ajax',
                      type:"GET",
                      dataType:"json",
                      success:function(data){
                        $('.item_type').empty();
                        $.each(data, function(key, value) {
                            $('.item_type').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                      }
                  });
                  $('.item_type').on('change', function() {
            var typeID = $(this).val();
            if(typeID) {
                $.ajax({
                    url: '/item_name/ajax/'+typeID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        
                        $('.item_name').empty();
                        $.each(data, function(key, value) {
                            $('.item_name').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('.item_name').empty();
            }
        });
            $('.item_name').on('change', function() {
            var hsnID = $(this).val();
            if(hsnID) {
                $.ajax({
                    url: '/hsn/ajax/'+hsnID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      $('.item_hsn_code').val(data);
                    }
                });
            }else{
                $('.item_name').empty();
            }
        });
                  $.ajax({
                      url:'/Category/ajax',
                      type:"GET",
                      dataType:"json",
                      success:function(data){
                        $('#item_category').empty();
                        $.each(data, function(key, value) {
                            $('#item_category').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                      }
                  });
                  $.ajax({
                      url:'/Group/ajax',
                      type:"GET",
                      dataType:"json",
                      success:function(data){
                        $('#item_group').empty();
                        $.each(data, function(key, value) {
                            $('#item_group').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                      }
                  });
                  $.ajax({
                      url:'/Brand/ajax',
                      type:"GET",
                      dataType:"json",
                      success:function(data){
                        $('#item_brand').empty();
                        $.each(data, function(key, value) {
                            $('#item_brand').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                      }
                  });
                   $.ajax({
                      url:'/site/ajax',
                      type:"GET",
                      dataType:"json",
                      success:function(data){
                        $('.site_name').empty();
                        $.each(data, function(key, value) {
                            $('.site_name').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                      }
                  });
                   
              });

            $('.site_name').on('change', function() {
            var siteID = $(this).val();
            if(siteID) {
                $.ajax({
                    url: '/warehouse/ajax/'+siteID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        
                        $('.warehouse_name').empty();
                        $.each(data, function(key, value) {
                            $('.warehouse_name').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('.warehouse_name').empty();
            }
        });
  });

        $('.item').click(function(){
          
            $('#item_id').val($(this).parents().siblings('td').eq(0).text()); 
            $('#item_name').val($(this).parents().siblings('td').eq(2).text());
            $('#item_code').val($(this).parents().siblings('td').eq(4).text());
            $('#item_description').val($(this).parents().siblings('td').eq(6).text());
            $('#item_price').val($(this).parents().siblings('td').eq(7).text());
            $('#item_quantity').val($(this).parents().siblings('td').eq(9).text());
            $('#item_uom').val($(this).parents().siblings('td').eq(10).text());
            $('#purchased_date').val($(this).parents().siblings('td').eq(11).text());
            $('#warrenty_terms').val($(this).parents().siblings('td').eq(12).text());

            $('html, body').animate({
              scrollTop: $("#show").offset().top
          }, 2000);
        });
     
        </script>  
    <script type="text/javascript">
        
        $(document).ready(function() {
           $("html, body").animate({ scrollTop: 0 }, "slow");
        });
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
                    $('.btn-finish').removeClass('disabled');  
                }else{
                    $('.btn-finish').attribute('hidden');
                }
                
            });                               
        });   
    </script> 

  <!--*****************************************Wizard End***************************************************/-->
  
   @endsection     
