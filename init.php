<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 16
 */

// Error Reporting | Just For Dev-Version
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE | E_STRICT);

// Include Required Files
require_once('config.inc.php');
require_once('constants.inc.php');
require_once('functions.inc.php');

// Initial
date_default_timezone_set('Europe/Berlin');
session_start();

// Initial Classes
$language = new language();
$tpl = new template('case');

// Connecting To MySQL Server
if($MySQL['HOST'] || $MySQL['USER'] || $MySQL['DB'] != '') {
	if(!mysql::Connect($MySQL['HOST'], $MySQL['USER'], $MySQL['PW'], $MySQL['DB']))
		new messagebox(MSG_BOX_TYPE_ERROR, '{lang=com.sbb.error.mysql.connecting}');
} else {
	new messagebox(MSG_BOX_TYPE_ERROR, '{lang=com.sbb.error.mysql.settings}');
}

// Check If User Exist And Is Logged In
user::Initial();

// Will Open A Specific Page
page::Initial($tpl);

// Automatically Logout After 10 Minutes Inactivity
login::AutoLogout();

// Info Variables
page::$Info['Site'] = 'Home';

// Breadcrumbstart
crumb::Add('{lang=com.sbb.crumbs.home}', './');	

// Get Rights Of User | Not Useful At This Moment
$Group = groups::GetRights();

/*// Language Chooser
$Langs = $language->GetLanguages();
$DefaultLang = $language->Language;
foreach($Langs as $key => $val)
{
	if($DefaultLang == $key)
		$SelectLangs .= '<option selected="selected" value="'.$key.'">'.$val.'</option>';	
	else
		$SelectLangs .= '<option value="'.$key.'">'.$val.'</option>';					
}
$tpl->Assign('Languages',$SelectLangs);*/

// Just A Normal Messagebox Test
new messagebox(MSG_BOX_TYPE_NORMAL, 'Test');

// Template Stuff
$tpl->Assign(array(
	'Site'			=> 'Seitentitel',
	'Slogan'		=> 'Slogan der Seite',
	'Menu'			=> menu::Parse(),
	'MessageBox'	=> messagebox::GetBoxes(),
	'CSSStyles'		=> style::IncludeCSS(),
	'Javascripts'	=> style::IncludeJS()
));

$language->Assign($tpl);
$tpl->Assign('SiteLoad', round(((microtime(true) - $GeneratingTime) * 1000), 2).'ms'); // Isn't optimal here
$tpl->Display(false, true);
?>