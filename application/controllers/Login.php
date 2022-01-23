<?php

	class Login extends CI_Controller {
		private $data = array();

		public function __construct(){
			parent::__construct();
			$this->load->model("LoginModel");

		}

		public function login_form(){
			$this->data["title"] ="Login"; 
			$this->load->view("templates/header.php");
	        $this->load->view("login",$this->data);
	       	$this->load->view("templates/footer.php");
		}
		public function checkUser(){
			$this->form_validation->set_rules("username","Username","required");
			$this->form_validation->set_rules("password","Password","required");
			if($this->form_validation->run() == FALSE){
				$this->data["title"] ="Login"; 
				$this->data['errors'] = validation_errors();
				$this->load->view("templates/header.php");
		        $this->load->view("login",$this->data);
		       	$this->load->view("templates/footer.php");
			}
			else{
				$username = $this->input->post("username");
				$password = $this->input->post("password");
				$userInfo = array(
					"name" => $username,
					"password" => md5($password)
				);
				// para iwas sa mga hacker 
				$userInfo = $this->security->xss_clean($userInfo);
				if($this->LoginModel->checkUserInfo($userInfo)){
					// check muna kung verify
					if($this->LoginModel->checkUserVerify($username)){
						// kung verify
						$this->data['errors'] = "";
					}
					else{
						// kung hindi
						$this->data['errors'] = "Your account is not verified"; 

					}
				}else{
					// kung hindi naman compatible sa db 
						$this->data['errors'] = "Your account is not found"; 
				}
				if(empty($this->data["errors"])){
						$userInfo = $this->LoginModel->getUser($username);
						$user_data = array(
			              'id' => $userInfo["id"],
			              'name' => $userInfo["name"],
			              'email' => $userInfo["email"],
			              'success' => "You are now logged in",
			              'logged_in'=> true
			            );
			            
            			$this->session->set_userdata($user_data);
            			
						$this->data["title"] ="Home"; 
						$this->load->view("templates/header.php");
				        $this->load->view("home",$this->data);
				       	$this->load->view("templates/footer.php");
				}else{
					$this->data["title"] ="Login"; 
					$this->load->view("templates/header.php");
				    $this->load->view("login",$this->data);
				    $this->load->view("templates/footer.php");
				}
			}
			
		}

	}
?>