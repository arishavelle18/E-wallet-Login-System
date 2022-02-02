<?php
date_default_timezone_set("Asia/Manila");
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
  		public function clear_unconfirmed_post() {
  			$dt = new Datetime();   //create object for current date/time
			$dt->modify('15 minutes ago');   //substract 15 minutes
			$sdt = $dt->format('Y-m-d H:i:s');  //format it into a datetime string

			$this->db->where('created_at <' , $sdt); 
		   	$this->db->where('is_email_verified',0);
		   	return $this->db->delete($this->db->dbprefix . $this->registerTable);
		    
  			 
		} 

	}


?>