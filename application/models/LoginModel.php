<?php

	class LoginModel extends CI_Model{

		private $registerTable = "codeigniter_register";

		public function checkUserInfo($userInfo){
			$this->db->where("email",$userInfo['email']);
			$query = $this->db->get($this->registerTable);
			// check kung may username na ganon 
			if($query->num_rows() > 0){
				// check kung compatible sila ng $password at sa db
				// kung compatible si password sa db
	
				if(password_verify($userInfo['password'], $query->row_array()["password"])){

					return true;

				}
				else{
					// kapag di compatible
					return false;
				}
			}else{
				// kung di naman nag eexist 
				return false;
			}
		}
		public function checkUserVerify($username=Null,$email=Null){
			if(!is_null($username)){
				$this->db->where("name",$username);
				$query = $this->db->get($this->registerTable);
				if($query->num_rows() > 0){
					if($query->row_array()["is_email_verified"] == 1){
						// verified
						return true;
					}
					else{
						// hindi verified
						return false;
					}
				}else{
					// kung di naman nag eexist 
					return false;
				}
			}elseif(!is_null($email)){
				$this->db->where("email",$email);
				$query = $this->db->get($this->registerTable);
				if($query->num_rows() > 0){
					if($query->row_array()["is_email_verified"] == 1){
						// verified
						return true;
					}
					else{
						// hindi verified
						return false;
					}
				}else{
					// kung di naman nag eexist 
					return false;
				}
			}
		}
		public function getUser($username = NULL , $email = NULL){
			if(!is_null($username)){
			
			$this->db->where("name",$username);
			
			}
			else {
				$this->db->where("email",$email);
			}
			$query = $this->db->get($this->registerTable);
			
			return $query->row_array();

		}
		public function getUserContact($contact){
			$this->db->where("contact",$contact);
			$query = $this->db->get($this->registerTable);
			if($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
			
		}

	}


?>