<?php
	class NewsController extends Controller{
		function __construct(){
			parent::__construct();
			$this->model = new NewsModel;
			self::$data = ['chat' => ['messages' => $this->model->showChatMessages()]];
			function verMemberInChat($nickname){
				return NewsModel::getUserMemberInfo($nickname);
			}
		}
		public function index(){
		}
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