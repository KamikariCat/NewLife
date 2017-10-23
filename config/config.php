<?php
	Settings::set('site_name', "site_name");
	Settings::set('member', [
				'guest' => 'guest',
				'admin'	=> 'admin',
				'member'=> 'member',
				'login' => 'login'
		]);

	// Default setting
	Settings::set('default_member', 'guest');
	Settings::set('default_controller', 'main');
	Settings::set('default_action', 'index');
	Settings::set('default_param', 0);
	
	Settings::set('admin_page', ROOT.DS."views".DS."admin.html");
	Settings::set('guest_page', ROOT.DS."views".DS."page.html");
	Settings::set('member_page', ROOT.DS."views".DS."member.html");
	//Settings::set('login_page', ROOT.DS."views".DS."login.html");  // ?
	//Settings::set('panel_page', ROOT.DS."views".DS."panel.html");  // ?
	
	// Database settings
	Settings::set('db.host', 'localhost');
	Settings::set('db.user', 'root');
	Settings::set('db.password', '');
	Settings::set('db.db_name', 'new_life');
	Settings::set('salt', '4a4be40c96ac6314e91d93f38043a634');