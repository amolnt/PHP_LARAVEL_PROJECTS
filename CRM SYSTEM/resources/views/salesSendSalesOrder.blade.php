<!---Author:Amol Tribhuwan********************************-->
  @extends('master.master')
  @section('import')
    <!-- Include SmartWizard CSS -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />
    
    <!-- Optional SmartWizard theme -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard_theme_dots.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('assets/css/chosen.min.css')}}">
    @endsection
  @section('pageContent')
<div class="right_col" role="main">
                      <div class="row">
                       <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="x_panel">
                           <div class="x_title">
                             <h2>Quotation</h2>
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
                @if(Session::has('succ'))
                <fieldset>
                <legend>Download Quotation</legend>
                    <a href="/downloadSalesOrder"> Click to Download Quotaion </a> 
                </fieldset><br>
                <fieldset>
                <legend>Send Email</legend>
                  <form class="form-horizontal form-label-left input_mask" method="post" action="{{action('Sales@sendSalesOrder')}}" enctype="multipart/form-data" id="sendSalesOrder" role="form" data-toggle="validator" accept-charset="utf-8">
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
                            <input type="text" name="subject" id="subject" class="form-control" value="Quotation-{{Session::get('succ')['so']}}" required>
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
                  @if(!Session::has('succ'))
                  <div id="show">
                  <div id="sendSalesOrder" class="collapse">
                  
                   <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('SalesOperation@addSalesOrder',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <!-- SmartWizard html -->
                    <fieldset>
                      <legend>Steps To Create Quotation</legend>
                      <div id="smartwizard">
                      <ul>
                          <li><a href="#step-1">Step 1<br /><small>Quotation Info</small></a></li>
                          <li><a href="#step-2">Step 2<br /><small>Add Items</small></a></li>
                          <li><a href="#step-3">Step 2<br /><small>Taxes Charges And Discount</small></a></li>
                          <li><a href="#step-4">Step 2<br /><small>Terms And Condition</small></a></li>
                      </ul>
                    <div>

                    <div id="step-1">
                    <fieldset>
                      <legend>Quotation Info</legend>
                      <div id="form-step-0" role="form" data-toggle="validator">
                      <div class="form-group ">
                        <label class="col-md-3 control-label">Lead<span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                          <input type="text" name="organization_name" id="organization_name" class="form-control" required>
                         <input type="hidden" name="lead" id="lead" class="form-control">
                         
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

                        <div class="form-group ">
                          <label class="col-md-3 control-label">Purchase Order<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="purchaseOrder" class="form-control">
                          </div>
                      </div>

                        <div class="form-group">
                        <label class="col-md-3 control-label">Order Type<span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <select  name="order_type" class="form-control owner ">
                               <option>--Select Type--</option>
                               <option>Sales</option>
                               <option>Maintainance</option>
                               <option>Shopping Cart</option>
                            </select>
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
                        <div class="form-group ">
                        <label class="col-md-3 control-label">Delivery Date<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            
                           
                          <div class="form-group">
                            <div class='input-group date myDatepicker2'>
                            <input type='text' name="delivery_date" class="form-control"/>
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


                      <div id="step-2">
                        <fieldset>
                          <legend>Add Items</legend>
                      <div class="col-md-12 ">
                      <a href="javascript:void(0);" id='anc_add' class="btn btn-info">Add Item</a>
                      <a href="javascript:void(0);" id='anc_rem' class="btn btn-danger">Remove Item</a>
                      <table id="tblItem" class="table table-bordered">
                   
                        <tr>
                          <td><input type="checkbox" id="checkAll" name="chk"></td>
                          <td>Item Site</td>
                          <td>Item Warehouse</td>
                          <td>Item Name/Model Number</td>
                          <td>Discription</td>
                          <td>Quantity</td>
                          <td>Rate</td>
                          <td>Amount</td>
                        </tr>
                      </table>
                      </div>


                        <div class="form-group ">
                          <label class="col-md-8 control-label">Total<span class="required">*</span></label>
                          <div class="col-md-2 col-sm-6 col-xs-12">
                            <input type="text" name="total" id="total"  class="form-control col-md-2" readonly>
                          </div>
                      </div>
                        </fieldset>
                      </div><!--End Fourth step-->

                      <div id="step-3">
                        <fieldset>
                          <legend>Taxes Charges And Discount</legend>
                          <div id="form-step-2" role="form" data-toggle="validator">
                           
                             <div class="form-group ">
                          <label class="col-md-3 control-label">Additional Discount Percentage<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="adsDisPer" id="adsDisPer"  class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Additional Discount Ammount<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="adsDisAmt" id="adsDisAmt"  class="form-control" readonly>
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
                              <input type="text" name="txAndChrg" id="txAndChrg"  class="form-control" readonly= required>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>

                     
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Grand Total<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="grandTotal" id="grandTotal"  class="form-control" readonly>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>
                      </div>  
                        </fieldset>              

                      </div><!--End Third step-->
                      <div id="step-4">
                        <fieldset>
                          <legend>Terms And Condition</legend>
                          <div id="form-step-3" role="form" data-toggle="validator">
                            <div class="form-group ">
                          <label class="col-md-3 control-label">Terms<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="terms" id="terms"  class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Terms Details<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                  <textarea name="term_details" id="editor-one" class="editor-wrapper form-control" required></textarea>
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
                  </div>

                   <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Actions</th>
                          <th hidden>Lead ID</th>
                          <th>Lead source</th>
                          <th>Organization Name</th>
                          <th hidden></th>
                          <th>Contact Person Name</th>
                          <th>Mobile No</th>
                          <th>Email</th>
                          <th>Address</th>
                          <th>Description</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                   
                      <tbody>
                        @if(isset($lead))
                        @foreach($lead as $key=>$value)
                        <tr>
                          <td>
                            <a data-toggle="collapse" class="sendSalesOrder btn btn-info btn-xs" data-target="#sendSalesOrder">SendSalesOrder</a>
                           </td>
                          <td hidden>{{$value['lead_id']}}</td>
                          <td>{{$value['lead_source']}}</td>
                          <td>{{$value['organization_name']}}</td>
                          <td hidden>{{$value['address']}}</td>
                          <td>{{$value['contact_person_name']}}</td>
                          <td>{{$value['mobile_no']}}</td>
                          <td>{{$value['email']}}</td>
                          <td>{{$value['address']}}</td>
                          <td>{{$value['description']}}</td>
                          <td>{{$value['status']}}</td>
                       </tr>
                       @endforeach
                       @endif
                          </tbody>
                    </table>
                  </div> 
                  @endif
                  </div>
                </div>
          </div>
        </div>
        

   <!-- bootstrap-daterangepicker -->
    <script src="{{asset('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    
   <script>
    $('#myDatepicker2').datetimepicker({
        format: 'YYYY-DD-MM'
    });
  </script>

    <script type="text/javascript">

          $('#cancel').click(function(){
              location.reload();
          });

          $("#anc_add").click(function(){
            $('#tblItem tr').last().after('<tr class="targetfields"><td><input class="chk" type="checkbox" name="chk"></td><td><select id="site'+$('#tblItem tr').size()+'" name="'+$('#tblItem tr').size()+'" onchange="mySite(this)" class="site form-control col-md-12"><option>--Select Site--</option></select></td><td><select id="warehouse'+$('#tblItem tr').size()+'" class="warehouse form-control col-md-12"><option>--Select WareHouse--</option></select></td><td><select name="item_name[]" id="item_name'+$('#tblItem tr').size()+'" class="item_name form-control selectpicker" data-live-search="true" hidden><option>--Select Item--</option></select></td><td><textarea name="description[]" rows="2" cols="50" class="form-control description" id="description'+$('#tblItem tr').size()+'" readonly></textarea></td><td><input type="text" class="form-control quantity"  name="quantity[]" id="quantity'+$('#tblItem tr').size()+'" readonly></td><td><input type="text" class="form-control rate" name="rate[]" id="rate'+$('#tblItem tr').size()+'" readonly></td><td><input type="text" class="form-control amount" name="amount[]" readOnly></td></tr>');
            
            $('.selectpicker').selectpicker('refresh');
            var index;
             $("#tblItem .targetfields").each(function() {
              index= $(this).closest('tr').index();
            });
            
             $.ajax({
                      url:'/getSites/ajax/',
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
           function mySite(arg){
             var index=arg.getAttribute('name');
            
              var siteID = $('#site'+index).val();
              if(siteID) {
                $.ajax({
                    url: '/warehouse/ajax/'+siteID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {  
                        $('#warehouse'+index).empty();
                        $('#warehouse'+index).append('<option>--Select WareHouse--</option>');
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
                $("#tblItem .targetfields").each(function() {
                var qty = parseInt($(this).find(".quantity").val());
                var rate = parseFloat($(this).find(".rate").val());
                var amount = qty * rate;

               $(this).find(".amount").val(amount);
               if(!isNaN(amount))
                   total+=amount;
                  });
            $("#total").html(total);
            }else{
                return false;
            }
          });

        $("#checkAll").click(function () {
               $('input:checkbox').not(this).prop('checked', this.checked);
                });
 
                  $('.quantity').on('change', function () {
                    var quantity = parseInt($this.val());
                    
                  });

             

                $("#tblItem").keyup(function(event) {
                      var total = 0;
                  $("#tblItem .targetfields").each(function() {
                     var qty = parseInt($(this).find(".quantity").val());
                      var rate = parseFloat($(this).find(".rate").val());
                      var amount = qty * rate;
                      $(this).find(".amount").val(amount);
                      if(!isNaN(amount))
                         total+=amount;
                       });
                      $("#total").val(total);
                    });

                    $("#txAndChrg").keyup(function(event){
                      var grandTotal=0;
                      var total=parseFloat($("#grandTotal").val());
                      if(isNaN(total)){
                          var total=0;
                          var total=parseFloat($("#total").val());

                          var dis=parseFloat($(this).val());
                          var discountAmount=(((dis/100) * total));
                          $("#adsDisAmt").val(discountAmount);
                          total-=discountAmount;
                          $("#grandTotal").val(total);
                      }
                      else{
                          var tax=parseFloat($(this).val());
                          var grandTotal=((tax * total)/100)+total;
                          $("#grandTotal").val(grandTotal);
                      }
                    });
                  
                  $("#adsDisPer").keyup(function(event){
                      var total=0;
                      var total=parseFloat($("#total").val());

                      var dis=parseFloat($(this).val());
                      var discountAmount=(((dis/100) * total));
                      $("#adsDisAmt").val(discountAmount);
                       total-=discountAmount;
                      var grandTotal=0;
                      var total=parseFloat($("#grandTotal").val());
                      if(isNaN(total)){
                          var total=0;
                          var total=parseFloat($("#total").val());

                          var dis=parseFloat($(this).val());
                          var discountAmount=(((dis/100) * total));
                          $("#adsDisAmt").val(discountAmount);
                          total-=discountAmount;
                          $("#grandTotal").val(total);
                      }
                      else{
                          var tax=parseFloat($(this).val());
                          var grandTotal=((tax * total)/100)+total;
                          $("#grandTotal").val(grandTotal);
                      }
                      $("#grandTotal").val(total);
                    });

                  
              function myFunction(arg){
                var index=arg.getAttribute('name');
                $('#item_name'+index).empty();
                 $.ajax({
                      url:'/itemAuto/ajax/',
                      data:{item_name:$('#item'+index).val(),warehouse:$('#warehouse'+index).val()},
                      type:"GET",
                      dataType:"json",
                      success:function(data){
                     $('#item_name'+index).empty();
                    $('#item_name'+index).append('<option>--Select Item--</option>');
                     for(var i=0;i<data.length;i++){
                        
                     $('#item_name'+index).append('<option value="'+ data[i]['item_id'] +'">'+ data[i]['name']+' / '+data[i]['item_code'] +'</option>');
                     $('#item_name'+index).selectpicker('refresh');
                     }
                   
                    }
                  }); 
                  $('#item_name'+index).on('change', function() {
                      var itemID = $('#item_name'+index).val();
                     
                      if(itemID) {
                          $.ajax({
                            url: '/item_info/ajax/'+itemID,
                            type: "GET",
                            dataType: "json",
                            success:function(data) {
                              
                              for(var i=0;i<data.length;i++){
                                $('#description'+index).html(data[0]);
                                $('#rate'+index).val(data[1]);
                                $('#txAndChrg').val(data[2]);
                              }
                              $('#quantity'+index).attr("readonly",false);
                    
                          }
                       });
                      }else{return false;}
                  });     
              } 
         

        $('.sendSalesOrder').click(function(){
            $('#lead').val($(this).parents().siblings('td').eq(0).text()); 
            $('#organization_name').val($(this).parents().siblings('td').eq(2).text());
            $('#address').val($(this).parents().siblings('td').eq(7).text());
            $('#contact_person_name').val($(this).parents().siblings('td').eq(4).text());
            $('#email').val($(this).parents().siblings('td').eq(6).text());
            $('#mobile_no').val($(this).parents().siblings('td').eq(5).text());

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
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    
   <script>
    $('.myDatepicker2').datetimepicker({
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
            var btnCancel = $('<button data-toggle=\"collapse\" data-target=\"#quotation\"></button>').text('Cancel')
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
                    $('.btn-finish').attr('disabled',true);  
                }else{
                    $('.btn-finish').attr('disabled',false);
                }
                
            });                               
        });   
    </script> 

  <!--*****************************************Wizard End***************************************************/-->
  

    <script src="{{asset('assets/js/chosen.jquery.min.js')}}"></script>
    <script type="text/javascript">
      
    </script>
   @endsection     