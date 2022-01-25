<?php

	class ForgotPassword extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model("Register_model");
			$this->load->model("LoginModel");	
			$this->load->model("Forgot_model");
		}

		public function index(){
			$data["title"] = "Forgot Password";
			$this->load->view("templates/header.php");
		    $this->load->view("forgot/index",$data);
		    $this->load->view("templates/footer.php");
		}

		public function ForgotValidation(){
			
			$this->form_validation->set_rules('email','Email Address','required|trim|valid_email');
			if($this->form_validation->run() == FALSE){
				$data["title"] = "Forgot Password";
				$data["error"] = validation_errors();
				$this->load->view("templates/header.php");
			    $this->load->view("forgot/index",$data);
			    $this->load->view("templates/footer.php");
			}
			else 
			{
				$email = $this->input->post('email');
				// check kung verified
				if($this->LoginModel->checkUserVerify(null,$email)){
					  $passcode = random_int(0,999999);  // Generate hash value
                	  $passcode = str_pad($passcode, 6, 0, STR_PAD_LEFT);
                	  $codeNeedVerify = md5($passcode);
                	$this->Forgot_model->insert_code($codeNeedVerify,$email);
                	$data["userInfo"] = $this->LoginModel->getUser(null,$email);
					$subject = "Recover your account";

					 $config = array(
				     'protocol'  => 'smtp',
				     'smtp_host' => 'smtpout.secureserver.net',
				     'smtp_port' => 80,
				     'smtp_user'  => 'thinklikblog@gmail.com', 
				     'smtp_pass'  => '09123456think!', 
				     'mailtype'  => 'html',
				     'charset'    => 'iso-8859-1',
				     'wordwrap'   => TRUE,
				     'charset' => 'utf-8',
		            'newline' => "\r\n",
		            'mailtype' => 'html',
		            'validation' => TRUE
				    );
					   $emailData = array(
			            'header' => 'Recover your account',
			            'username' => $data["userInfo"]['name'],
			            'body' => 'This is the code '.$passcode,
			            );
				    $this->load->library('email',$config);
				    $this->session->set_userdata(array("Forgot_email" => $email));
      				$this->email->set_mailtype("html");
				    $this->email->from("thinklikblog@gmail.com");
				    $this->email->to($data["userInfo"]['email']); 
				    $this->email->subject($subject);
				    $this->email->message($this->load->view("forgot/forgotmsg",$emailData,true)); 
				    if($this->email->send()){
				    	redirect('ForgotPassword/notice');
				    }

				}else{
					$data["error"] = "Your account is not found";
					$data["title"] = "Forgot Password";
					$this->load->view("templates/header.php");
				    $this->load->view("forgot/index",$data);
				    $this->load->view("templates/footer.php");
				}
			}

		}
		public function notice(){
			$data['email'] = $this->session->userdata("Forgot_email");
			$data["title"] = "FIND YOUR ACCOUNT";
			$this->load->view("templates/header.php");
			$this->load->view("forgot/notice",$data);
			$this->load->view("templates/footer.php");
		}

		public function codeValidation(){
			$this->form_validation->set_rules("code","Code","required|max_length[6]");
			$data['email'] = $this->session->userdata("Forgot_email");
			if($this->form_validation->run() == False){
				$data["title"] = "FIND YOUR ACCOUNT";
				$this->load->view("templates/header.php");
				$this->load->view("forgot/notice",$data);
				$this->load->view("templates/footer.php");
			}
			else{
				$email = $this->input->post("email");
				$code = $this->input->post("code");

				if($this->Forgot_model->checkCode($email,md5($code))){
					// kung same 
					$data["title"] = "Reset Password";
					$this->load->view("templates/header.php");
					$this->load->view("forgot/resetpass",$data);
					$this->load->view("templates/footer.php");	
				}else{

					$data["title"] = "FIND YOUR ACCOUNT";
					$data["error"] = "The code is not correct";
					$this->load->view("templates/header.php");
					$this->load->view("forgot/notice",$data);
					$this->load->view("templates/footer.php");
				}

			}
		}
		public function resetPass(){
			$this->form_validation->set_rules("newCode","New pincode","required|max_length[6]");
			$this->form_validation->set_rules("confirmCode","Confirm pincode","required|max_length[6]|matches[newCode]");
			$data['email'] = $this->session->userdata("Forgot_email");
			if($this->form_validation->run() == False){
				$data["error"] = validation_errors();
				$data["title"] = "Reset Password";
				$this->load->view("templates/header.php");
				$this->load->view("forgot/resetpass",$data);
				$this->load->view("templates/footer.php");	
			}
			else{
				$password = $this->input->post("newCode");
				$this->Forgot_model->updatePassword($data['email'],md5($password));
				$this->Forgot_model->deleteCode($data['email']);
				$this->session->unset_userdata('Forgot_email');
				$this->session->set_flashdata('newpass','Reseting password successfully');
				redirect('login/login_form');
			}
		}

	}


?>