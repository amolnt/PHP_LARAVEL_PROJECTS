<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
	@section('pageContent')
			<div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Lead</h2>
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
                  <form  role="form" action="{{action('MrkExecutiveOperation@addLead',csrf_token())}}" method="post" class="form-horizontal form-label-left" autocomplete="off">
                <input type="hidden" name="_token" value="{{csrf_token()}}">   
                 
                <div class="form-group">
                      <label class="control-label col-md-3 col-sm-6 col-xs-12">Lead Source*</label>
                          <div class="col-md-7 col-sm-6 col-md-12">
                            <select class="form-control" name="lead_source" required>
                              <option value="">--Select Lead Source--</option>
                                <option>Customer Referral</option>
                                <option>Inbound Email</option>
                                <option>Inbound Phone Call</option>
                                <option>Organic Search</option>
                                <option>Outbound Phone Call</option>
                                <option>Referral Site</option>
                                <option>Social Media</option>
                                <option>Unknown</option>
                            </select>
                          </div>
                 </div>

                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-6 col-xs-12">Service Type*</label>
                          <div class="col-md-7 col-sm-6 col-md-12">
                            <select class="form-control" name="service_type" id="service_type" required>
                              <option value="">--Select Service Type--</option>
                                @if(isset($service_type))
                                  <?php
                                      for ($i=0; $i <count($service_type) ; $i++) { 
                                        echo '<option value="'.$service_type[$i]['service_type_id'].'">'.$service_type[$i]['service_type_name'].'</option>';
                                      }
                                  ?>
                                @endif
                            </select>
                          </div>
                 </div>

                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-6 col-xs-12">Service Sub Type*</label>
                          <div class="col-md-7 col-sm-6 col-md-12">
                            <select class="form-control" name="service_subtype" id="service_subtype" required>
                              <option value="">--Select Service Sub Type--</option>
                            </select>
                          </div>
                 </div>

                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-6 col-xs-12">Organization Type*</label>
                          <div class="col-md-7 col-sm-6 col-md-12">
                            <select class="form-control" name="orgType" id="orgType" required>
                              <option value="">--Select Organization Type--</option>
                                <option>Individual</option>
                                <option>Partnership</option>
                                <option>Pvt.Ltd. Company</option>
                                <option>Institute</option>
                                <option>School</option>
                                <option>Others</option>
                            </select>
                          </div>
                 </div>

                 <div class="form-group" id="orgName">
                      <label  class="control-label col-md-3 col-sm-6 col-xs-12" for="orgName">Organization Name</label>
                         <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" id="organization_name" name="orgName" required>
                        </div>
                 </div>
                 

                 <div class="form-group">
                      <label  class="control-label col-md-3 col-sm-6 col-xs-12" for="contPerName">Contact Person Name*</label>
                         <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="contPerName" id="contPerName" required>
                        </div>
                 </div>

                 <div class="form-group">
                      <label  class="control-label col-md-3 col-sm-4 col-xs-12" for="address">Address*</label>
                         <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="address" id="address" required>
                        </div>
                 </div>
                 
                 <div class="form-group">
                      <label  class="control-label col-md-3 col-sm-6 col-xs-12" for="mobileNo">Phone No*</label>
                         <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="tel" class="form-control" data-inputmask="'mask' : '(999) 999-9999'" name="phoneNo" id="phoneNo" required>
                        </div>
                 </div>
                 <div class="form-group">
                      <label  class="control-label col-md-3 col-sm-6 col-xs-12" for="mobileNo">Mobile No*</label>
                         <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" maxlength="10"  pattern="[0-9]{10}"  class="form-control" name="mobileNo" id="mobileNo" required>
                        </div>
                 </div>
                 <div class="form-group">
                      <label  class="control-label col-md-3 col-sm-6 col-xs-12" for="email">Email*</label>
                         <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                 </div>
                   <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Description <span class="required">*</span></label>
                        <div class="col-md-7">
                          <textarea rows="3" id="equip-desc" name="description" class="form-control col-md-7 col-xs-12" ></textarea>
                        </div>
                      </div>
                 
                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-6 col-xs-12">Status*</label>
                          <div class="col-md-7 col-sm-6 col-md-12">
                            <select class="form-control" name="status" id="status" required>
                              <option value="">--Select Status--</option>
                                <option>New</option>
                                <option>Not Attemted</option>
                                <option>Attempted</option>
                                <option>Contacted</option>
                                <option>New Opportunity</option>
                                <option>Disqualify</option>
                            </select>
                          </div>
                 </div>
                  <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Reset</button>
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
             </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          $('select[name="orgType"]').on('change', function() {
            if($('#orgType').val()=='Individual'){
              $('#organization_name').attr('readonly',true);
            }
            else{
                $('#organization_name').attr('readonly',false);
              }
          });
          $('#contPerName').on('keyup',function(){
              if($('#orgType').val()=='Individual')
                $('#organization_name').val($(this).val());
          });
          $("#contPerName").find(".remove-soon").val();

          $('select[name="service_type"]').on('change', function() {
            
            var service_type_id = $(this).val();
            if(service_type_id) {
                $.ajax({
                    url: '/getServiceSubTypes/ajax/'+service_type_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      $('#service_subtype').empty();
                      $('#service_subtype').append('<option value="">--Select Service Sub Type--</option>');
                      
                      for (var i = 0; i < data.length; i++) {
                          $('#service_subtype').append('<option value="'+data[i]['service_subtype_id']+'">'+data[i]['service_subtype_name']+'</option>');
                      }
                    }
                });
            }else{
              $('#addSuperior').val("");
            }
        });
        </script>
	@endsection