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
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="show" >
                <fieldset id="resendQuotation" class="collapse">
                  <legend>Resend Quotation</legend>
                <fieldset>
                <legend>Download Quotation</legend>
                    <a href="/downloadQuotation"> Click to Download Quotaion </a> 
                </fieldset><br>
                
                <fieldset >
                <legend>Send Email</legend>
                  <form class="form-horizontal form-label-left input_mask" method="post" action="{{action('Sales@resendQuotation')}}" enctype="multipart/form-data" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                     <input type="hidden" name="quotation" id="quotation">
                      <div class="form-group ">
                        <label class="col-md-3 control-label">TO</label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" id="toEmail" name="toEmail" class="form-control lead_id" required>
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Subject<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" id="subject" name="subject" id="subject" class="form-control" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                        <label class="col-md-3 control-label">Choose File<span class="required">*</span></label>
                       <div class="btn-group col-md-7">
                        <input type="file" name="file" accept=".pdf" required/>
                      </div>
                      </div>

                      <!--div class="form-group ">
                          <label class="col-md-3 control-label">Message<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                              <textarea class="editor-wrapper form-control" name="message" id="editor-one" required></textarea>
                         </div>
                        </div-->
                      
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a  class="btn btn-primary change" data-toggle="collapse" data-target="#resendQuotation">Cancel</a>
                          <button type="submit" class="btn btn-success">Send</button>
                        </div>
                      </div>
                </form>
              </fieldset> 
              </fieldset>
                </div>
                <br>
                    
               
                   <form class="form-horizontal form-label-left input_mask" method="post" action="{{action('MrkExecutiveOperation@sendToApprove',csrf_token())}}" enctype="multipart/form-data" role="form" data-toggle="validator" id="sendToApproveForm" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="sendToApprove" id="sendToApprove">
                    </form>

                  <fieldset>
                    <legend>All Leads</legend>
                      <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th hidden>Lead id</th>
                          <th>Quotation Number</th>
                          <th hidden="">Address</th>
                          <th>organization Name</th>
                          <th>Contact Person Name</th>
                          <th>Mobile No</th>
                          <th>Email</th>
                          <th>Lead Status</th>
                          <th>Sent To Approve</th>
                          <th>Sent Status</th>
                           <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                      
                        @if(isset($tr))
                            <?php

                                  echo $tr;
                                
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
            $('.approve').click(function(event){
                $('#sendToApprove').val($(this).parents().siblings('td').eq(0).text());
                $('#sendToApproveForm').submit();
            });

            $('.resend').click(function(){

                  $('#quotation').val($(this).parents().siblings('td').eq(1).text());
                  $('#toEmail').val($(this).parents().siblings('td').eq(6).text());
                  $('#subject').val("Quotation-"+$(this).parents().siblings('td').eq(1).text());
                  $.ajax({
                      url: '/setQuotationSession/ajax/',
                      data:{quotation_id:$(this).parents().siblings('td').eq(1).text()},
                      type: "GET",
                      dataType: "text",
                      success:function(data) {
                            alert(data);
                          }
                  });
              $('html, body').animate({
                scrollTop: $("#show").offset().top
              }, 2000);
            });

});
   
  $(document).ready(function() {
     
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
              $('#tblItem tr').last().after('<tr class="targetfields"><td><input class="chk" type="checkbox" name="chk"></td><td hidden><input type="text" name="code[]" id="code'+$('#tblItem tr').size()+'"></td> <td hidden><input type="text" name="tax[]" id="tax'+$('#tblItem tr').size()+'"></td><td hidden><input type="text" name="tax_amount[]" id="tax_amount'+$('#tblItem tr').size()+'"></td><td><select id="type'+$('#tblItem tr').size()+'" name="type[]" onchange="myType(this)" class="type form-control"><option value="">--select Type--</option><option value="1">Goods</option><option value="2">Services</option></select></td><td><select id="site'+$('#tblItem tr').size()+'" name="'+$('#tblItem tr').size()+'" onchange="mySite(this)" class="site form-control" disabled></select></td><td><select id="warehouse'+$('#tblItem tr').size()+'" class="warehouse form-control" disabled></select></td><td><select onchange="changeItem(this)" name="item_name[]" id="item_name'+$('#tblItem tr').size()+'" class="item_name form-control selectpicker" data-live-search="true"></select></td><td><textarea name="description[]" rows="2" cols="60" class="form-control description" id="description'+$('#tblItem tr').size()+'" readonly></textarea></td><td><input type="text" class="form-control quantity" onkeyup="myQuantity(this)"  name="quantity[]" id="quantity'+$('#tblItem tr').size()+'" readonly></td><td><input type="text" class="form-control rate" name="rate[]" id="rate'+$('#tblItem tr').size()+'" readonly></td><td><input type="text" id="amount'+$('#tblItem tr').size()+'" class="form-control amount" name="amount[]" readOnly></td></tr>');
           
              $('.selectpicker').selectpicker('refresh');
              
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
        function myType(arg){
           var index=arg.getAttribute('id')[arg.getAttribute('id').length-1];
           var type= $('#type'+index).val();
           if(type==1){
            $('#site'+index).attr('disabled',false);
            $('#warehouse'+index).attr('disabled',false);
            $('#quantity'+index).attr('readonly',false);
            //$('#service'+index).attr('id','item'+index);
            //$('#item'+index).attr('onkeyup','myFunction(this)');
            //$('#service_name'+index).attr('id','item_name'+index);
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
           }
           else{
                $('#site'+index).attr('disabled',true);
                $('#warehouse'+index).attr('disabled',true);
                $('#quantity'+index).attr('readonly',true);
                //$('#item'+index).attr('id','service'+index);
                //$('#service'+index).attr('onkeyup','myService(this)');
                //$('#item_name'+index).attr('id','service_name'+index);  
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

    function myFunction(arg){
       var index=arg.getAttribute('id')[arg.getAttribute('id').length-1];
        $('#item_name'+index).empty();
           //clearTimeout(typingTimer);
            var name = $('#item'+index).val();
           
             // typingTimer = setTimeout(function(){
            if($('#type'+index).val()==1)
            {
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
            else{
                  $.ajax({
                      url:'/serviceAuto/ajax/'+name,
                      type:"GET",
                      dataType:"json",
                      success:function(data){
                        $('#item_name'+index).empty();
                        $('#item_name'+index).append('<option value="">--select Service--</option>');
                        for(var i=0;i<data.length;i++){
                          $('#item_name'+index).append('<option value="'+ data[i]['service_id'] +'">'+ data[i]['service_description']);
                        }
                        $('#item_name'+index).selectpicker('refresh');
                      }

                  });
            }
      }  

      function changeItem(arg){
        var index=arg.getAttribute('id')[arg.getAttribute('id').length-1];
          if($('#type'+index).val()==1){

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
                      $('#txAndChrg').val(data[2]);
                      $('#tax'+index).val(data[2]);
                      $('#code'+index).val(data[3]);
                      $('#tax_amount'+index).val(((data[2] * data[1])/100));
                      }
                    $('#quantity'+index).attr("readonly",false);
                    
                    }
                });
            }else{return false;}          
          }
          else{
                var serviceID = $('#item_name'+index).val();  
                if(serviceID) {
                $.ajax({
                    url: '/service_info/ajax/'+serviceID,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                      $('#description'+index).html(data[0]['description']);
                      $('#rate'+index).val(data[0]['service_charge']);
                      $('#txAndChrg').val(data[0]['service_gst']);
                      $('#tax'+index).val(data[0]['service_gst']);
                      $('#code'+index).val(data[0]['service_sac_code']);
                      $('#tax_amount'+index).val(((parseInt(data[0]['service_gst']) * parseInt(data[0]['service_charge']))/100));  
                      var total=0;
                      var amount=0;                     
                      var qty = parseInt($("#quantity"+index).val());
                      var rate = parseFloat($("#rate"+index).val());
                      $("#amount"+index).val(rate);
                      var ind=1;
                      $("#tblItem .targetfields").each(function() {
                         if(!isNaN($("#amount"+ind).val())){
                            amount+= parseInt($("#amount"+ind).val());
                            ind+=1;
                          }
                      });
                      $('#quantity'+index).attr('readonly',false);
                      $('#quantity'+index).val('0');
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


                      if($.trim($("#total").val()).length>2){
                         $('#adsDisPer').attr("readonly",false); 
                      }
                    }
                })
            }else{return false;} 
          }
      }
/************************end********************************************************/


/******************************Ajax******************************************/
    
        </script>  
      <!--*************************End Quotation*************************************************-->
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
            var btnCancel = $('<button data-toggle=\"collapse\" data-target=\".edit\"></button>').text('Cancel')
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

  