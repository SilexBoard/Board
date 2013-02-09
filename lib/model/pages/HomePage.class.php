<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class HomePage implements IPage {
	protected $Link;
	protected $Info = [];

	public function __construct() {
		$this->Link = URI::Make([['page', '']]);
		$this->Info['nav'] = 'Home';
	}

	public function Display(Page $P) {
		// Redirect on ?page=Home
		if($P->URI()->Get('page') == 'Home')
			header('location: '.self::Link());
	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return Language::Get('page.home');
	}

	public function Template() {
		return 'PageHome.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}
}
