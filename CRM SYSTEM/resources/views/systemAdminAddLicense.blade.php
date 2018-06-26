<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
@section('pageContent')
   <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add License</h2>
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
                  <legend>Add New  License</legend>
                   <form method="post" action="{{action('SysAdminOperation@addLicense',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
           
                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Software Name</label>
                              <div class="col-md-7">
                                  <input type="text" id="software_name" name="software_name" class="form-control" required>
                              </div>
                            </div>


                            <div class="form-group" >
                              <label class="control-label col-md-3" name="name" for="first-name">Product Key</label>
                              <div class="col-md-7">
                                <textarea name="product_key" id="product_key" class="form-control"></textarea>
                              </div>
                            </div>

                             <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Manufacture</label>
                              <div class="col-md-7">
                                <select class="form-control" name="manufacture" id="manufacture" required="">
                                <option value="">--Select Manufacture--</option>
                                  @if(isset($manufacture))
                                    <?php
                                        for ($i=0; $i <count($manufacture) ; $i++) { 
                                          echo "<option value=\"".$manufacture[$i]['manufacture_id']."\">".$manufacture[$i]['manufacure_name']."</option>";
                                        }
                                    ?>
                                  @endif
                                </select>
                              </div>
                            </div>
                          
                             <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">License To Name</label>
                              <div class="col-md-7">
                                  <input type="text" id="license_to_name" name="license_to_name" class="form-control" required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">License To Email</label>
                              <div class="col-md-7">
                                  <input type="text" id="license_to_email" name="license_to_email" class="form-control" required>
                              </div>
                            </div>

                            <div class="form-group" >
                              <label class="control-label col-md-3" name="name" for="first-name">Supplier Name</label>
                              <div class="col-md-7">
                                  <input type="text" id="supplier" name="supplier" class="form-control" required="">
                              </div>
                            </div>


                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Order Number</label>
                              <div class="col-md-7">
                                  <input type="text" id="order_number" name="order_number" class="form-control" required>
                              </div>
                            </div>


                             <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Purchase Cost</label>
                              <div class="col-md-7">
                                  <input type="text" id="purchase_cost" name="purchase_cost" class="form-control" required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Purchase Date</label>
                              <div class="col-md-7">
                                    <input type='text' name="purchase_date" class="form-control input-group date myDatepicker2" required />
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Expire Date</label>
                              <div class="col-md-7">
                                    <input type='text' name="expire_date" class="form-control input-group date myDatepicker2" required />
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Termination Date</label>
                              <div class="col-md-7">
                                    <input type='text' name="termination_date" class="form-control input-group date myDatepicker2" required />
                              </div>
                            </div>
                           
                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Purchase Order Number</label>
                              <div class="col-md-7">
                                  <input type="text" id="purchase_order_number" name="purchase_order_number" class="form-control" required>
                              </div>
                            </div>

                              <div class="form-group" >
                              <label class="control-label col-md-3" name="name" for="first-name">Notes</label>
                              <div class="col-md-7">
                                <textarea name="notes" id="notes" class="form-control"></textarea>
                              </div>
                            </div>

                          <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" type="reset">Reset</button>
                            <input type="submit" class="btn btn-success" value="submit">
                          </div>
                        </div>  
                       </form>
                </fieldset>
              </div>
            </div>
          </div>
        </div>
      </div>

       <!-- bootstrap-daterangepicker -->
    <script src="{{asset('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    
   <script>
    $('.myDatepicker2').datetimepicker({
        format: 'YYYY-DD-MM'
    });
  </script>
@endsection