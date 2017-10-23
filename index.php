<?php
	ini_set('display_errors', 'Off');
	//error_reporting(E_ALL);
	define("ROOT", dirname(__FILE__));
	define('DS', DIRECTORY_SEPARATOR);
	require_once(ROOT.DS."load.php");
	App::run($_SERVER["REQUEST_URI"]);
	#unset($_SESSION);
	#session_destroy();