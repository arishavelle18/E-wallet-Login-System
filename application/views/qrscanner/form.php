<body>
	<div class="container">
		<h1><?php echo $title?></h1>
		<div>

			<form action="" method="POST">
				
				<div class="form-group">
					<p><?php echo (isset($errors)|| !empty($errors))?$errors : ""?></p>
				</div>
				
				<div class="form-group">
					<label>Enter the full name: </label>
					<input type="text" name="name">
				</div>
				<div class="form-group">
					<label>Enter the cash you want to transfer: </label>
					<input type="number" name="cash">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Confirm</button>
				</div>
			</form>
		</div>
	</div>

</body>