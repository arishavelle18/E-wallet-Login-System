<?php

	class Qr_model extends CI_Model{
		private $historyTable = "history_log";

		public function insert($data){
			return $this->db->insert($this->historyTable,$data);

		}

	}


?>