<!---Author:Amol Tribhuwan********************************-->
  @extends('master.master')

  @section('pageContent')
<div class="right_col" role="main">
                      <div class="row">
                       <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="x_panel">
                           <div class="x_title">
                             <h2>Add Asset</h2>
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
                    <fieldset>
                      <legend>Add New Asset</legend>
                   <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('SysAdminOperation@addAsset',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
        
                      <div class="form-group ">
                        <label class="col-md-3 control-label">Asset Name <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input type="text" name="asset_name" class="form-control" placeholder="Asset Name" required>
                      </div>
                      </div>
                          


                      <div class="form-group ">
                        <label class="col-md-3 control-label">Model <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                          <select name="model" id="model" class="form-control">
                               <option value="">--Select Model--</option>
                                  @if(isset($model))
                                    <?php
                                        for ($i=0; $i <count($model) ; $i++) { 
                                          echo "<option value=\"".$model[$i]['model_id']."\">".$model[$i]['name'].'/'.$model[$i]['model_number']."</option>";
                                        }
                                    ?>
                                  @endif
                          </select>
                        </div>
                      </div>


                       <div class="form-group ">
                        <label class="col-md-3 control-label">Categoty <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                          <select name="category" id="category" class="form-control" required="">
                               <option value="">--Select Category--</option>
                               <option value="Mobile Phones">Mobile Phones</option>
                               <option value="Tablets">Tablets</option>
                               <option value="Laptops">Laptops</option>
                               <option value="Telephones">Telephones</option>
                               <option value="Desktop">Desktop</option>
                              </select>
                        </div>
                      </div>

                      <div class="form-group ">
                        <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                          <select name="status" id="status" class="form-control">
                            <option value="">--Select Status--</option>
                            <option value="Ready To Deploy">Ready To Deploy</option>
                            <option value="Working">Working</option>
                            <option value="Pendng">Pendng</option>
                            <option value="Out Of Diagnostic">Out Of Diagnostic</option>
                            <option value="Out Of Repaire">Out Of Repaire</option>
                             <option value="Broken-Not Flexible">Broken-Not Flexible</option>
                          </select>
                          <span>

If you wish to assign this asset immediately, select "Ready to Deploy" from the status list above.
</span>
                        </div>
                      </div>

                      <div id="assign" hidden="">
                          <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Employee </label>
                              <div class="col-md-7">
                                <select class="form-control" name="employee" id="employee" >
                                <option value="">--Select Employee--</option>
                                </select>
                              </div>
                            </div>
                      </div>

                      <div class="form-group">
                      <label class="col-md-3 control-label">Serial <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input  type="text" name="serial" class="form-control"  required>
                      </div>
                      </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Purchase Date <span class="required">*</span></label>
                              <div class='col-md-7 col-sm-6 col-xs-12'>
                            <input type='text' name="purchase_date" class="form-control input-group date myDatepicker2" required />
                      </div>
                         </div>
                                   
                      <div class="form-group">
                      <label class="col-md-3 control-label">Supplier <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input  type="text" name="supplier" class="form-control"  required>
                      </div>
                      </div>

                      <div class="form-group">
                      <label class="col-md-3 control-label">Order Number <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input  type="text" name="order_number" class="form-control"  required>
                      </div>
                      </div>


                      <div class="form-group">
                      <label class="col-md-3 control-label">Purchase Cost <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input  type="text" name="purchase_cost" class="form-control"  required>
                      </div>
                      </div>


                      <div class="form-group">
                      <label class="col-md-3 control-label">Warranty <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input  type="text" name="warranty" class="form-control" placeholder="In Months"  required>
                      </div>
                      </div>


                      <div class="form-group">
                      <label class="col-md-3 control-label">Notes <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <textarea id="notes" name="notes" class="form-control" required=""></textarea>
                      </div>
                      </div>

                          <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Default Location</label>
                              <div class="col-md-7">
                                <select class="form-control" name="location" id="location" >
                                <option value="">--Select Location--</option>
                                  @if(isset($location))
                                    <?php
                                        for ($i=0; $i <count($location) ; $i++) { 
                                          echo "<option value=\"".$location[$i]['location_id']."\">".$location[$i]['location_name']."</option>";
                                        }
                                    ?>
                                  @endif
                                </select>
                              </div>
                            </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div> 
                   </form>
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
    $('.myDatepicker2').datetimepicker({
        format: 'YYYY-DD-MM'
    });

    $('select[name="status"]').on('change', function() {
            if($(this).val()=="Ready To Deploy"){
              $('#assign').show();
             $('#employee').empty();
             $('#employee').append("<option>--Select Employee--</option>");
                  $.ajax({
                      url: '/getSysAdminEmployee/ajax/',
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                        for(var i=0;i<data.length;i++){
                            $('#employee').append("<option value=\""+data[i]['emp_id']+"\">"+data[i]['full_name']+"</option>");
                        }
                      
                }
            });
          }
          else{
             
              $('#assign').hide();
           }
        });
  </script>


   @endsection     