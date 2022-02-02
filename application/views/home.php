<body>
	<div class="container">
		<?php
				if($this->session->flashdata('message')){
					echo '<div class="alert alert-success">'.$this->session->flashdata("message").'</div>';
					$this->session->unset_userdata('message');
				}elseif($this->session->flashdata('newpass')){
					echo '<div class="alert alert-success">'.$this->session->flashdata("newpass").'</div>';
					$this->session->unset_userdata('newpass');
				}
				?>
		<h1><?php echo $title;?></h1>
		<div class="cash">
			<h3>Cash : ₱ <?php echo $user["cash"]?>.00</h2>
		</div>
		<div class="button">
			<a class="btn btn-primary" href="<?php echo base_url();?>Home/sendValidation" >Transfer Money</a>
			<a href="<?php echo base_url()?>Home/viewQrCode" class="btn btn-danger">View QR Code</a>
		</div>

		<br>
		<a href="<?php echo base_url();?>logout/signout" class="btn btn-danger">Logout</a>
	</div>
