<?php
	
	class NewsModel extends Model{
		public function showChatMessages(){
			return $this->db->query("SELECT * from chat order by id ASC");
		}
		public static function getUserMemberInfo($nickname){
			$nickname = Model::getSdb()->query("SELECT * from characters where nickname='{$nickname}'");
			$member = Model::getSdb()->query("SELECT member from accounts where id='{$nickname['0']['id']}'");
			if ($member[0]['member'] == 'admin') {
					return true;
				}else{
					return false;
				}
		}
	}