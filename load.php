<?php
require_once(ROOT.DS."config".DS."config.php");
function __autoload($class_name){
	$controller_path = ROOT.DS."controllers".DS.str_replace("controller", "", strtolower($class_name)).".controller.php";
	$model_path = ROOT.DS."models".DS.str_replace("model", "", strtolower($class_name)).".model.php";
	$core_path =  ROOT.DS."core".DS.strtolower($class_name).".php";
	if (file_exists($controller_path)) {
		require_once $controller_path;
	} elseif (file_exists($model_path)) {
		require_once $model_path;
	} elseif (file_exists($core_path)) {
		require_once $core_path;
	} else {
		App::getRouter()->e404();
	}
}




//controllers - name.controller.php 	NameController
//models - name.model.php 				NameModel
//core - name.php 						Name