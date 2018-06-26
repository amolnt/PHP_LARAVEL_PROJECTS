<!---Author:Amol Tribhuwan********************************-->
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h2> Thank you for the registration! </h2>
<h3> Your Username and password below</h3>
<br>

<p> Username:@if(isset($username))
		<?php echo $username; ?>
	@endif
	<br>
	Password: @if(isset($password))
				<?php echo $password; ?>  
			@endif</p>
<br>
<p>Thanks & Regards</p>
<img src="{{ $message->embed(public_path() . '/assets/images/logo.gif') }}" width="160" alt="TEQ CARE">
</body>
</html>