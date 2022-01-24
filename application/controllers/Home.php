<?php

	class Home extends CI_Controller {
		
		public function homepage(){
			$data["title"] ="Home";
			$this->load->view("templates/header");
			$this->load->view("home",$data);
			$this->load->view("templates/footer");
		}
	}
?>