<?php
require FCPATH."vendor/autoload.php";
date_default_timezone_set("Asia/Manila");
	class Login extends CI_Controller {
		private $data = array();

		public function __construct(){
			parent::__construct();
			$this->load->model("LoginModel");

		}

		public function login_form(){
			// pag nakalogin na bawal makapunta sa login and register
			if($this->session->userdata("logged_in")){
				redirect("home/homepage");
			}
			$this->data["title"] ="Login"; 
			$this->load->view("templates/header.php");
	        $this->load->view("login",$this->data);
	       	$this->load->view("templates/footer.php");
		}
		public function index(){
			// pag nakalogin na bawal makapunta sa login and register
			if(is_null($this->session->userdata("username"))){
				redirect("login/login_form");
			}
					$secret = 'XVQ2UIGO75XRUKJO';
					$data['links']= \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('testting', $secret,"e-wallet");
					$this->load->view("templates/header.php");
		        	$this->load->view("registration/qrcode",$data);
		        	$this->load->view("templates/footer.php");
		      		
		}
		public function numberValidation(){		
			if(is_null($this->session->userdata("username"))){
				redirect("login/login_form");
			}
			// pag nakalogin na bawal makapunta sa login and register
			
				$this->form_validation->set_rules('Token',"Contact Number","required|max_length[6]");
				if($this->form_validation->run() == False){
					$data["errors"] = validation_errors();
					$secret = 'XVQ2UIGO75XRUKJO';
					$data['links']= \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('testting', $secret,"e-wallet");
					$this->load->view("templates/header.php");
		        	$this->load->view("registration/qrcode",$data);
		        	$this->load->view("templates/footer.php");
				}
				else{
					$secret = 'XVQ2UIGO75XRUKJO';
					$g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
					$code = $this->input->post("Token");
					if($g->checkCode($secret,$code)){
							$username = $this->session->userdata("username");
							$userInfo = $this->LoginModel->getUser($username);
							$user_data = array(
				              'id' => $userInfo["id"],
				              'name' => $userInfo["name"],
				              'email' => $userInfo["email"],
				              'success' => "You are now logged in",
				              'logged_in'=> true
				            );
							$subject = "Time in";
					
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
					            'header' => 'Time you log in',
					            'username' => $username,
					            'body' => 'You are login '.date("F j, Y g:i:a"),
					            );
						    $this->load->library('email',$config);
						  
		      				$this->email->set_mailtype("html");
						    $this->email->from("thinklikblog@gmail.com");
						    $this->email->to($userInfo["email"]); 
						    $this->email->subject($subject);
						    $this->email->message($this->load->view("update/loginUpdate",$emailData,true)); 
						    $this->email->send();

				            $this->session->unset_userdata('username');
	            			$this->session->set_userdata($user_data);
							$data["title"] = "Home";
							$this->load->view("templates/header.php");
				        	$this->load->view("home",$data);
				        	$this->load->view("templates/footer.php");
					}else{
						// kapag hindi
							$data["errors"] = "The code is incorrect";
							$secret = 'XVQ2UIGO75XRUKJO';
							$data['links']= \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('testting', $secret,"e-wallet");
							$this->load->view("templates/header.php");
				        	$this->load->view("registration/qrcode",$data);
				        	$this->load->view("templates/footer.php");
					}
				}
		}

		public function checkUser(){
			// pag nakalogin na bawal makapunta sa login and register
			if($this->session->userdata("logged_in")){
				redirect("home/homepage");
			}	

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
						
            			$this->session->set_userdata('username', $username);
						// $this->data["title"] ="Home"; 
						// $this->load->view("templates/header.php");
				  //       $this->load->view("home",$this->data);
				  //      	$this->load->view("templates/footer.php");
				       	redirect("login/index");
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