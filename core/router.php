<?php
	class Router{
		protected $uri;
		protected $controller;
		protected $action;
		protected $member;
		protected $model;
		protected $param;
		protected $param1;
		protected $param2;


	    /**
	     * Gets the value of uri.
	     *
	     * @return mixed
	     */
	    public function getUri(){
	        return $this->uri;
	    }

	    /**
	     * Gets the value of controller_name.
	     *
	     * @return mixed
	     */
	    public function getController(){
	        return $this->controller;
	    }

	    /**
	     * Gets the value of action_name.
	     *
	     * @return mixed
	     */
	    public function getAction(){
	        return $this->action;
	    }

	    /**
	     * Gets the value of model_name.
	     *
	     * @return mixed
	     */
	    public function getModel(){
	        return $this->model;
	    }
	    /**
	     * Gets the value of member.
	     *
	     * @return mixed
	     */
	    public function getMember(){
	        return $this->member;
	    }
	    /**
	     * Sets the value of action.
	     *
	     * @param mixed $action the action
	     *
	     * @return self
	     */
	    public function setAction($action){
	        $this->action = $action;

	        return $this;
	    }
	    /**
	     * Sets the value of member.
	     *
	     * @param mixed $member the member
	     *
	     * @return self
	     */
	    public function setMember($member)
	    {
	        $this->member = $member;

	        return $this;
	    }
	    	/**
	     * Gets the value of param.
	     *
	     * @return mixed
	     */
	    public function getParam() {
	        return $this->param;
	    }
	    public function getParam1() {
	        return $this->param1;
	    }
	    public function getParam2() {
	        return $this->param2;
	    }

	    /**
	     * Sets the value of param.
	     *
	     * @param mixed $param the param
	     *
	     * @return self
	     */
	    public function setParam($param){
	        $this->param = $param;

	        return $this;
	    }
	    public function setParam1($param1){
	        $this->param = $param1;

	        return $this;
	    }
	    public function setParam2($param2){
	        $this->param = $param2;

	        return $this;
	    }

		/**
		 * Class Constructor
		 * @param    $uri   
		 * @param    $controller_name   
		 * @param    $action_name   
		 * @param    $model_name   
		 */
		public function __construct($uri){
			$this->uri = $uri;
			// Get Default settings
			$this->controller = Settings::get('default_controller');
			$this->action = Settings::get('default_action');
			$this->member = Settings::get('default_member');
			$this->param = Settings::get('default_param');
			$this->param1 = Settings::get('default_param');
			$this->param2 = Settings::get('default_param');
			
			// parce URI
			//	member/controller/action/param
			$uri_path = explode('?', $this->uri);
			$zero_uri = $uri_path[0];
			$cleen_uri = explode("/", $zero_uri);

			if (count($cleen_uri)){
				array_shift($cleen_uri);
				//  First element - member (guest,admin member)
				if (in_array(strtolower(current($cleen_uri)), Settings::get('member'))){
					$this->member = current($cleen_uri);
					array_shift($cleen_uri);
				} elseif(current($cleen_uri)){
					$this->controller = current($cleen_uri);
					array_shift($cleen_uri);
				} elseif (!in_array(strtolower(current($cleen_uri)), Settings::get('member')) && !empty(current($cleen_uri))){
					$this->controller = current($cleen_uri);
					array_shift($cleen_uri);
				}
				if (current($cleen_uri) && !is_numeric(current($cleen_uri))) {
					$this->action = current($cleen_uri);
					array_shift($cleen_uri);
				}elseif(current($cleen_uri)){
					$this->param = current($cleen_uri);
					array_shift($cleen_uri);
				}
				if (current($cleen_uri) && is_numeric(current($cleen_uri))) {
					$this->param = current($cleen_uri);
					array_shift($cleen_uri);
				}
				if (current($cleen_uri) /*&& is_numeric(current($cleen_uri))*/) {
					$this->param1 = current($cleen_uri);
					array_shift($cleen_uri);
				}
				if (current($cleen_uri) /*&& is_numeric(current($cleen_uri))*/) {
					$this->param2 = current($cleen_uri);
				}
			}
		}

		public static function redirect($to){
			header("Location: ".$to);
		}
		public static function mpage(){
			header("Location: /user");
		}
		public static function rself(){
			header("Location: /".App::getRouter()->getController());
		}
		public static function e404(){
			//header("HTTP/1.1 404 Not Found");        
			//exit(file_get_contents('e404.html'));
		}
}