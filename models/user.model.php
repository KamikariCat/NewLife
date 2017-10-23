<?php
	class UserModel extends Model{

		// Change user password
		public function setNewPassword($password){
			$this->db->query("UPDATE users set password = '{$password}' where login = '".Session::get('login')."'");
		}

		// Activate account
		public function activeAcc($login, $password){
			$this->db->query("UPDATE users set login = '{$login}', password = '{$password}', active = '1' where id = '".Session::get('id')."'");			
		}

		// Verificate user password for correctly activate & change password
		public function verificate($password){
			$pwd = $this->db->query("SELECT * from users where login = '".Session::get('login')."'");
			if ($pwd[0]['password'] !== $password) {
				return false;
			}else{
				return true;
			}
		}

		// Get users info for visit page - touser.html
		public function getToUserInfo($id){
			if (App::getRouter()->getParam() !== 0 && App::getRouter()->getParam() !== Session::get('id')) {
				$member = $this->db->query("SELECT member from users where id = '{$id}'");
				$people = $this->db->query("SELECT * from people where id = '{$id}'");
				$character = $this->db->query("SELECT * from characters where id = '{$id}'");
				$avatar = $this->db->query("SELECT * from avatars where id = '{$id}'");
				$memberReady = $member[0];
				$peopleReady = $people[0];
				$characterReady = $character[0];
				$avatarReady = $avatar[0];

				foreach ($peopleReady as $key => $value) {
						$memberReady[$key] = $value;
				}
				foreach ($characterReady as $key => $value) {
					if ($key !== 'id') {
						$memberReady[$key] = $value;
					}
				}
				foreach ($avatarReady as $key => $value) {
					if ($key !== 'id') {
						$memberReady[$key] = $value;
					}
				}
				return $memberReady;
				}
			}

		// SIGN UP users
		// set acc data to users table
		public function setAccountData( $login, $password, $block = '00', $member = 'member') {
			$this->db->query("INSERT into users 
								(login, password, block, member) values 
								('{$login}', '{$password}', '{$block}', '{$member}')");
			$id = $this->db->query("SELECT id from users where login = '{$login}'");
			return $id['0']['id'];
		}

		// set data to people table
		public function setPeopleData( $id, $name, $birthday, $gender ) {
			$this->db->query("INSERT into people 
								(id, name, birthday, gender) values 
								('{$id}', '{$name}', '{$birthday}', '{$gender}')");
		}

		//set data to characters table | hw == h/w
		public function setCharacterData( $id, $nickname, $dateoffadd, $position,
										  $level, $race, $class, $reborn, $characterSex,
										  $married, $otherCharacters, $mulct = '0') {
			$this->db->query( "INSERT into characters
							  (id, nickname, dateofadd, position, level, race, class, reborn, character_gender, married, otherCharacters, mulct) values 
							  ('{$id}','{$nickname}','{$dateoffadd}','{$position}','{$level}','{$race}',
							   '{$class}','{$reborn}','{$characterSex}','{$married}','{$otherCharacters}','{$mulct}')" );			
		}

		// Rgister avatar place
		public function SetAvatar($id){
			$this->db->query( " INSERT into avatars (id) values ('{$id}') " );
		}

		// Loading new avatar
		public function setSelfAvatar($id, $fileName){
			$this->db->query( " UPDATE avatars set avatar = '{$fileName}' where id = {$id} " );
		}
	}