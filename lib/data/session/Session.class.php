<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 or higher <http://www.gnu.org/licenses/gpl-3.0.html>
 */

class Session {	
	/**
	 * Starts the session
	 */
	public static function Start() {
		if(defined('CLASS_SESSION'))
			return false;
		define('CLASS_SESSION', 1);
		
		// Session configuration
		ini_set('session.gc_maxlifetime', SBB::Config('config.user.autologout'));
		ini_set('session.gc_probability', SBB::Config('config.user.session.autologout_probability'));
		ini_set('session.gc_divisor', 100);
		ini_set('session.hash_function', 1);
		
		register_shutdown_function('session_write_close');
		
		session_name(SBB::Config('config.user.session.name'));
		session_set_cookie_params(SBB::Config('config.user.session.cookie_time'), NULL, NULL, NULL, true);

		session_set_save_handler(new DatabaseSessionHandler(SBB::DB(), 'session'), true);

		// Start session
		session_start();
	}
	
	/**
	 * Destroy the session
	 */
	public static function Destroy() {
		unset($_SESSION);
		session_destroy();
	}
	
	/**
	 * Reads the content of a session, if the key is empty, false will return
	 * Alias for $_SESSION[$Key];
	 */
	public static function Get($Key) {
		return (isset($_SESSION[$Key]) ? $_SESSION[$Key] : false);
	}
	
	/**
	 * Sets the content of a session key.
	 * Alias for $_SESSION[$Key] = $Value;
	 * It will return true if succeeded else false
	 */
	public static function Set($Key, $Value) {
		return (bool)($_SESSION[$Key] = $Value);
	}

	public static function Merge($Key, $Value) {
		if(isset($_SESSION[$Key]))
			$_SESSION[$Key] = array_merge_recursive($_SESSION[$Key], $Value);
		else
			$_SESSION[$Key] = $Value;
	}
	
	/**
	 * Removes content from a session based on the given key
	 * Returns true if succeeded else false
	 */
	public static function Remove($Key) {
		$_SESSION[$Key] = null; // Debug because -v
		unset($_SESSION[$Key]); // Bug: doesn't work?
	}
}
?>