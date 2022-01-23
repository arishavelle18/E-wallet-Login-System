<?php

	class Register_model extends CI_Model{

		private $registerTable = "codeigniter_register";

		public function insert($data){
			$this->db->insert($this->registerTable,$data);
			return $this->db->insert_id();
		}
		public function activate_acc($username,$code,$data){
		    $this->db->select('*');
		    $this->db->where('name', $username);    
		    $this->db->where('verification_key', $code);  
		    $query = $this->db->get($this->registerTable);
		   
		    if ($query->num_rows() > 0) {
		      $this->db->where('name', $username);    
		      $this->db->where('verification_key', $code);    
		      return $this->db->update($this->registerTable, $data);
		    }
  		}

	}


?>