<?php
	class Model{
		protected $db;
		public static $SDb;

		public function __construct(){
			$this->db = App::$db;
			self::$SDb = App::$db;
		}
		public static function getSdb(){
			return self::$SDb;
		}
}