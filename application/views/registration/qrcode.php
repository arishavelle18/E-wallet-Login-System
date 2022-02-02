<body>
	
	<div class="container mx-auto" > 

		<h2 class="text-center m-5">Scan this code to verify your login</h2>
		<div class="form-group text-center">
			<?php echo (isset($errors)|| !empty($errors)) ? $errors : ""?>
		</div>
		<img class="img-fluid mx-auto d-block p-5 bg-secondary rounded mb-3" src="<?php echo $links?>">
		
		<form class="row row-cols-lg-auto g-3 align-items-center" action="numberValidation" method="POST">
		
			<div class="col-8 mx-auto">
				<div class="input-group mb-3">
				<div class="input-group-text">QR CODE:</div>
				<input type="text" class="form-control" pattern="\d*" name="Token" maxlength="6" id="inlineFormInputGroupUsername" placeholder="(Ex: 203943)">
				</div>
			</div>

			<div class="col-8 mx-auto">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
				</form>
	</div>
	