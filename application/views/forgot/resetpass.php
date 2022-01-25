<body class="container">
	<h1><?php echo $title?></h1>
	<p><?php echo isset($error)?$error:"";?></p>
	<form action="<?php echo base_url()?>ForgotPassword/resetPass" method="POST">
		<input type="hidden" name="email" value="<?php echo $email?>">
		<div class="form-group">
			<label>Enter the new pincode</label>
			<input type="password" maxlength="6" name="newCode">
		</div>
		<div class="form-group">
			<label>Enter the confirm pincode</label>
			<input type="password" maxlength="6" name="confirmCode">
		</div>
		<button type="submit" class="btn btn btn-success">Send Code</button>
		
	</form>
