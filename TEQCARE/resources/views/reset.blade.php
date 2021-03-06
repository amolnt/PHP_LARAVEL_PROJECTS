@extends('master.loginMaster')
@section('content')
	<div id="login-page" style="padding-top: 8%;padding-right: 3%">
      <form class="form-login pull-right"  action="{{ action('ResetPasswordController@reset') }}" method="post">
		     	 {{ csrf_field() }}
		        <h2 class="form-login-heading">reset password</h2>
		        @if(Session::has('succMsg'))
                  <div class="alert alert-success alert-dismissible fade in col-md-12" role="alert" id="succMsg">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>
                        {{Session::get('succMsg') }}                                  
                    </strong>
                  </div>
                  @endif
                  @if(Session::has('errorMsg'))
                  <div class="alert alert-danger alert-dismissible fade in col-md-12" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>
                    {{ Session::get('errorMsg')}}
                    </strong>
                  </div>
                  @endif
		        <div class="login-wrap" style="width: 240px;">
		            <input type="email" class="form-control" name="email" placeholder="Email" autofocus required>
		            <br>
                <input type="password"  id="newPassword" class="form-control" name="password" placeholder="Password" onkeyup="check()" required><br>
                <input type="password" id="confirmPassword" class="form-control" name="confirm_password" placeholder="Confirm Password" onkeyup="check()" required><br>
                <h4><span id="message"></span></h4>  
		            <label class="checkbox">
		                <span class="pull-right">
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> RESET</button>
		            <hr>
		        </div>
		        <div class="registration">
                    Go to your account<br/>
                    <a class="" href="{{URL::to('/')}}">
                        Login
                    </a>
                </div>
		    </form>
	
	</div>

@endsection