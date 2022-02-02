<?php
require FCPATH."vendor/autoload.php";
date_default_timezone_set("Asia/Manila");
	class Register extends CI_Controller {

		public function __construct(){
			parent::__construct();

			$this->load->model("Register_model");
			
		}
		public function index(){
			// pag nakalogin na bawal makapunta sa login and register
			if($this->session->userdata("logged_in")){
				redirect("home/homepage");
			}
					$data["title"] = "Register";
					$this->load->view("templates/header.php");
		        	$this->load->view("registration/index",$data);
		        	$this->load->view("templates/footer.php");
		      		
		}

		public function validation(){
			// pag nakalogin na bawal makapunta sa login and register
			if($this->session->userdata("logged_in")){
				redirect("home/homepage");
			}

			// check the form
			$this->form_validation->set_rules('user_name','Name','required|trim|is_unique[codeigniter_register.name]');
			$this->form_validation->set_rules('user_email','Email Address','required|trim|valid_email|is_unique[codeigniter_register.email]');
			$this->form_validation->set_rules('user_password','Password','required');
			$this->form_validation->set_rules('number','Contact Number','required');
			if($this->form_validation->run() == FALSE){

				 $data['title'] = 'Registration';
			 	 $this->load->view("templates/header.php");
	        	 $this->load->view("registration/index.php",$data);
	       		 $this->load->view("templates/footer.php");

			}else{
				$username = $this->input->post("user_name");
				$useremail = $this->input->post("user_email");
				$userpassword = $this->input->post("user_password");
				$contact = $this->input->post("number");
				$verification_key = md5(rand());
				$encrypted_password = md5($userpassword);
				
				$data = array(
					"name" => $username,
					"email" => $useremail,
					"password" => $encrypted_password,
					"verification_key" => $verification_key,
					"contact" => md5($contact),
					"created_at" => date('Y-m-d H:i:s'),
					"is_email_verified" => 0
				);
				$data = $this->security->xss_clean($data);
				$id = $this->register_model->insert($data);
				
				if($id > 0){
					 $subject = "Please verify email for login";
					
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
			            'header' => 'Verify your account',
			            'username' => $username,
			            'body' => 'Verify',
			            'button' => 'Verify',
			            'link' => base_url()."Register/verify/".$username."/".$verification_key
			            );
				    $this->load->library('email',$config);
				  
      				$this->email->set_mailtype("html");
				    $this->email->from("thinklikblog@gmail.com");
				    $this->email->to($useremail); 
				    $this->email->subject($subject);
				    $this->email->message($this->load->view("emailFormat",$emailData,true)); 
				    if($this->email->send()){
				    	$this->session->set_flashdata('message','Check in your email verification mail');
				    	redirect('login/login_form');
				    }
				}
			}

		}
		public function verify(){
			// pag nakalogin na bawal makapunta sa login and register
			if($this->session->userdata("logged_in")){
				redirect("home/homepage");
			}

			 //Get data from URL
	        $username = $this->uri->segment(3); //get email from url
	        $code = $this->uri->segment(4); //get code from url
	        $data['is_email_verified'] = 1;

	        $query= $this->Register_model->activate_acc($username, $code, $data); //check in the database
	        
	        // If true, inform the user in verify.php
	        if ($query){
	        $this->load->view("templates/header.php");
	        $this->load->view("verify");
	        $this->load->view("templates/footer.php");
	        
	        }
	        else{
	            echo "Invalid URL";
	        }
		}
	}




?>