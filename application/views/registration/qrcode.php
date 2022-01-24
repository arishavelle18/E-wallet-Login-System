<body>
	<?php echo validation_errors();?>
	<form action="numberValidation" method="POST">
		<img src="<?php echo $links?>">
		<div class="form-group">
			<label>Code(Ex: 203943) :</label>
			<input type="text" pattern="\d*" name="Token" maxlength="6">
		</div>
		<button type="submit">Submit</button>
	</form>