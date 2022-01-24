<?php

	class Logout extends CI_Controller {
		
		public function signout(){
		
			$this->session->unset_userdata('id');
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('success');
			$this->session->unset_userdata('logged_in');
			redirect("login/login_form");
		}
	}
?>