<!---Author:Amol Tribhuwan********************************-->
<html>
<head>
	<style>
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 20px;
  padding: 5px;
  width: 25%;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
</head>
 <body>
 	<form  role="form" action="{{action('ResetPasswordController@showResetForm',Session::get('token'))}}" method="post">
 {{ csrf_field()}}
 	<h4> Hello </h4>
  <p>You are receiving this mail becaus we received a password reset request for your account</p>
  <br>
 	<div align="left">
     	<button class="button" style="vertical-align:middle"><span>Reset Password </span></button>
     </div>
     <p>If u did not request a password reset, no further action is required</p>
     <br>
     <p>Thanks & Regards</p>
     <img src="{{ $message->embed(public_path() . '/assets/images/logo.gif') }}" width="160" alt="TEQ CARE">
	</form>
</body>
</html>