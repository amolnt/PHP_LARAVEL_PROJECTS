@extends('master.loginMaster')
@section('content')
<div id="login-page" style="padding-top: 8%;padding-right: 3%">
       <form id="loginForm" class="form-login pull-right" action="{{action('UserLoginController@login')}}" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
            <h2 class="form-login-heading">sign in now</h2>
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
                <input type="text" name="username" class="form-control" placeholder="User Name" required autofocus>
                <br>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <label class="checkbox">
                    <span class="pull-right">
                        <a onClick="hide()" style="cursor: pointer;" data-target="#forgot" data-toggle="collapse"> Forgot Password?</a>
    
                    </span>
                </label>
                <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
                <hr>
                
                <div class="registration">
                    Don't have an account yet?<br/>
                    <a class="" href="{{URL::to('/register')}}">
                        Create an account
                    </a>
                </div>
            </div>
            </form>

                    <div id="forgot" class="collapse container col-md-12">
                      <form class="form-login pull-right" action="{{action('ResetPasswordController@sendLink')}}" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <h2 class="form-login-heading">Forgot Password</h2>

                          <div>
                              <p style="font: bold;color: black;">Enter your e-mail address below to reset your password.</p>
                              <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix" required>
                          </div>
                          <br>
                          <div>
                              <button id="cancel" onClick="show()" data-toggle="collapse" data-target="#forgot" class="btn btn-default" type="button">Cancel</button>
                              <input type="submit" class="btn btn-theme" value="Send">
                            </div>
                        </form>
                          </div>
                      </div>
                     

        <script type="text/javascript">
              function show(){
                $('#loginForm').show();
              }
              function hide(){
                $('#loginForm').hide();
              }
        </script>
  @endsection