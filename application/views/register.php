<body>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading"><h1>Register</h1></div>
			<div class="panel-body">
				<form method="post" action="<?php echo base_url();?>register/validation">
					<div class="form-group">
						<label>Enter your name :</label>
						<input type="text" name="user_name" class="form-control" value="<?php echo set_value('user_name');?>">
						<span class="text-danger"><?php echo form_error("user_name");?></span>
					</div>
					<div class="form-group">
						<label>Enter your valid email address : </label>
						<input type="text" name="user_email" class="form-control" value="<?php echo set_value("user_email");?>">
						<span class="text-danger"><?php echo form_error("user_email");?></span>
					</div>
					<div class="form-group">
						<label>Enter the password</label>
						<input type="password" name="user_password" class="form-control" value="<?php echo set_value("user_password")?>">
						<span class="text-danger"><?php echo form_error("user_password");?></span>
					</div>
					<div class="form-group">
						<input type="submit" name="register" value="Register" class="btn btn-info">
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			
			<div class="col-md-12 mt-2">
				<p>You have existing account?</p>
				<a href="<?php echo base_url()?>login/login_form" class="btn btn-success">Login</a>
			</div>

		</div>
	</div>
	