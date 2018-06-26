@extends('master.loginMaster')
@section('content')
	 <div id="login-page" style="padding-top: 8%;padding-right: 3%">
	     <form class="form-login pull-right" action="{{action('UserLoginController@signup')}}" method="post">
		      {{ csrf_field() }}
		        <h2 class="form-login-heading">sign up now</h2>
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

		            <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
		            <br>
		            <input type="text"  class="form-control" name="mobileNo" placeholder="Mobile Number" required>
		            <label class="checkbox">
		                <span class="pull-right">
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN UP</button>
		            <hr>
		      
		            <div class="registration">
		                Already have an account yet?<br/>
		                <a class="" href="{{URL::to('/')}}">
		                    Login
		                </a>
		            </div>
		        </div>
		
		      </form>	  	
	  
	  </div>
@endsection