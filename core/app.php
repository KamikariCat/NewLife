<?php
	class App
	{
		protected static $router;
		protected static $viewPath;
		protected $controllerName;
		public static $db;
		public static function getRouter(){
			return self::$router;
		}
		// Connect View
		public static function getViewPath(){
			if (file_exists(self::$viewPath)) {
				$data = Controller::getData();
				include self::$viewPath;
			} elseif(!file_exists(self::$viewPath)){
				Router::e404();
			}else{
				Router::e404();
			}
		}
		// Connect styles for diferent body vies news & sales
		public static function getStyleOne(){
			if (self::$router->getController() == 'main') {
				echo '<link href="/css/front.css" media="all" rel="stylesheet" type="text/css" />';
			}else{
				echo '<link href="/css/style.css" media="all" rel="stylesheet" type="text/css" /> ';
			}
		}
		// Run Application
		public static function run($uri){
			session_start();
			self::$db = new DB(Settings::get('db.host'), Settings::get('db.user'), Settings::get('db.password'), Settings::get('db.db_name'));
			self::$router = new Router($uri);
			
			$controller_name = ucfirst(self::$router->getController())."Controller";

			if (/*self::$router->getMember() == 'admin' &&  */Session::get('member') == 'admin'){
				$method_name = 'admin_'.strtolower(self::$router->getAction());
				App::getRouter()->setMember('admin');
			}elseif(Session::get('member') == 'member'){
				$method_name = 'member_'.strtolower(self::$router->getAction());
				App::getRouter()->setMember('member');
			}else{
				$method_name = strtolower(self::$router->getAction());
				App::getRouter()->setMember(Settings::get('default_member'));
			}

			self::$viewPath = ROOT.DS."views".DS.strtolower(self::$router->getController()).DS.$method_name.".html";
			// Generate class & method
			if (class_exists($controller_name)){
				$controller_object = new $controller_name;
				if (method_exists($controller_object, $method_name)) {
					$controller_object->$method_name();
				} else{
					Router::e404();
				}
			} else{
					Router::e404();
			}

			// Select template for member
			$members = Settings::get('member');
			$member = $members[self::$router->getMember()];
			View::getTemplate($member);
			echo "---  member      ---".self::$router->getMember()."<br>";
			echo "---  controller  ---".self::$router->getController()."<br>";
			echo "---  action  	   ---".self::$router->getAction()."<br>";
			echo "---  method      ---".$method_name."<br>";
			echo "---  param      ---".self::$router->getParam()."<br>";
			echo "---  param1      ---".self::$router->getParam1()."<br>";
			echo "---  param2      ---".self::$router->getParam2()."<br>";
		}
	}
