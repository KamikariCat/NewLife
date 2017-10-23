<?php
	class ChatModel extends Model{
		// Send chat message
		public function send($message){
			$this->db->query("INSERT into chat message values ('{$message}')");
		}

		// Get chat message
		public function get(){
			return $this->db->query("SELECT message from chat");
		}
	}