<?php
	class MainModel extends Model{
		// Send chat message
		public function setChatMessage($nickname, $message){
			$this->db->query("INSERT into chat (nickname, message) values ('{$nickname}', '{$message}')");
		}

		// Show caht messages
		public function showChatMessages(){
			return $this->db->query("SELECT * from chat order by id ASC");
		}

		// Select admin member for mark nicknames into chat
		public static function getUserMemberInfo($nickname){
			$expectId = Model::getSdb()->query("SELECT id from characters where nickname='{$nickname}'");
			$id = $expectId[0]['id'];
			$member = Model::getSdb()->query("SELECT member from users where id='{$id}'");
			if ($member[0]['member'] == 'admin') {
					return true;
				}else{
					return false;
				}
		}
	}