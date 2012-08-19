<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/**
 * A wrapper for Smarty
 */

require_once(DIR_LIB.'smarty/Smarty.class.php');
class Template {
	private
		$Smarty,
		$Vars;

	public function __construct($TplDir, $StylePath = null) {
		$this->Smarty = new Smarty();
		
		//$this->Smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
		$this->Smarty->setTemplateDir($StylePath ? [$StylePath, $TplDir] : $TplDir);
		$this->Smarty->setCompileDir(DIR_TPLC);
		$this->Smarty->setCacheDir(CFG_CACHE_DIR); //self::Config('system.cache.dir')
	}

	/**
	 * Assign a key and a value as a variable to the variable pool
	 * @param	string	$Key
	 * @param	mixed	$Value
	 */
	public function Assign($Var, $Overwrite = false) {
		$this->Smarty->assign($Var);
	}

	/**
	 * Parses and render the template (starting with the given template) and returns the final product as a string
	 * @param	string	$Template
	 * @return	string
	 */
	// public function Render($Template) {
	// 	return $this->Parse($Template, false);
	// }
	
	/**
	 * Does the same as Render() but it outputs the template and doesn't return anything
	 * @param	string	$Template
	 */
	public function Display($Template) {
		$this->Smarty->display($Template);
	}
}












































// class Template {
// 	// Twig stuff
// 	private $Environment = null, $Template = null, $Variables = array();
	
// 	// Twig setting variables
// 	private $CachePath = null, $TPLPath = null, $Debug = false;

// 	/**
// 	 * Initialize Twig
// 	 */
// 	public function __construct($TPLPath, $StylePath = '', $CachePath = '', $Debug = true,
// 		$Charset = 'utf-8', $AutoReload = true, $AutoEscape = false) {
// 		// include the Twig Autoloader and register it
// 		if(!defined('CLASS_TEMPLATE')) {
// 			define('CLASS_TEMPLATE', 1);
// 			if(file_exists(DIR_LIB.'Twig/Autoloader.php'))
// 				require_once (DIR_LIB.'Twig/Autoloader.php');
// 			else
// 				throw new SystemException('Twig Autoloader not found!');

// 			Twig_Autoloader::register();
// 		}
		
// 		// Set necessary variables
// 		$this->TPLPath = $StylePath != '' ? array($StylePath, $TPLPath) : $TPLPath;
// 		$this->CachePath = $CachePath != '' ? $CachePath : (DIR_LIB.'cache/');
// 		$this->Debug = (bool)$Debug; // TODO: Config('template.debug') or so
		
// 		// Initial the Twig Environment
// 		$this->Environment = new Twig_Environment(new Twig_Loader_Filesystem($this->TPLPath), array(
// 			'debug'            => $this->Debug, // Enable or disable debugging
// 			'return_variables' => $this->Debug, // Enable returning names of undefined variables
// 			'charset'          => $Charset, // Sets the charset to the given value
// 			//'cache'            => $this->CachePath, // Sets the cache directory
// 			'auto_reload'      => $AutoReload, // Automaticaly recompile templates (for developing)
// 			'autoescape'       => $AutoEscape // Enabe auto-escaping
// 		));
// 	}
	
// 	/**
// 	 * Returns the value of the given key
// 	 * @param	string	$Key
// 	 */
// 	public function Get($Key) {
// 		return isset($this->Variables[$Key]) ? $this->Variables[$Key] : $Key;
// 	}
	
// 	/**
// 	 * Assign an array of Keys and Values to the variable pool of the template
// 	 * @param	array	$Variable
// 	 */
// 	public function Set(array $Variable, $Language = false, $Overwrite = false) {
// 		foreach($Variable as $Key => $Value) {
// 			if(is_numeric($Key))
// 				continue;
// 			$this->Assign(($Language ? 'lang='.$Key : $Key), $Value, $Overwrite);
// 		}
// 	}
	
// 	/**
// 	 * Adds a path to search for templates
// 	 * @param	string	$Path
// 	 */
// 	public function AddPath($Path) {
// 		$this->Environment->getLoader()->addPath($Path);
// 	}
	
// 	/**
// 	 * Parses and render the template (starting with the given template) and returns the final product as a string
// 	 * @param	string	$Template
// 	 * @return	string
// 	 */
// 	public function Render($Template) {
// 		return $this->Parse($Template, false);
// 	}
	
// 	/**
// 	 * Does the same as Render() but it outputs the template and doesn't return anything
// 	 * @param	string	$Template
// 	 */
// 	public function Display($Template) {
// 		$this->Parse($Template, true);
// 	}
	
// 	/**
// 	 * Assign a key and a value as a variable to the variable pool
// 	 * @param	string	$Key
// 	 * @param	mixed	$Value
// 	 */
// 	public function Assign($Key, $Value, $Overwrite = false) {
// 		if(!$Overwrite && isset($this->Variables[$Key]) && is_array($this->Variables[$Key]) && is_array($Value))
// 			$this->Variables = array_merge_recursive($this->Variables, array($Key => $Value));
// 		else
// 			$this->Variables[$Key] = $Value;
// 	}
	
// 	/**
// 	 * @param	string	$Template
// 	 * @param	bool	$Display
// 	 */
// 	protected function Parse($Template, $Display) {
// 		$this->Template = $this->Environment->loadTemplate($Template);
// 		if(!$Display)
// 			return $this->Template->render($this->Variables);
// 		$this->Template->display($this->Variables);
// 	}
// }
?>