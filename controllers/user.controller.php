<?php
	class UserController extends Controller{
		public function __construct(){
			parent::__construct();
			$this->model = new UserModel;
			self::$data['not_empty'] = 'no';
		}
		
		// ADMIN
		public function admin_index(){
			// Activate account
			if (isset($_POST['activate_account_btn'])) {
				if ($_POST['nowTextLogin'] !== $_POST['newTextLogin'] 
					&& $this->model->verificate(md5($_POST['nowPassText'].Settings::get('salt'))) 
					&& $_POST['newPassText'] == $_POST['newPassTextVer']){

					$this->model->activeAcc($_POST['newTextLogin'], md5($_POST['newPassText'].Settings::get('salt')));
					Session::Sunset();
					session_destroy();
					Router::redirect('/main');
				}
			}

			// Change password
			if (isset($_POST['newBtnPass'])) {
				if ($this->model->verificate(md5($_POST['nowPassText'].Settings::get('salt')))) {
					if ($_POST['newPassText'] == $_POST['newPassTextVer']) {
						$this->model->setNewPassword(md5($_POST['newPassTextVer'].Settings::get('salt')));
						Session::Sunset();
						session_destroy();
						Router::redirect('/main');
					}
				}else{
					return false;
				}
			}

			// Loading new user avatar
			if (isset($_POST['load-avatar'])) {
				$udir = ROOT.DS.'upload'.DS.'users'.DS.Session::get('id').DS.'avatar'.DS;
				if ( $_FILES['fileToUpload']['type'] == 'image/jpeg' || $_FILES['fileToUpload']['type'] == 'image/jpg' ) {
					$file = md5($_FILES['fileToUpload']['name'].time()).'.jpg';
				} elseif ( $_FILES['fileToUpload']['type'] == 'image/png' ) {
					$file = md5($_FILES['fileToUpload']['name'].time()).'.png';
				}
				$ufile = $udir.$file;
				if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $ufile)) {
					$this->model->setSelfAvatar(Session::get('id') ,$file);
				    //echo "Файл корректен и был успешно загружен.\n";
				} else {
				    //echo "Возможная атака с помощью файловой загрузки!\n";
				}
			}
			// Visit to other users pages
			if (App::getRouter()->getParam() !== '0' && App::getRouter()->getParam() !== Session::get('id')) {
				self::$data = $this->model->getToUserInfo(App::getRouter()->getParam());
			}
		}

		// MEMBER
		public function member_index(){
			// Activate account
			if (isset($_POST['activate_account_btn'])) {
				if ($_POST['nowTextLogin'] !== $_POST['newTextLogin'] 
					&& $this->model->verificate(md5($_POST['nowPassText'].Settings::get('salt'))) 
					&& $_POST['newPassText'] == $_POST['newPassTextVer']){

					$this->model->activeAcc($_POST['newTextLogin'], md5($_POST['newPassText'].Settings::get('salt')));
					Session::Sunset();
					session_destroy();
					Router::redirect('/main/');
				}
			}

			// Change password
			if (isset($_POST['newBtnPass'])) {
				if ($this->model->verificate(md5($_POST['nowPassText'].Settings::get('salt')))) {
					if ($_POST['newPassText'] == $_POST['newPassTextVer']) {
						$this->model->setNewPassword(md5($_POST['newPassTextVer'].Settings::get('salt')));
						Session::Sunset();
						session_destroy();
						Router::redirect('/main');
					}
				}else{
					return false;
				}
			}

			// Loading new user avatar
			if (isset($_POST['load-avatar'])) {
				$udir = ROOT.DS.'upload'.DS.'users'.DS.Session::get('id').DS.'avatar'.DS;
				if ( $_FILES['fileToUpload']['type'] == 'image/jpeg' || $_FILES['fileToUpload']['type'] == 'image/jpg' ) {
					$file = md5($_FILES['fileToUpload']['name'].time()).'.jpg';
				} elseif ( $_FILES['fileToUpload']['type'] == 'image/png' ) {
					$file = md5($_FILES['fileToUpload']['name'].time()).'.png';
				}
				$ufile = $udir.$file;
				if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $ufile)) {
					$this->model->setSelfAvatar(Session::get('id') ,$file);
				    //echo "Файл корректен и был успешно загружен.\n";
				} else {
				    //echo "Возможная атака с помощью файловой загрузки!\n";
				}
			}

			// Visit to other users pages
			if (App::getRouter()->getParam() !== '0' || App::getRouter()->getParam() !== Session::get('id')) {
				self::$data = $this->model->getToUserInfo(App::getRouter()->getParam());
			}
		}

		// ADMIN SIGN IN
		public function admin_signup(){
			//Password & login generator
			$chars = ['q','w','e','r','t',
					  'y','u','i','i','o',
					  'p','a','s','d','f',
					  'g','h','j','k','l',
					  'z','x','c','v','b',
					  'n','m','1','2','3',
					  '4','5','6','7','8',
					  '9','0'];
			$login = '';
			$password = '';
			$lLength = rand(5, 8);
			$lPass = rand(8, 10);
			for ($i=0; $i <= $lLength; $i++) { 
				$login .= $chars[rand(0, count($chars) - 1)];
			}
			for ($z=0; $z <= $lPass; $z++) { 
				$password .= $chars[rand(0, count($chars) - 1)];
			}
			self::$data['generator'] = ['login' => $login,
										'password' => $password];
			
			// Sign up
			if ( isset($_POST['signup_btn']) ) {
				foreach ($_POST as $key => $value) {
					$newUD[$key] = str_replace("'", "\'", str_replace('"', '\"', $value));
				}
				// register new account & get him id
				$newUserId = $this->model->setAccountData( $newUD['NUlogin'], md5($_POST['NUpassword'].Settings::get('salt')) );

				$this->model->setPeopleData( $newUserId, $newUD['NUname'], strtotime($newUD['NUbirthday']), $newUD['NUsex'] );

				if ( isset($newUD['NUmarried']) ) {
					$num = $newUD['NUmarried'];
				} else {
					$num = null;
				}

				$this->model->setCharacterData( $newUserId, $newUD['NUnickname'], strtotime($newUD['NUdateoffadd']),
					$newUD['NUposition'], $newUD['NUlevel'], $newUD['NUrace'], $newUD['NUclass'], $newUD['NUreborn'],
					$newUD['NUcharacterSex'], $num, $newUD['NUotherCharacters'] );
				$this->model->setAvatar($newUserId);

				// Create users directory
				$userD = $newUserId.DS.'avatar';
				mkdir(ROOT.DS.'upload'.DS.'users'.DS.$userD, 0777, true);
			}
		}
	}