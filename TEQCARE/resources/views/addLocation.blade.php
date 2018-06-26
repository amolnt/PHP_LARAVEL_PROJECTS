@extends('master.master')
	@section('pageContent')

	<div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>add location</h2>
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
				  <form method="post" action="{{action('CustomController@addLocation')}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
             	<input type="hidden" name="_token" value="{{csrf_token()}}">

		                  <div class="form-group">
                        <label class="control-label col-md-3" name="address1" for="address1">address1</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control col-md-7 col-xs-12" name="address1" id="address1" required>
                        </div>
                        </div>

                        <div class="form-group">
                        <label class="control-label col-md-3" name="address2" for="address2">address2</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control col-md-7 col-xs-12" name="address2" id="address2"  required>

                        </div>
                        </div>
                        

                       <div class="form-group">
                        <label class="control-label col-md-3" for="state">state<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                          <select id="state" name="state" class="form-control" required>
                          <option value="">--select state--</option>
                          @if(isset($state))
                            <?php
                                for ($i=0; $i <count($state) ; $i++) { 
                                  echo "<option value=\"".$state[$i]['s_id']."\">".$state[$i]['state_name']."</option>";
                                }
                                ?>
                          @endif
                          </select>
                         </div>
                         </div>
                         <div class="form-group">
                         <label for="district" class="col-md-3 control-label">District</label>
                         <div class="col-md-7">
                            <select name="district" class="form-control" state="district" style="margin-left: 0%;" required="">
                              <option value="">---Select District---</option>
                            </select>
                          </div>
                        </div>


                      <div class="form-group">
                        <label class="control-label col-md-3" name="city" for="city">City</label>
                        <div class="col-md-7">
                          <select name="city" class="form-control" state="city" required="">
                              <option value="">---Select City---</option>
                            </select>
                        </div>
                        </div>


                        <div class="form-group">
                        <label class="control-label col-md-3" name="area" for="area">Area</label>
                        <div class="col-md-7">
                          <select name="area" class="form-control" state="area" required="">
                              <option value="">---Select Area---</option>
                            </select>
                        </div>
                        </div>

                        <div class="form-group">
                        <label class="control-label col-md-3" name="pincode" for="pincode">Pincode</label>
                        <div class="col-md-7">
                             <input type="text" class="form-control" name="pincode" id="pincode" required>
                        </div>
                        </div>

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

        <script>
     $(document).ready(function() {
        $('select[name="state"]').on('change', function() {
          $('select[name="location"]').empty();
          $('select[name="location"]').append('<option value="">--Select Location--</option>');
          $('select[name="district"]').empty();
          $('select[name="district"]').append('<option value="">--Select District--</option>');
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: '/district/ajax/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        for(var i=0;i<data.length;i++){
                          $('select[name="district"]').append('<option value="'+ data[i]['d_id'] +'">'+ data[i]['district_name'] +'</option>');
                        }
                    }
                });
            }else{
                $('select[name="district"]').empty();
            }
        });

        $('select[name="district"]').on('change', function() {
          $('select[name="city"]').empty();
          $('select[name="city"]').append('<option value="">--Select City--</option>');
            var districtID = $(this).val();
            if(districtID) {
                $.ajax({
                    url: '/city/ajax/'+districtID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        for(var i=0;i<data.length;i++){
                          $('select[name="city"]').append('<option value="'+ data[i]['c_id'] +'">'+ data[i]['city_name'] +'</option>');
                        }
                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
        });

        $('select[name="city"]').on('change', function() {
          $('select[name="area"]').empty();
          $('select[name="area"]').append('<option value="">--Select Area--</option>');
            var cityID = $(this).val();
            if(cityID) {
                $.ajax({
                    url: '/area/ajax/'+cityID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        for(var i=0;i<data.length;i++){
                          $('select[name="area"]').append('<option value="'+ data[i]['a_id'] +'">'+ data[i]['area_name'] +'</option>');
                        }
                    }
                });
            }else{
                $('select[name="area"]').empty();
            }
        });
      });
    </script>
	@endsection