<body>
	<h1><?php echo $title;?></h1>
	<p><?php echo isset($error)? $error : "" ;?></p>
	<form action="<?php echo base_url()?>forgotpassword/ForgotValidation" method="POST">
		<h2>Find your account</h2>
		<div class="form-group">
			<input type="text" name="email">
		</div>
		<button type="submit">Send Verification</button>
	</form>