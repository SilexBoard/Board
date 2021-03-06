<?php
/**
 * @author      Patrick Kleinschmidt (NoxNebula) <noxifoxi@gmail.com>
 * @copyright   2011 - 2013 Silex Bulletin Board
 * @license     GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class ThreadPage implements IPage {
	protected $Link;
	protected $Info = [];
	protected $Title;
	protected $UF;

	public function __construct() {
		$this->Link = URI::Make([['page', 'Thread']]);

		// Mark the navigation entry for 'Board' as active
		$this->Info['nav'] = 'Board';
	}

	public function Display(Page $P) {

		SBB::Nav()->Crumb()->Add(Language::Get('page.board'), $P->Link('Board'));

		$this->UF = $P->URI()->Format();
		$ThreadID = $P->URI()->GetID(1, 'ThreadID');

		$Thread = new Thread(Thread::GIVEN_ID, $ThreadID);

		if($ThreadID > 0 && $Thread !== false) {

			$this->Title = htmlspecialchars($Thread->GetTopic());

			// Redirect if url-title is wrong
			if(!$P->URI()->Check(1, htmlspecialchars_decode($this->Title))) {
				header('location: '.URI::Make([['page', 'Thread'], ['ThreadID', $ThreadID, htmlspecialchars_decode($this->Title)]]));
			}

			/* Crumby-Crumbs */
			SBB::Nav()->Crumb()->AddMany($Thread->GetBreadcrumbs());

			// Get them posts!
			SBB::Template()->Assign(['posts' => $Thread->GetPosts()]);

		} else {
			$this->Info['title'] = Language::Get('error');
			Notification::Show('Thread existiert nicht!', Notification::ERROR);
		}

		// Has the ComposePage something for us?
		// TODO: Does not work.
		if(Session::Get('ComposePostSuccess')) {
			Notification::Show(Language::Get('compose.success.reply'), Notification::SUCCESS);
			Session::Remove('ComposePostSuccess');
		}

		if(Session::Get('ComposeThreadSuccess')) {
			Notification::Show(Language::Get('compose.success.thread'), Notification::SUCCESS);
			Session::Remove('ComposeThreadSuccess');
		}

        if(Session::Get('EditPostSuccess')) {
            Notification::Show(Language::Get('compose.success.edit'), Notification::SUCCESS);
            Session::Remove('EditPostSuccess');
        }

	}

	public function Link() {
		return $this->Link;
	}

	public function Title() {
		return $this->Title;
	}

	public function Template() {
		return 'PageThread.tpl';
	}

	public function Info($Info) {
		return isset($this->Info[$Info]) ? $this->Info[$Info] : false;
	}

}
