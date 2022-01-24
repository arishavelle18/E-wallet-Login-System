<?php

	class Otp extends CI_Controller{

		public function __construct(){
			parent::__construct();
			
		}
		public function view(){
			$this->load->view("templates/header");
			$this->load->view("otp/sendmsg");
			$this->load->view("templates/footer");	
		}
	}



?>