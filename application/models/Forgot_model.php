<?php

	class Forgot_model extends CI_Model{
		private $registerTable = "codeigniter_register";

		public function insert_code($code,$email){
			$this->db->where("email",$email);
			return $this->db->update($this->registerTable,array("code" =>  $code));

		}
		public function checkCode($email,$code){
			$this->db->where("email",$email);
			$query = $this->db->get($this->registerTable);
			// check kung nandon sa db
			if($query->num_rows() != 0){
				if($query->row_array()["code"] == $code){
					return true;
				}else{
					// kung di sila same
					return FALSE;
				}
			}
			else{
				return FALSE;
			}
		}
		public function updatePassword($email,$newpass){
			$this->db->where("email",$email);
			return $this->db->update($this->registerTable,array("password" =>  $newpass));

		}
		public function deleteCode($email){
			$this->db->where("email",$email);
			return $this->db->update($this->registerTable,array("code" =>  ""));
		}
	}
	
?>