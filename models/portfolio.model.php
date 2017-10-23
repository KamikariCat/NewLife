<?php
	class PortfolioModel extends Model{
		public function send($message, $login){
			$this->db->sql("INSERT into messages (mesage, login) Values('{$message}','{$login}')");
		}
	}