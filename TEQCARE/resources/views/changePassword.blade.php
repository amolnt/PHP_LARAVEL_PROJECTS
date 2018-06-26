@extends('master.master')
	@section('pageContent')

	<div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>change password</h2>
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
				  <form method="post" action="{{action('CustomController@changePassword')}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
             	<input type="hidden" name="_token" value="{{csrf_token()}}">

		                  <div class="form-group">
		                    <label class="control-label col-md-3" for="old-Password">old password</label>
		                    <div class="col-md-7">
		                      <input type="password" rows="5" id="oldPassword" name="oldPassword" class="form-control col-md-7 col-xs-12" required>
		                    </div>
		                  </div>

		                  <div class="form-group">
		                    <label class="control-label col-md-3" for="new-passeord">new password</label>
		                    <div class="col-md-7">
		                      <input type="password" rows="5" id="newPassword" name="newPassword" class="form-control col-md-7 col-xs-12" required>
		                    </div>
		                  </div>
		                  
		                  <div class="form-group">
		                    <label class="control-label col-md-3" for="confirmPassword">confirm password</label>
		                    <div class="col-md-7">
		                      <input type="password" rows="5" id="confirmPassword" name="confirmPassword" class="form-control col-md-7 col-xs-12" required>
		                    </div>
		                    <h4><span id="message"></span></h4>
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
	<script>
		$('#newPassword, #confirmPassword').on('keyup', function () {
  		if ($('#newPassword').val() == $('#confirmPassword').val()) {
    		$('#message').html('Matching').css('color', 'green');
 		 } else 
    		$('#message').html('Not Matching').css('color', 'red');
  		});
	</script>
	@endsection