<?php
	class Sysmessage{
		public static function notCorrectLoginOrPass(){
			echo "<p>Не правильно ввели логин или пароль</p>";
		}
		public static function accountActive(){
			echo "<p>Ваш аккаунт активирован, приятного времяпровождения</p>";	
		}
	}