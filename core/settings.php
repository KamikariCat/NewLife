<?php
class Settings{
	protected static $settings = [];
	public static function set($key, $value){
		self::$settings[$key] = $value;
	}
	public static function get($key){
		return self::$settings[$key];
	}
}