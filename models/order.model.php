<?php
	class OrderModel extends Model{
		public function send($name, $phone, $mail, $message){
			$this->db->query("INSERT into orders (name, phone, mail, message) values ('{$name}', '{$phone}', '{$mail}', '{$message}')");
		}
	}