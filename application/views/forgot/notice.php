<body class="container">
	<h1><?php echo $title?></h1>
	<p>Please check your email and enter 6 digit code</p>
	<p><?php echo isset($error)?$error:"";?></p>
	<form action="<?php echo base_url()?>ForgotPassword/codeValidation" method="POST">
		<input type="hidden" name="email" value="<?php echo $email?>">
		<div class="form-group">
			<input type="text" maxlength="6" name="code">
		</div>
		<button type="submit" class="btn btn btn-success">Send Code</button>
		
	</form>
