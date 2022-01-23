<body>
	<div class="container">
		<h1><?php echo $title;?></h1>
		<?php
				if($this->session->flashdata('message')){
					echo '<div class="alert alert-success">'.$this->session->flashdata("message").'</div>';
					$this->session->unset_userdata('message');
				}
				?>
		<div class="row">
			<div class="col-md-12">
				<form action="<?php echo base_url()?>login/checkUser" method="POST">
					<?php if(isset($errors)|| !empty($errors)) :?>
						<div class="form-group">
							<p><?php echo $errors; ?></p>
						</div>
					<?php endif;?>
					<div class="form-group">
						<label>Username :</label>
						<input type="text" name="username" class="form-control">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn btn-success form-control">
					</div>
				</form>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12 mt-2">
				<a href="#" class="btn btn-info">Forgot Password</a>
			</div>
			<div class="col-md-12 mt-2">
				<a href="<?php echo base_url()?>register/index" class="btn btn-success">Register</a>
			</div>

		</div>