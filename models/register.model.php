<?php
	class RegisterModel extends Model{
		public function register($login, $pass, $name, $surname, $email, $phone, $birthday, $uiqid, $ip){
			$this->db->query("INSERT into users (login, pass, name, surname, email, phone, birthday, uniqid, member, ip) values ('{$login}', '{$pass}', '{$name}', '{$surname}', '{$email}', '{$phone}', '{$birthday}', '{$uiqid}', 'member', '{$ip}')");
		}
	}