<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class SiteNav extends AbstractNav {
	protected $Entries = [];
	protected $Active;
	
	public function __construct() {
		$this->Active = SBB::Page()->NavEntry();

		$Entries = SBB::DB()->query('SELECT * FROM `nav` ORDER BY `Position`')->fetchAll(PDO::FETCH_OBJ);
		foreach($Entries as $Entry) {
			//$Permission = $Entry->Permission;
			$this->Entries[] = [
				'name' => Language::Get($Entry->NavName),
				'link' => SBB::Page()->Link(preg_replace('/^p:(\w+)$/', '$1', $Entry->Target)),
				'active' => $Entry->Target == 'p:'.$this->Active
			];
		}
	}

	public function Add($Name, $Link, $Target = false) {
		$this->Entries[] = [
			'name' => $Name,
			'link' => $Link,
			'active' => $Target ? $Target == $this->Active : false
		];
	}

	public function Remove($Name) {
		// TODO: do this better
		for($i = 0; $i < sizeof($this->Entries); $i++) {
			if($this->Entries[$i]['name'] == $Name) {
				unset($this->Entries[$i]);
			}
		}
		$this->Repack();
	}

	public function GetList() {
		return $this->Entries;
	}

	private function Repack() {
		$Repack = [];
		foreach($this->Entries as $Entry) {
			$Repack[] = $Entry;
		}
		$this->Entries = $Repack;
	}
}
