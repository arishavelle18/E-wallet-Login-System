<?php

	class Money_model extends CI_Model{

		private $registerTable = "codeigniter_register";

		public function transferCash($cash,$sender,$reciever){
			
			$this->db->where("name",$sender);
			$query = $this->db->get($this->registerTable);
			// inupdate

			$currentMoney = $query->row_array()["cash"]-$cash;
			
			
			$this->db->where("name",$sender);
			$this->db->update($this->registerTable,array("cash" => $currentMoney));
			if($query->num_rows() > 0 ){
				$this->db->where("name",$reciever);
				$query2 = $this->db->get($this->registerTable);
				$recieverMoney = $query2->row_array()["cash"] + $cash;
				// inupdate
				$this->db->where("name",$reciever);
				$query2 = $this->db->update($this->registerTable,array("cash" => $recieverMoney));
			}
		}
		public function checkBalance($name,$cash){
			$this->db->where("name",$name);
			$query = $this->db->get($this->registerTable);
			if($query->num_rows() > 0){
				if($query->row_array()["cash"] >= $cash){
					return true;
				}
				else{
					return false;
				}
			}else{
				return false;
			}
		}
		public function checkContact($contact,$own){
			$this->db->where("contact",$contact);
			$query = $this->db->get($this->registerTable);
			echo $query->row_array()["contact"]."<br>";
			echo $own;
			if($query->row_array()["contact"] != $own){
				return true;
			}
			else{
				return false;
			}
		}




	}