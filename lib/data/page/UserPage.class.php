<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class UserPage implements PageData {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = URI::Make(['page' => 'User']);
	}

	public function Display() {
		if(!URI::Get('UserID'))
			header('location: '.SBB::Page()->Link('UserList'));

		$this->Info['title'] = Language::Get('sbb.page.user');
		$UserID = (int)URI::Get('UserID');
		if($UserID < 1 || !Database::Count('FROM `users` WHERE `ID` = :ID', [':ID' => $UserID])) {
			Notification::Show(Language::Get('sbb.user.no_user'), Notification::ERROR);
			$this->Info['template'] = 'pages/Error.tpl';
			return;
		}
		
		$User = SBB::DB()->prepare('SELECT * FROM `users` WHERE `ID` = :ID');
		$User->execute([':ID' => $UserID]);
		$User = $User->fetch(PDO::FETCH_OBJ);

		$this->Info['template'] = 'pages/User.tpl';
		$this->Info['title'] = Language::Get('sbb.user.user').': '.$User->Username;
		//Breadcrumb::Add(Language::Get('sbb.page.userlist'), SBB::Page()->Link('UserList')); // Endlessloop: SBB::Page()->Link('UserList')...
		Breadcrumb::Add($User->Username, URI::Make(['page' => 'User', 'UserID' => $UserID]));

		// Template..
		SBB::Template()->Assign(['profile' => [
			'username'  => $User->Username,
			'ID'        => $User->ID,
			'group'     => $User->GroupID,   // TODO: Read group
			'signature' => $User->Signature, // TODO: Parse message
			'joined'    => Language::Get(Time::Day(date('N', $User->Joined))).', '.
				date('d. ', $User->Joined).Language::Get(Time::Month(date('n', $User->Joined))).
				date(' Y, H:i', $User->Joined),
			'activity'  => date('d.m.Y, H:i', $User->LastActivity), // TODO: Alternative formats, like "Today, 11:23" or "Yesterday, 13:37",
			'language'  => $User->Language ? $User->Language : Language::Get('sbb.language.info'), // TODO: Read the real language
			'birthday'  => date('d.m.Y', $User->Birthday),
			'age'       => date('md', date('U', $User->Birthday)) > date('md') ? // TODO: Find a better age calculation
				(date('Y') - date('Y', $User->Birthday)-1) :
				(date('Y') - date('Y', $User->Birthday))
		]]);
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return $this->Info['title'];
	}

	public function Template() {
		return $this->Info['template'];
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}
}
?>