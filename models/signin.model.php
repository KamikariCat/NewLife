<?php
	// Core/controller.php
	class SignInModel extends Model{
		protected $getAccData; // Data in accounts table
		protected $getCharacterData; // Data in character table
		protected $getPeopleData; // Data in people table
		protected $GetUFiles; // Data in avatars table

		// Validate insert login & password in login form
		public function verificate($login, $password){
			$this->getAccData = $this->db->query("SELECT * from users where login = '{$login}'");
			$id = $this->getAccData['0']['id'];
			$this->getCharacterData = $this->db->query("SELECT * from characters where id = '{$id}'");
			$this->getPeopleData = $this->db->query("SELECT * from people where id = '{$id}'");
			$this->GetUFiles = $this->db->query("SELECT * from avatars where id = '{$id}'");
			if ($this->getAccData['0']['password'] !== $password) {
				return false;
			}else{
				return true;
			}
		}

		// Get data from tables
		public function getAccData($a){
			return $this->getAccData['0'][$a];
		}
		public function getCharacterData($c){
			return $this->getCharacterData['0'][$c];
		}
		public function getPeopleData($p){
			return $this->getPeopleData['0'][$p];
		}
		public function GetUFiles($ufile){
			return $this->GetUFiles['0']['avatar'];
		}

	}