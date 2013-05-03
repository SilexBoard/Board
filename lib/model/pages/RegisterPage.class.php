<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class RegisterPage implements IPage {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = URI::Make([['page', 'Register']]);
	}

	public function Display(Page $P) {
		if(SBB::User()->LoggedIn())
			header('location: ./');

		$this->Info['node'] = self::$Node;
		$this->Info['title'] = Language::Get('page.register');
		SBB::Nav()->Crumb()->Add(Language::Get('page.register'), self::Link());
		$this->Info['template'] = 'Register';

		// Register formular
		if(!Session::Get('register.step') || HtmlPost::Get('Login'))
			Session::Set('register.step', 'register.username');

		$this->Steps = ['register.username', 'register.email', 'register.password', 'register.captcha', 'register.avatar'];

		if(HtmlPost::Get('sub_restart')) {
			HtmlPost::Del('sub_restart');
			Session::Restart();
		}
		if(HtmlPost::Get('sub_back')) {
			HtmlPost::Del('sub_back');
			$GoTo = clamp(array_search(Session::Get('register.step'), $this->Steps) - 1, 0, sizeof($this->Steps) - 1);
			Session::Set('register.step', $this->Steps[$GoTo]);
		}

		SBB::Template()->Assign(['register' => ['steps' => sizeof($this->Steps), 'current_step' => 2]]);

		/*
		while(true) {
			switch(Session::Get('register.step')) {
				case 'register.username':
					if(HtmlPost::Get('sub_username') && HtmlPost::Get('Username')) {
						if(Database::Count('FROM `users` WHERE `Username` = :name', [':name' => HtmlPost::Get('Username')]))
							Notification::Show(Language::Get('register.username_exist'), Notification::ERROR);
						else {
							Session::Set('register.step', 'register.password');
							Session::Set('register.username', $_POST['Username']);
							break;
						}
					}
					SBB::Template()->Set(['Register' => ['Progress' => 0]]);
					break 2;

				case 'register.password':
					if(HtmlPost::Get('sub_password') && HtmlPost::Get('Password')) {
						if(HtmlPost::Get('Password') == HtmlPost::Get('Password_Re')) {
							if(strlen(HtmlPost::Get('Password')) < 8) // TODO: read min from config
								Notification::Show(Language::Get('register.password_too_short'), Notification::ERROR);
							else {
								Session::Set('register.step', 'register.email');
								Session::Set('register.password', $_POST['Password']);
								break;
							}
						} else
							Notification::Show(Language::Get('register.incorrect_password'), Notification::ERROR);
					}
					SBB::Template()->Set(['Register' => ['Progress' => 25]]);
					break 2;
				
				case 'register.email':
					if(HtmlPost::Get('sub_email') && HtmlPost::Get('Email')) {
						if(HtmlPost::Get('Email') == HtmlPost::Get('Email_Re')) {
							Session::Set('register.step', 'register.captcha');
							Session::Set('register.email', $_POST['Email']);
							break;
						} else
							Notification::Show(Language::Get('register.incorrect_email'), Notification::ERROR);
					}
					SBB::Template()->Set(['Register' => ['Progress' => 50]]);

					break 2;
				case 'register.captcha':
					SBB::Template()->Set(['Register' => ['Progress' => 75]]);
					break 2;
				default:
					if(Session::Get('register.step'))
						Notification::Show('The registration process failed: "'.print_r(Session::Get('register.step'), true).'" is not a valid expression.', Notification::WARNING);
					Session::Set('register.step', 'register.username');
					break;
			}
		}
		*/

		$PasswordBullets = '';
		if(Session::Get('register.password'))
			for($i = 0; $i < strlen(Session::Get('register.password')); $i++)
				$PasswordBullets .= '•';

		$Avatar = 'styles/Lumen Lunae/icons/g_64_user.png';
		if(Session::Get('register.email'))
			$Avatar = 'http://www.gravatar.com/avatar/'.md5(strtolower(trim(Session::Get('register.email')))).'&s=64';

		SBB::Template()->Assign(['Register' => ['Step' => Session::Get('register.step'),
			'Username' => Session::Get('register.username'),
			'Password' => $PasswordBullets,
			'RealPw' => Session::Get('register.password'),
			'Email' => Session::Get('register.email'),
			'Avatar' => $Avatar]]);
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return Language::Get('page.register');
	}

	public function Template() {
		return 'PageRegister.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}
}
