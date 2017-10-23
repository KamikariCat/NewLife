<?php
	class Controller
    {
		protected static $data = [];
		protected $db;
		protected $model;
		public function __construct(){
            $model = new SignInModel;
            if (isset($_POST['sign_in_acc'])) {
                if (!$model->verificate($_POST['login'], md5($_POST['pass'].Settings::get('salt')))) {
                    Router::rself();
                }elseif($model->verificate($_POST['login'], md5($_POST['pass'].Settings::get('salt')))){
                    Session::set('user_on', 'on');
                    // getAccData
                    Session::set('id', $model->getAccData('id'));
                    Session::set('login', $model->getAccData('login'));
                    Session::set('password', $model->getAccData('password'));
                    Session::set('member', $model->getAccData('member'));
                    Session::set('active', $model->getAccData('active'));
                    Session::set('block', $model->getAccData('block'));
                    // getCharacterData
                    Session::set('nickname', $model->getCharacterData('nickname'));
                    Session::set('dateofadd', $model->getCharacterData('dateofadd'));
                    Session::set('position', $model->getCharacterData('position'));
                    Session::set('level', $model->getCharacterData('level'));
                    Session::set('race', $model->getCharacterData('race'));
                    Session::set('class', $model->getCharacterData('class'));
                    Session::set('reborn', $model->getCharacterData('reborn'));
                    Session::set('character_gender', $model->getCharacterData('character_gender'));
                    Session::set('married', $model->getCharacterData('married'));
                    Session::set('otherCharacters', $model->getCharacterData('otherCharacters'));
                    Session::set('mulct', $model->getCharacterData('mulct'));
                    // getPeopleData
                    Session::set('name', $model->getPeopleData('name'));
                    Session::set('birthday', $model->getPeopleData('birthday'));
                    Session::set('fenixdate', $model->getPeopleData('fenixdate'));
                    Session::set('gender', $model->getPeopleData('gender'));
                    // User files
                    Session::set('avatar', $model->GetUFiles('avatar'));
                    Router::rself();
                }else{
                    Router::rself();
                }
            }
            if (!empty(Session::get('user_on')) && $model->verificate(Session::get('login'), Session::get('password'))) {
                Session::set('active', $model->getAccData('active'));
            }/*else {
                Session::unset();
                session_destroy();
            }*/
            if (isset($_POST['exit_from_acc'])) {
                if (App::getRouter()->getController() == 'user') {
                    Session::Sunset();
                    session_destroy();
                    Router::redirect('/main');
                }else {
                    Session::Sunset();
                    session_destroy();
                    Router::rself();
                }
            }
		}
        public static function getData(){
            return self::$data;
        }
}