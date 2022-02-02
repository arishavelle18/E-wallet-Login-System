<?php

	class Home extends CI_Controller {
		
		public function __construct(){
			parent::__construct();

			$this->load->model("Register_model");
			$this->load->model("LoginModel");
			$this->load->model("Qr_model");
			$this->load->model("Money_model");
			
		}

		public function homepage(){
			if(is_null($this->session->userdata("email"))){
				redirect("login/login_form");
			}
			$data["user"] = $this->LoginModel->getUser(null,$this->session->userdata("email"));
			$data["title"] ="Home";
			$this->load->view("templates/header");
			$this->load->view("home",$data);
			$this->load->view("templates/footer");
		}
		
		public function sendViaQrCode(){
			if(is_null($this->session->userdata("email"))){
				redirect("login/login_form");
			}
			$data["title"] ="Scan QrCode";
			$this->load->view("templates/header");
			$this->load->view("qrscanner/scan",$data);
			$this->load->view("templates/footer");


		}
		// view Qr Code
		public function viewQrCode(){
			if(is_null($this->session->userdata("email"))){
				redirect("login/login_form");
			}
			$data["user"] = $this->LoginModel->getUser(null,$this->session->userdata("email"));
			$data["title"] ="Home";
			$this->load->view("templates/header");
			$this->load->view("qrscanner/view",$data);
			$this->load->view("templates/footer");
		}
		public function send(){
			if(is_null($this->session->userdata("email"))){
				redirect("login/login_form");
			}
			$data["title"] ="Transfer Money";
			$this->load->view("templates/header");
			$this->load->view("qrscanner/form",$data);
			$this->load->view("templates/footer");
		}
		public function sendValidation(){
			if(is_null($this->session->userdata("email"))){
				redirect("login/login_form");
			}

			$this->form_validation->set_rules("name","Full name","required");
			$this->form_validation->set_rules("cash","Cash","required");

			if($this->form_validation->run() == False) {
				$data["errors"] = validation_errors();
				$data["title"] ="Transfer Money";
				$this->load->view("templates/header");
				$this->load->view("qrscanner/form",$data);
				$this->load->view("templates/footer");
			}
			else{
				$name = $this->input->post("name");
				$cash = $this->input->post("cash");
				$data_session = array(
					"fullName" => $name,
					"cash" => $cash
				);
				$this->session->set_userdata($data_session);

				if($this->LoginModel->getUser($name)){
					// kapag merong contact na ganon 
					
					if($this->Money_model->checkBalance($this->session->userdata("name"),$cash)){
						redirect("Home/sendViaQrCode");
					}else{
						$data["errors"] = "Insufficient Fund";
						$data["title"] ="Transfer Money";
						$this->load->view("templates/header");
						$this->load->view("qrscanner/form",$data);
						$this->load->view("templates/footer");
					}
					
				}else{
					$data["errors"] = "Account Not Found";
					$data["title"] ="Transfer Money";
					$this->load->view("templates/header");
					$this->load->view("qrscanner/form",$data);
					$this->load->view("templates/footer");
				}
		
			}

		}
		public function verifyQrcode(){
			$code = $this->input->post("text");
			
			$own =$this->LoginModel->getUser($this->session->userdata("name"));

			if($this->Money_model->checkContact($code,$own["contact"])){
				// kapag hindi yung sarili mo yung bibigyan mo ng pera
				$data = array(
				"user_id" => $this->session->userdata("id"),
				"action" => "transfer money",
				"reciever" => $this->session->userdata("fullName"),
				"cash" =>$this->session->userdata("cash")
				);
				$this->Qr_model->insert($data);
				$cash = $this->session->userdata("cash");
				$receiverName = $this->session->userdata("fullName");
				$senderName = $this->session->userdata("name");
				$this->Money_model->transferCash($cash,$senderName,$receiverName);
				$this->session->unset_userdata('cash');
				$this->session->unset_userdata('fullName');
				$this->session->set_flashdata('message','Your money transferred successfully');
				    	redirect("Home/homepage");
			}else{
					$data["errors"] = "Invalid Details";
					$data["title"] ="Transfer Money";
					$this->load->view("templates/header");
					$this->load->view("qrscanner/form",$data);
					$this->load->view("templates/footer");
					$this->session->unset_userdata('cash');
					$this->session->unset_userdata('fullName');
					$this->session->set_flashdata('message','Invalid transaction');
					redirect("Home/homepage");
			}
			
			
		}
	}
?>