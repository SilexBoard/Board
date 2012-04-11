<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Style implements Singleton {
	private static $Instance = NULL;

	// Styleinfo
	private $Info = array();
	private $Files = array();
	
	public static function GetInstance() {
		if(!self::$Instance)
			self::$Instance = new self;
		return self::$Instance;
	}
	
	private function __clone() {}
	
	protected function __construct() {
		// Use Userstyle
		$this->Info['Dir'] = ''; // TODO: Read userstyle
		if(empty($this->Info['Dir']) || !is_dir(DIR_ROOT.DIR_STYLE.$this->Info['Dir'])) {
			// Use default
			$this->Info['Dir'] = SBB::Config('config.style.default');
			if(empty($this->Info['Dir']) || !is_dir(DIR_ROOT.DIR_STYLE.$this->Info['Dir'])) {
				// If default can't found, search for styles and use the first found
				$Dir = scandir(DIR_ROOT.DIR_STYLE);
				if(!$Dir)
					throw new SystemException('Failed to read the style directory ('.DIR_STYLE.'). Please check the existence of the directory.');
				foreach($Dir as $File) {
					if(in_array($File, array('.', '..')))
						continue;
					if(is_dir(DIR_ROOT.DIR_STYLE.$File)) {
						if(is_file(DIR_ROOT.DIR_STYLE.$File.'/info.xml')) {
							$this->Info['Dir'] = $File;
							break;
						}
					}
				}
				if(empty($this->Info['Dir']) || !is_dir(DIR_ROOT.DIR_STYLE.$this->Info['Dir']))
					throw new SystemException('No styles are installed, the board can\'t display without styles');
			}
		}
		
		// Set CSS and JS files
		$this->Files = array(
			'CSS' => $this->GetCSS(),
			'JS' => $this->GetJS()
		);

		// TODO: Load style info.xml and save in $this->Style
		$this->Info['Name'] = $this->Info['Dir'];
		
		// Set more infos
		$this->Info['Files'] = $this->Files;
		$this->Info['TPL'] = DIR_STYLE.$this->Info['Dir'].'/'.DIR_TPL;
	}
	
	/**
	 * Returns the style info
	 * @param	string	$Value
	 */
	public function Info($Value = '') {
		return !$Value ? $this->Info : (isset($this->Info[$Value]) ? $this->Info[$Value] : false);
	}
	
	/**
	 * Returns the style files
	 * @param	string	$Type
	 */
	public function Files($Type = '') {
		return !$Type ? $this->Files : (isset($this->Files[$Type]) ? $this->Files[$Type] : false);
	}
	
	// TODO: Merge GetCSS() and GetJS()
	protected function GetCSS() {
		$Dir = scandir(DIR_ROOT.DIR_STYLE.$this->Info['Dir']);
		if(!$Dir)
			throw new SystemException('The directory "'.DIR_ROOT.DIR_STYLE.$this->Info['Dir'].'" doesn\'t exist');
		
		$Files = array();
		if(is_file(DIR_ROOT.DIR_STYLE.$this->Info['Dir'].'/style.css')) // "root" css file
			$Files[] = 'style.css';
		foreach($Dir as $File) {
			if($File == 'style.css')
				continue;
			
			// Extension is .css?
			if(strpos($File, '.css') === (strlen($File) - 4))
				$Files[] = $File;
		}
		return $Files;
	}
	
	protected function GetJS() {
		$Dir = scandir(DIR_ROOT.DIR_STYLE.$this->Info['Dir'].'/'.DIR_JS);
		if(!$Dir)
			throw new SystemException('The directory "'.DIR_ROOT.DIR_STYLE.$this->Info['Dir'].'/'.DIR_JS.'" doesn\'t exist');
		
		$Files = array();
		foreach($Dir as $File) {
			// Extension is .js?
			if(strpos($File, '.js') === (strlen($File) - 3))
				$Files[] = $File;
		}
		return $Files;
	}
}
?>