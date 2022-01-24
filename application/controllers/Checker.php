<?php

	class Checker extends CI_Controller {

		public function __construct(){
			parent::__construct();

			$this->load->model("Register_model");
			
		}

		public function timecheck(){
			if($this->input->is_ajax_request()){
				if($this->Register_model->clear_unconfirmed_post()){;
					$data = array("response" => "Success");
				}else{
					$data = array("response" => "Failed");	
				}
			}else{
				$data = array("response" => "Failed");
			}
		echo json_encode($data);
		}
	}
?>