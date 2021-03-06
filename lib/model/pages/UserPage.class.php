<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class UserPage implements IPage {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = URI::Make([['page', 'User']]);
		
		// Mark the navigation entry for 'UserList' as active
		$this->Info['nav'] = 'UserList';
	}

	public function Display(Page $P) {
		if(!$P->URI()->Get('UserID'))
			header('location: '.SBB::Page()->Link('UserList'));

		$this->Info['title'] = Language::Get('page.user');
		$UserID = (int)$P->URI()->GetID(1, 'UserID');
		if($UserID < 1 || !Database::Count('FROM `users` WHERE `ID` = :ID', [':ID' => $UserID])) {
			Notification::Show(Language::Get('user.no_user'), Notification::ERROR);
			$this->Info['template'] = 'PageError.tpl';
			return;
		}
		
		$User = SBB::DB()->prepare('SELECT * FROM `users` WHERE `ID` = :ID');
		$User->execute([':ID' => $UserID]);
		$User = $User->fetch(PDO::FETCH_OBJ);

		// Redirect if url-title is wrong
		if(!$P->URI()->Check(1, $User->Username)) {
			header('location: '.URI::Make([['page', 'User'], ['UserID', $UserID, $User->Username]]));
		}

		$this->Info['template'] = 'PageUser.tpl';
		$this->Info['title'] = Language::Get('user.user').': '.$User->Username;
		SBB::Nav()->Crumb()->Add(Language::Get('page.userlist'), $P->Link('UserList'));
		SBB::Nav()->Crumb()->Add($User->Username, URI::Make([['page', 'User'], ['UserID', $UserID, $User->Username]]));

		// Template..
		SBB::Template()->Assign(['profile' => [
			'username'  => $User->Username,
			'ID'        => $User->ID,
			'group'     => $User->GroupID,   // TODO: Read group
			'signature' => $User->Signature, // TODO: Parse message
			'joined'    => Language::Get(TimeUtil::Day(date('N', $User->Joined))).', '.
				date('d. ', $User->Joined).Language::Get(TimeUtil::Month(date('n', $User->Joined))).
				date(' Y, H:i', $User->Joined),
			'activity'  => date('d.m.Y, H:i', $User->LastActivity), // TODO: Alternative formats, like "Today, 11:23" or "Yesterday, 13:37",
			'language'  => $User->Language ? $User->Language : Language::Get('language.info'), // TODO: Read the real language
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
