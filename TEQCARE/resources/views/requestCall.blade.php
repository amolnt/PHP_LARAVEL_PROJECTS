@extends('master.master')
	@section('pageContent')
	<div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Request A Service Call</h2>
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
				  <form method="post" action="{{action('CustomController@addRequest')}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
             <input type="hidden" name="_token" value="{{csrf_token()}}">
						  <div class="form-group">
		                    <label class="control-label col-md-3" for="first-name">Area of Equipment<span class="required">*</span>
		                    </label>
		                    <div class="col-md-7">
		                      <select id="area" name="area" class="form-control" required>
		                      @if(isset($area))
		                      	<?php
                                echo "<option value=\"\">--Select Area--</option>";
                                for ($i=0; $i <count($area) ; $i++) { 
                                  echo "<option value=\"".$area[$i]['a_id']."\">".$area[$i]['area_name']."</option>";
                                }
                                ?>
		                      @endif
                          </select>
		                     </div>
		                  </div>
						   <div class="form-group">
		                    <label class="control-label col-md-3" for="first-name">Select Equipment<span class="required">*</span>1
		                    </label>
		                    <div class="col-md-7">
		                      <select name="equipments" class="form-control" required>
		                          </select>
		                     </div>
		                  </div>
		                  <div class="form-group">
		                    <label class="control-label col-md-3" name="discription" for="first-name">Technical Specification</label>
		                    <div class="col-md-7">
		                      <textarea rows="5" id="discription" name="discription" class="form-control col-md-7 col-xs-12" disabled="">
		                      </textarea>
		                    </div>
		                  </div>
		                  <div class="form-group">
		                    <label class="control-label col-md-3" for="first-name">Problems</label>
		                    <div class="col-md-7">
		                      <textarea rows="5" id="equip-problem" name="problem" class="form-control col-md-7 col-xs-12" required=""></textarea>
		                    </div>
		                  </div>
		                  <div class="form-group">
		                    <label class="control-label col-md-3" for="first-name">Problem Snapshot</label>
		                   <div class="col-md-3">
								        <input type="file" name="file" class="form-control" accept=".jpg" id="equip-problem-snap" />
                        <label class="alert-info">(max size:200kb)</label>
		                  </div>
                      <div class="col-md-2" align="left">
                      <label  style="margin-top: 6%;color:red;"> 
                                                  @if(Session::has('message'))
                                                     
                                                      {{Session::get('message')}}
                                                    
                                                   @endif</label>
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
        $('select[name="area"]').on('change', function() {
            $('select[name="equipments"]').empty();
            var locationId = $(this).val();

            if(locationId) {
                $.ajax({
                    url: '/equipments/ajax/'+locationId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="equipments"]').append('<option>--Select--</option>');
                        for(var i=0;i<data.length;i++){
                            $('select[name="equipments"]').append('<option value="'+ data[i]['equ_id'] +'">'+ data[i]['equ_name'] +'</option>');
                        }
                    }
                });
            }else{
                $('select[name="equipments"]').empty();
            }
        });
        $('select[name="equipments"]').on('change', function() {

            var equId = $(this).val();
            if(equId) {
                $.ajax({
                    url: '/equDiscription/ajax/'+equId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      $('#discription').val(data[0]['equ_discription']);
                    }
                });
            }else{
              $('#discription').val("");
            }
        });
    });
    </script>
	@endsection
