<?php 
	class MainController extends Controller{
		public function __construct(){
			parent::__construct();
			$this->model = new MainModel;
			function verMemberInChat($nickname){
				return MainModel::getUserMemberInfo($nickname);
			}
		}
		// GUEST
		public function index(){
			// Show chat messages
			self::$data = ['chat' => ['messages' => $this->model->showChatMessages()]];
		}

		// MEMBER
		public function member_index(){
			// Send chat messages
			self::$data = ['chat' => ['messages' => $this->model->showChatMessages()]];
			if (Session::get('active') !== '0') {
				if (isset($_POST['send_chat_message'])){
					$this->model->setChatMessage(addslashes(Session::get('nickname')), $_POST['message']);
					Router::rself();
				}
			}
		}

		// ADMIN
		public function admin_index(){
			// Send chat messages
			self::$data = ['chat' => ['messages' => $this->model->showChatMessages()]];
			if (Session::get('active') !== '0') {
				if (isset($_POST['send_chat_message'])){
					$this->model->setChatMessage(addslashes(Session::get('nickname')), $_POST['message']);
					Router::rself();
				}
			}
		}
	}
	/*
id
login
pass
name
nickname in game
	*/