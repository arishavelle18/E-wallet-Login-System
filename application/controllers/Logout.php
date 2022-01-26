<?php
date_default_timezone_set("Asia/Manila");
	class Logout extends CI_Controller {
		
		public function signout(){
			if(is_null($this->session->userdata("logged_in"))){
				redirect("login/login_form");
			}
			$subject = "Time you out";
					
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
					            'header' => 'Time you log out',
					            'username' => $this->session->userdata("name"),
					            'body' => 'You are logout '.date("F j, Y g:i:a"),
					            );
						    $this->load->library('email',$config);
						  
		      				$this->email->set_mailtype("html");
						    $this->email->from("thinklikblog@gmail.com");
						    $this->email->to($this->session->userdata("email")); 
						    $this->email->subject($subject);
						    $this->email->message($this->load->view("update/logoutUpdate",$emailData,true)); 
						    $this->email->send();

			$this->session->unset_userdata('id');
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('success');
			$this->session->unset_userdata('logged_in');
			redirect("login/login_form");
		}
	}
?>