<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class BoardPage implements IPage {
	protected $Link;
	protected $Info = [];
	protected $UF;

	public function __construct() {
		$this->Link = URI::Make([['page', 'Board']]);
	}

	public function Display(Page $P) {
		Breadcrumb::Add(Language::Get('page.board'), $this->Link());
		$this->Info['title'] = Language::Get('page.board');
		
		$this->UF = $P->URI()->Format();
		$BoardID = $P->URI()->GetID(1, 'BoardID');

		// Breadcrumbs, single board view
		if($BoardID > 0) {

			$Board = new Board(Board::GIVEN_ID, $BoardID);

			// Redirect if url-title is wrong
			if(!$P->URI()->Check(1, htmlspecialchars_decode($Board->GetTitle()))) {

				header('location: '.URI::Make([['page', 'Board'], ['BoardID', $BoardID, htmlspecialchars_decode($Board->GetTitle())]]));

			}

			Breadcrumb::AddMany($Board->GetBreadcrumbs());

			SBB::Template()->Assign(['current_board' => $Board, 'threads' => $Board->GetThreads()]);

		} else if($P->URI()->GetRoute()[1]) {
			header('location: '.$this->Link);
		}
		SBB::Template()->Assign(['boards' => $this->GetBoardList($BoardID)]);

	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return $this->Info['title'];
	}

	public function Template() {
		return 'PageBoard.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}

	// TODO: Move to board class, too? maybe? or rather not? see next week ..
	protected function GetBoardList($BoardID, $Depth = 0) {
		$Board = SBB::DB()->prepare('SELECT * FROM `board` WHERE `ParentID` = :BoardID ORDER BY `Position`');
		$Board->execute([':BoardID' => $BoardID]);
		$Board = $Board->fetchAll(PDO::FETCH_OBJ);

		$Depth++;
		$BoardList = array();
		foreach($Board as $Entry) {

			$CurBoard = new Board(Board::GIVEN_ROW, $Entry);

			$BoardList[] = [
				'board'          => $CurBoard,
				'sub_board'      => $Depth < 3 ? $this->GetBoardList($Entry->ID, $Depth) : false
			];
		}
		return $BoardList;
	}

}
