<?php
	class View{

		public static function getTemplate($member, $panel = null){
				$template_path = Settings::get($member."_page");
			if (file_exists($template_path)){
				function getLogin(){
					if (Session::get('user_on') !== 'on') {
						echo '
						<div class="search">
							<form method="post">
			                    <p>
			                        <input type="text" name="login" placeholder="Логин" class="form-text" autocomplete="off"/>
			                        <input type="password" name="pass" placeholder="Пароль" class="form-text" autocomplete="off"/>
			                        <input type="submit" name="sign_in_acc" value="Войти" class="form-submit" />
			                    </p>
			                </form> 
			            </div>
						';
					}else{
						echo "
							<div id='userHeadInfo'>
								<div id='userHeadInfoText'>
									<div id='oneUserPartInfo'>
										<p><a href='/user'>";
										if (App::getRouter()->getController() == 'user') {
											echo "<span id='selfUserClass'>".Session::get('nickname').'</span>';
										}else{
											echo Session::get('nickname');
										}
										echo"</a></p>
										<p>";
											if (Session::get('active') == '0') {
												echo "<span class='red-text'>Не активен</span>";
											}else {
												echo Session::get('login');
											}
										echo"</p>
									</div>
									<div id='twoUserPartInfo'>
										<p>".Session::get('position')."</p>
										<p>"; 
											if (Session::get('active') == '0') {
												echo "<span class='red-text'>---</span>";
											}else{
												echo Session::get('member');
											}
										echo "</p>
									</div>
								</div>
								<form method='post'>
									<p>
										<input type='submit' id='exit_acc_formsubmit' name='exit_from_acc' value='Выход' class='form-submit'>
									</p>
								</form>
							</div>
						";
					}
				}
				include $template_path;
			} else{
				Router::e404();
			}
		}
	}