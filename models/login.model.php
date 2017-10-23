<?php
	class LoginModel extends Model{
		public function verificate($log, $pass){
			$ueser = $this->db->query("select * from users where login = '{$log}'");
			if ($log == $ueser[0]['login']){
				if ($pass == $ueser[0]['pass']){
					return $ueser[0];
				}
			}else{
				return false;
			}
		}
	}