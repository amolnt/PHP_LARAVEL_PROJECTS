@extends('master.master')
	@section('pageContent')
			<div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add an Equipment</h2>
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
              <form method="post" action="{{action('CustomController@addEquipment')}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Area of Equipment<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                          <select id="area" name="area" class="form-control" required>
                          @if(isset($area))
                            <?php
                                echo "<option>--Select Area--</option>";
                                for ($i=0; $i <count($area) ; $i++) { 
                                  echo "<option value=\"".$area[$i]['a_id']."\">".$area[$i]['area_name']."</option>";
                                }
                                ?>
                          @endif
                          </select>
                         </div>
                      </div>
                     <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Product Type<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                          <select id="heard" name="equ_type" class="form-control" required>
                              <option value="">--Select Product Type--</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Tab">Tab</option>
                                <option value="Desktop">Desktop</option>
                                <option value="Printer">Printer</option>
                                <option value="Scanner">Scanner</option>
                                <option value="Software">Software</option>
                                <option value="Network_Device">Network Devices</option>
                                <option value="Other">Other</option>
                              </select>
                         </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Make Name</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control" name="equ_name" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Model No</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control" name="model_no" required="">
                         
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 ">Serial Number</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control" name="serial_no" required="">
                        </div>
                      </div>                      
                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Technical Specification<span class="required">*</span></label>
                        <div class="col-md-7">
                          <textarea rows="5" id="equip-desc" name="equ_discription" class="form-control col-md-7 col-xs-12" required=""></textarea>
                        </div>
                      </div>
                      <br>                    
                      <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                        </div>             
                  
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
	@endsection