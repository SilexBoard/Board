<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class User {

	/*
	 * What is given to fetch stuff?
	 */
	const GIVEN_ID = 1;
	const GIVEN_ROW = 2;
	const GIVEN_GUEST = 3;

	protected $Name = '';
	protected $ID = 0;
	protected $LoggedIn = false;
	protected $Group = null;

	protected $Permission = null;

	protected $Info = [];

	public function __construct($Type, $Input = null) {

		/* Get general information about the user */
		if($Type != self::GIVEN_GUEST && $Input != 0) { // This is not our guest

			if($Type == self::GIVEN_ID) {
				$this->ID = $Input;
				if(!$this->Fetch())
					return false;
			}
			else
				$this->FetchRow($Input);

		}
		else { // Not logged in
			$this->Name = Language::Get('sbb.user.guest');
			$this->ID = 0;
			$this->LoggedIn = false;
			$this->Group = new Group((int)SBB::Config('user.group.guest'));
		}

		/* Get permissions */
		$this->Permission = new Permission($this->ID, $this->Group->ID());
	}

	protected function Fetch() {

		$Result = SBB::DB()->prepare('SELECT * FROM `users` WHERE `ID` = :UserID');
		$Result->execute([':UserID' => $this->ID]);

		$Row = $Result->fetch(PDO::FETCH_OBJ);

		if(!$Row) {
			// User does not exist
			return false;
		}

		$this->FetchRow($Row);

	}

	protected function FetchRow($Row) {

		if($this->ID == 0)
			$this->ID = $Row->ID;

		$this->Info = $Row;
		$this->Name = $Row->Username;
		$this->LoggedIn = true;
		$this->Group = new Group((int)$Row->GroupID);

	}

	/* User info */

	/**
	 * Return the user name or set it
	 */
	public function Name($Name = '') {
		if(empty($Name))
			return $this->Name;
		// TODO: Set the name
	}

	/**
	 * Returns the user id of the current user
	 * @return int
	 */
	public function ID() {
		return $this->ID;
	}

	/**
	 * Get the user permission
	 * @param  string $Node
	 * @return mixed
	 */
	public function Permission($Node) {
		return $this->Permission->Get($Node);
	}

	/**
	 * Get the group
	 * @return Group
	 */
	public function Group() {
		return $this->Group;
	}

	/**
	 * Return if the user is logged in
	 * @return bool
	 */
	public function LoggedIn() {
		return $this->LoggedIn;
	}

	/**
	 * Return additional info
	 * @param  string $Info
	 * @return mixed
	 */
	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : null;
	}

	public function GetLink() {
		return URI::Make([['page', 'User'], ['UserID', $this->ID, $this->Name]]);
	}

}
