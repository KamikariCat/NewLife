<?php
	class Session{
		public static function set($key, $value){
	        $_SESSION[$key] = $value;
	    }

	    public static function get($key){
	        if ( isset($_SESSION[$key]) ){
	            return $_SESSION[$key];
	        }
	        return null;
	    }
	    public static function Sunset($key = null){
	    	if (!empty($_SESSION[$key])) {
	    		unset($_SESSION[$key]);
	    	}
	    }
	}