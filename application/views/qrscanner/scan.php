<body>
	<div class="container text-center">
		<h1>SCAN QR CODE</h1>
		<video id="preview" width="300"></video>
		<div>
			<form action="<?php echo base_url()?>home/verifyQrcode" method="POST" class="form-horizontal">
				<div class="form-group">
					<input type="hidden" name="text" id="text" readonyy="" placeholder="scan qrcode" class="form-control">
				</div>
				
				<div class="form-group">
					<input type="number" name="cash" >
				</div>
				
			</form>
			
		</div>
	</div>

<script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          alert('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });

      scanner.addListener('scan', function (c) {
        document.getElementById("text").value = c;
        document.forms[0].submit()
      	
      });
    </script>